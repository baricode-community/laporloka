@extends('layouts.base')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Semua Laporan</h1>
        <p class="text-gray-600">Jelajahi semua laporan yang telah disubmit oleh masyarakat</p>
    </div>

    <!-- Reports Grid -->
    @if ($reports->count() > 0)
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($reports as $report)
                <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300 cursor-pointer"
                     onclick="window.location.href='/laporan/{{ $report->id }}'">
                    <!-- Judul -->
                    <h3 class="text-lg font-bold text-gray-900 mb-3">
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
@endsection