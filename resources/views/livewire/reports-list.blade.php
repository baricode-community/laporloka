@extends('layouts.base')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Semua Laporan</h1>
        <p class="text-gray-600">Jelajahi semua laporan yang telah disubmit oleh masyarakat</p>
    </div>

    <!-- Filters and Search Section -->
    <div class="bg-white border border-gray-200 rounded-xl p-6 mb-8">
        <div class="grid gap-4 md:grid-cols-4">
            <!-- Search Input -->
            <div class="md:col-span-2">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                    Cari Laporan
                </label>
                <div class="relative">
                    <input
                        type="text"
                        id="search"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Cari berdasarkan judul, deskripsi, atau lokasi..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Category Filter -->
            <div>
                <label for="categoryFilter" class="block text-sm font-medium text-gray-700 mb-2">
                    Kategori
                </label>
                <select
                    id="categoryFilter"
                    wire:model.live="categoryFilter"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status Filter -->
            <div>
                <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-2">
                    Status
                </label>
                <select
                    id="statusFilter"
                    wire:model.live="statusFilter"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="">Semua Status</option>
                    <option value="pending">Menunggu</option>
                    <option value="reviewed">Ditinjau</option>
                    <option value="in_progress">Diproses</option>
                    <option value="resolved">Selesai</option>
                    <option value="rejected">Ditolak</option>
                </select>
            </div>
        </div>

        <!-- Reset Filters Button -->
        @if ($search || $categoryFilter || $statusFilter)
            <div class="mt-4">
                <button
                    wire:click="resetFilters"
                    class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Reset Filter
                </button>
            </div>
        @endif
    </div>

    <!-- Results Count -->
    @if ($reports->count() > 0)
        <div class="mb-6 text-sm text-gray-600">
            Menampilkan {{ $reports->firstItem() }}-{{ $reports->lastItem() }} dari {{ $reports->total() }} laporan
            @if ($search || $categoryFilter || $statusFilter)
                <span class="text-blue-600">(dengan filter)</span>
            @endif
        </div>
    @endif

    <!-- Reports Grid -->
    @if ($reports->count() > 0)
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($reports as $report)
                <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300 cursor-pointer"
                     onclick="window.location.href='/laporan/{{ $report->id }}'">
                    <!-- Header dengan Status dan Prioritas -->
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center space-x-2">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold {{ $getStatusBadgeColor($report->status) }}">
                                {{ $getStatusText($report->status) }}
                            </span>
                            <span
                                class="px-2 py-1 rounded-full text-xs font-medium {{ $getPriorityBadgeColor($report->priority) }}">
                                {{ $getPriorityText($report->priority) }}
                            </span>
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ $report->created_at->diffForHumans() }}
                        </div>
                    </div>

                    <!-- Kategori -->
                    @if ($report->category)
                        <div class="flex items-center mb-3">
                            @if ($report->category->icon)
                                <span class="text-lg mr-2">{{ $report->category->icon }}</span>
                            @endif
                            <span class="text-sm font-medium text-gray-600">{{ $report->category->name }}</span>
                        </div>
                    @endif

                    <!-- Judul -->
                    <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">
                        {{ $report->title }}
                    </h3>

                    <!-- Deskripsi -->
                    <p class="text-gray-700 text-sm mb-4 line-clamp-3">
                        {{ \Illuminate\Support\Str::limit($report->description, 120) }}
                    </p>

                    <!-- Lokasi -->
                    <div class="flex items-center text-gray-600 text-sm mb-4">
                        <svg class="w-4 h-4 mr-2 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="line-clamp-1 flex-1">{{ \Illuminate\Support\Str::limit($report->location_address, 50) }}</span>
                    </div>

                    <!-- Footer dengan info pelapor -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                <span class="text-xs font-bold text-blue-600">
                                    {{ substr($report->user->name ?? 'Anonim', 0, 1) }}
                                </span>
                            </div>
                            <span class="text-sm text-gray-600 truncate">{{ $report->user->name ?? 'Anonim' }}</span>
                        </div>
                        <div class="text-xs text-gray-500 font-mono">
                            #{{ $report->report_number }}
                        </div>
                    </div>

                    <!-- View Count -->
                    @if ($report->views_count > 0)
                        <div class="mt-2 text-xs text-gray-500 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                            {{ number_format($report->views_count) }} kali dilihat
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $reports->links() }}
        </div>
    @else
        <div class="text-center py-12 bg-gray-50 rounded-xl">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Laporan</h3>
            <p class="text-gray-600 mb-6">
                @if ($search || $categoryFilter || $statusFilter)
                    Tidak ada laporan yang cocok dengan filter yang Anda pilih.
                @else
                    Saat ini belum ada laporan yang tersedia.
                @endif
            </p>
            @if ($search || $categoryFilter || $statusFilter)
                <button wire:click="resetFilters" 
                        class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors duration-200 font-semibold">
                    Hapus Filter
                </button>
            @endif
        </div>
    @endif

    <!-- Loading State -->
    <div wire:loading.delay.longer class="fixed top-4 right-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg">
        <div class="flex items-center">
            <svg class="animate-spin h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Memuat...
        </div>
    </div>

    <style>
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</div>
@endsection