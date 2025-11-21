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
        <form method="GET" action="{{ route('reports.index') }}">
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
                            name="search"
                            value="{{ $search }}"
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
                        name="categoryFilter"
                        value="{{ $categoryFilter }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $categoryFilter == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                        name="statusFilter"
                        value="{{ $statusFilter }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="">Semua Status</option>
                        <option value="pending" {{ $statusFilter == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="reviewed" {{ $statusFilter == 'reviewed' ? 'selected' : '' }}>Ditinjau</option>
                        <option value="in_progress" {{ $statusFilter == 'in_progress' ? 'selected' : '' }}>Diproses</option>
                        <option value="resolved" {{ $statusFilter == 'resolved' ? 'selected' : '' }}>Selesai</option>
                        <option value="rejected" {{ $statusFilter == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="flex items-end">
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-semibold">
                        Filter
                    </button>
                </div>
            </div>

            <!-- Reset Filters Button -->
            @if ($search || $categoryFilter || $statusFilter)
                <div class="mt-4">
                    <a href="{{ route('reports.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset Filter
                    </a>
                </div>
            @endif
        </form>
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
                                class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                Menunggu
                            </span>
                            <span
                                class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Sedang
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
                    <p class="text-gray-700 text-sm mb-4">
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
                        <span>{{ \Illuminate\Support\Str::limit($report->location_address, 50) }}</span>
                    </div>

                    <!-- Footer dengan info pelapor -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                <span class="text-xs font-bold text-blue-600">
                                    {{ substr($report->user->name ?? 'Anonim', 0, 1) }}
                                </span>
                            </div>
                            <span class="text-sm text-gray-600">{{ $report->user->name ?? 'Anonim' }}</span>
                        </div>
                        <div class="text-xs text-gray-500 font-mono">
                            #{{ $report->report_number }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $reports->links() }}
        </div>
    @else
        <div class="text-center py-12 bg-gray-50 rounded-xl">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Laporan</h3>
            <p class="text-gray-600">Saat ini belum ada laporan yang tersedia.</p>
        </div>
    @endif
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
    </style>
@endsection