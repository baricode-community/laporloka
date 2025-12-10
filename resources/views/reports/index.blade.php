@extends('layouts.base')

@section('content')
    <div
        class="absolute inset-0 -z-10 h-full w-full bg-white bg-[linear-gradient(to_right,#f0f0f0_1px,transparent_1px),linear-gradient(to_bottom,#f0f0f0_1px,transparent_1px)] bg-[size:6rem_4rem]">
        <div
            class="absolute bottom-0 left-0 right-0 top-0 bg-[radial-gradient(circle_800px_at_100%_200px,#d5c5ff,transparent)]">
        </div>
    </div>
    <div class="relative isolate pt-8 md:pt-12 pb-20">
        <div class="container mx-auto px-4">

            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
                    Semua <span class="bg-gradient-to-r from-blue-600 to-green-600 bg-clip-text text-transparent">Laporan
                        Warga</span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Transparansi untuk lingkungan yang lebih baik. Pantau setiap aspirasi dan pengaduan yang masuk secara
                    real-time.
                </p>
            </div>

            <div
                class="bg-white rounded-2xl shadow-xl shadow-blue-100/50 border border-gray-100 p-6 mb-12 max-w-5xl mx-auto">
                <form method="GET" action="{{ route('reports.index') }}">
                    <div class="grid gap-4 md:grid-cols-12"> {{-- Gap diubah sedikit agar rapi --}}

                        {{-- 1. SEARCH: Ukuran diubah dari col-span-5 menjadi col-span-4 --}}
                        <div class="md:col-span-4 relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="search" name="search" value="{{ $search }}"
                                placeholder="Cari laporan..."
                                class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm font-medium">
                        </div>

                        {{-- 2. CATEGORY: col-span-3 (Tetap) --}}
                        <div class="md:col-span-3">
                            <select id="categoryFilter" name="categoryFilter"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-medium text-gray-700 cursor-pointer">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $categoryFilter == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- 3. STATUS: col-span-2 (Tetap) --}}
                        <div class="md:col-span-2">
                            <select id="statusFilter" name="statusFilter"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-medium text-gray-700 cursor-pointer">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ $statusFilter == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                <option value="reviewed" {{ $statusFilter == 'reviewed' ? 'selected' : '' }}>Ditinjau
                                </option>
                                <option value="in_progress" {{ $statusFilter == 'in_progress' ? 'selected' : '' }}>Diproses
                                </option>
                                <option value="resolved" {{ $statusFilter == 'resolved' ? 'selected' : '' }}>Selesai
                                </option>
                                <option value="rejected" {{ $statusFilter == 'rejected' ? 'selected' : '' }}>Ditolak
                                </option>
                            </select>
                        </div>

                        {{-- 4. BUTTONS: Ukuran diubah dari col-span-2 menjadi col-span-3 --}}
                        <div class="md:col-span-3 flex gap-2">
                            {{-- Tombol Filter Utama --}}
                            <button type="submit"
                                class="flex-1 px-4 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-200 font-semibold shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                    </path>
                                </svg>
                                <span>Filter</span>
                            </button>

                            {{-- Tombol Laporan Saya (Hanya muncul jika Login) --}}
                            @auth
                                @if (request('my_reports'))
                                    {{-- Jika sedang aktif (Tampilkan tombol untuk matikan filter) --}}
                                    <a href="{{ route('reports.index') }}"
                                        class="flex-1 px-4 py-3 bg-white border-2 border-blue-600 text-blue-600 rounded-xl hover:bg-blue-50 transition-all duration-200 font-semibold flex items-center justify-center gap-2"
                                        title="Tampilkan Semua Laporan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span>Semua</span>
                                    </a>
                                @else
                                    {{-- Jika tidak aktif (Tampilkan tombol Laporan Saya) --}}
                                    <a href="{{ route('reports.index', ['my_reports' => 1]) }}"
                                        class="flex-1 px-4 py-3 bg-white border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 hover:border-blue-300 hover:text-blue-600 transition-all duration-200 font-semibold flex items-center justify-center gap-2"
                                        title="Lihat Laporan Saya">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span>Saya</span>
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>

                    {{-- Reset Filter Link (Hanya muncul jika ada filter aktif) --}}
                    @if ($search || $categoryFilter || $statusFilter || request('my_reports'))
                        <div class="mt-4 flex justify-end">
                            <a href="{{ route('reports.index') }}"
                                class="text-sm text-red-500 hover:text-red-700 font-medium flex items-center gap-1 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reset Semua Filter
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            @if ($reports->count() > 0)
                <div class="mb-6 text-sm text-gray-500 font-medium ml-1">
                    Menampilkan {{ $reports->firstItem() }}-{{ $reports->lastItem() }} dari total {{ $reports->total() }}
                    laporan
                </div>

                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($reports as $report)
                        @php
                            // Color Logic for Status
                            $statusColors = [
                                'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-100',
                                'reviewed' => 'bg-blue-50 text-blue-700 border-blue-100',
                                'in_progress' => 'bg-purple-50 text-purple-700 border-purple-100',
                                'resolved' => 'bg-green-50 text-green-700 border-green-100',
                                'rejected' => 'bg-red-50 text-red-700 border-red-100',
                            ];
                            $statusClass = $statusColors[$report->status] ?? 'bg-gray-50 text-gray-700 border-gray-100';

                            // Translate Status
                            $statusLabel = [
                                'pending' => 'Menunggu',
                                'reviewed' => 'Ditinjau',
                                'in_progress' => 'Diproses',
                                'resolved' => 'Selesai',
                                'rejected' => 'Ditolak',
                            ];
                        @endphp

                        <div onclick="window.location.href='{{ route('reports.show', $report->id) }}'"
                            class="group bg-white rounded-[1.5rem] border border-gray-100 p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer relative overflow-hidden">

                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-2">
                                    @if ($report->category)
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-gray-50 text-gray-600 border border-gray-100">
                                            <span>{{ $report->category->icon }}</span>
                                            {{ $report->category->name }}
                                        </span>
                                    @endif
                                </div>
                                <span class="text-xs text-gray-400 font-medium">
                                    {{ $report->created_at->diffForHumans() }}
                                </span>
                            </div>

                            <div class="mb-6">
                                <h3
                                    class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2 leading-tight">
                                    {{ $report->title }}
                                </h3>
                                <p class="text-gray-500 text-sm line-clamp-3 leading-relaxed">
                                    {{ $report->description }}
                                </p>
                            </div>

                            <div class="flex items-start gap-2 text-sm text-gray-500 mb-6 bg-gray-50 p-3 rounded-xl">
                                <svg class="w-4 h-4 text-red-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="line-clamp-1">{{ $report->location_address }}</span>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-md">
                                        {{ substr($report->user->name ?? 'A', 0, 1) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span
                                            class="text-xs font-bold text-gray-700">{{ $report->user->name ?? 'Anonim' }}</span>
                                        <span class="text-[10px] text-gray-400">Pelapor</span>
                                    </div>
                                </div>

                                <span class="px-3 py-1 rounded-lg text-xs font-bold border {{ $statusClass }}">
                                    {{ $statusLabel[$report->status] ?? ucfirst($report->status) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $reports->links() }}
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-200">
                    <div class="bg-gray-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m2 6H7a2 2 0 01-2-2V6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v10a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Laporan</h3>
                    <p class="text-gray-500 mb-8">
                        @if ($search || $categoryFilter || $statusFilter)
                            Tidak ditemukan laporan yang cocok dengan filter Anda.
                        @else
                            Jadilah yang pertama melaporkan masalah di lingkungan Anda.
                        @endif
                    </p>
                    <a href="{{ route('reports.index') }}" class="text-blue-600 font-semibold hover:underline">Refresh
                        Halaman</a>
                </div>
            @endif
        </div>
    </div>
@endsection
