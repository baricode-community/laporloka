<div>
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Laporan Terbaru</h2>
        <p class="text-gray-600">Lihat laporan-laporan terbaru dari masyarakat</p>
    </div>

    @if ($reports->count() > 0)
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @if (is_countable($reports))
                @foreach ($reports as $report)
                    <div
                        class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-shadow duration-300">
                        <!-- Header dengan Status dan Prioritas -->
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center space-x-2">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold {{ $this->getStatusBadgeColor($report->status) }}">
                                    {{ $this->getStatusText($report->status) }}
                                </span>
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-medium {{ $this->getPriorityBadgeColor($report->priority) }}">
                                    {{ $this->getPriorityText($report->priority) }}
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
                            {{ Str::limit($report->description, 120) }}
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
                            <span class="line-clamp-1 flex-1">{{ Str::limit($report->location_address, 50) }}</span>
                        </div>

                        <!-- Footer dengan info pelapor -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center">
                                <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                    <span class="text-xs font-bold text-blue-600">
                                        {{ substr($report->user->name ?? 'Anonim', 0, 1) }}
                                    </span>
                                </div>
                                <span
                                    class="text-sm text-gray-600 truncate">{{ $report->user->name ?? 'Anonim' }}</span>
                            </div>
                            <div class="text-xs text-gray-500 font-mono">
                                #{{ $report->report_number }}
                            </div>
                        </div>

                        <!-- View Count (jika ada) -->
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
            @endif
        </div>

        @if ($showPagination && is_object($reports) && method_exists($reports, 'links'))
            <div class="mt-8">
                {{ $reports->links() }}
            </div>
        @endif

        @if (!$showPagination && (is_countable($reports) ? count($reports) : $reports->count()) >= $limit)
            <div class="text-center mt-8">
                <a href="#"
                    class="inline-flex items-center bg-gray-100 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-200 transition-colors duration-200 font-semibold">
                    Lihat Semua Laporan
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        @endif
    @else
        <div class="text-center py-12 bg-gray-50 rounded-xl">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Laporan</h3>
            <p class="text-gray-600 mb-6">Saat ini belum ada laporan yang tersedia untuk ditampilkan.</p>
            @auth
                <button onclick="document.querySelector('#create-report-section').scrollIntoView({behavior: 'smooth'})"
                    class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors duration-200 font-semibold">
                    Buat Laporan Pertama
                </button>
            @endauth
        </div>
    @endif



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
