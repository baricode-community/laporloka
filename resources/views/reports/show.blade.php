@extends('layouts.base')

@section('title', 'Detail Laporan - ' . $report->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Beranda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('reports.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Laporan</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $report->report_number }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Report Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-start mb-4">
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $report->title }}</h1>
                <p class="text-sm text-gray-600">Nomor Laporan: {{ $report->report_number }}</p>
            </div>
            <div class="flex flex-col items-end space-y-2">
                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusBadgeColor }}">
                    {{ $statusText }}
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $priorityBadgeColor }}">
                    {{ $priorityText }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="font-medium text-gray-700">Kategori:</span>
                <span class="ml-2 text-gray-600">{{ $report->category->name }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700">Pelapor:</span>
                <span class="ml-2 text-gray-600">{{ $report->user->name }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700">Tanggal:</span>
                <span class="ml-2 text-gray-600">{{ $report->created_at->format('d M Y H:i') }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700">Lokasi:</span>
                <span class="ml-2 text-gray-600">{{ $report->location_address }}</span>
            </div>
        </div>
    </div>

    <!-- Report Content -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Deskripsi Laporan</h2>
        <div class="prose max-w-none">
            <p class="text-gray-700 whitespace-pre-wrap">{{ $report->description }}</p>
        </div>

        @if($report->location_latitude && $report->location_longitude)
        <div class="mt-6">
            <h3 class="text-md font-semibold text-gray-900 mb-2">Koordinat Lokasi</h3>
            <div class="bg-gray-50 p-3 rounded text-sm text-gray-600">
                Latitude: {{ $report->location_latitude }}, Longitude: {{ $report->location_longitude }}
            </div>
        </div>
        @endif
    </div>

    <!-- Attachments -->
    @if($report->attachments->count() > 0)
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Lampiran</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($report->attachments as $attachment)
            <div class="border rounded-lg p-3">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        @if(str_contains($attachment->file_type, 'image/'))
                        <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                        @else
                        <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                        </svg>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $attachment->original_filename }}</p>
                        <p class="text-sm text-gray-500">{{ number_format($attachment->file_size / 1024, 2) }} KB</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Comments -->
    @if($report->comments->count() > 0)
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Komentar</h2>
        <div class="space-y-4">
            @foreach($report->comments as $comment)
            <div class="border-l-4 border-blue-500 pl-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="font-medium text-gray-900">{{ $comment->user->name }}</span>
                    <span class="text-sm text-gray-500">{{ $comment->created_at->format('d M Y H:i') }}</span>
                </div>
                <p class="text-gray-700">{{ $comment->comment }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Action Buttons -->
    <div class="mt-6 flex justify-between">
        <a href="{{ route('reports.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Laporan
        </a>
        
        @if(auth()->check() && auth()->user()->id === $report->user_id)
        <button class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Laporan
        </button>
        @endif
    </div>
</div>
@endsection