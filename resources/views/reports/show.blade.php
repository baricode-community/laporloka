@extends('layouts.base')

@section('title', 'Detail Laporan - ' . $report->title)

@section('content')
    @php
        $statusColors = [
            'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200 ring-yellow-600/20',
            'reviewed' => 'bg-blue-50 text-blue-700 border-blue-200 ring-blue-600/20',
            'in_progress' => 'bg-purple-50 text-purple-700 border-purple-200 ring-purple-600/20',
            'resolved' => 'bg-green-50 text-green-700 border-green-200 ring-green-600/20',
            'rejected' => 'bg-red-50 text-red-700 border-red-200 ring-red-600/20',
        ];

        $statusLabels = [
            'pending' => 'Menunggu Verifikasi',
            'reviewed' => 'Sedang Ditinjau',
            'in_progress' => 'Dalam Pengerjaan',
            'resolved' => 'Selesai',
            'rejected' => 'Ditolak',
        ];

        $currentStatusColor = $statusColors[$report->status] ?? 'bg-gray-50 text-gray-700 border-gray-200';
        $currentStatusLabel = $statusLabels[$report->status] ?? ucfirst($report->status);
    @endphp

    <div
        class="fixed inset-0 -z-10 h-full w-full bg-white bg-[linear-gradient(to_right,#f0f0f0_1px,transparent_1px),linear-gradient(to_bottom,#f0f0f0_1px,transparent_1px)] bg-[size:6rem_4rem]">
        <div
            class="absolute bottom-0 left-0 right-0 top-0 bg-[radial-gradient(circle_800px_at_100%_200px,#d5c5ff,transparent)]">
        </div>
    </div>

    <div class="relative isolate pt-6 pb-20 md:pt-10">
        <div class="container mx-auto px-4 md:px-6">

            <nav class="flex mb-6 md:mb-8 overflow-x-auto pb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 whitespace-nowrap">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('reports.index') }}"
                                class="ml-1 text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-2 transition-colors">Laporan</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span
                                class="ml-1 text-sm font-medium text-gray-400 md:ml-2 truncate max-w-[150px] md:max-w-xs">{{ $report->report_number }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">


                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-3xl shadow-xl shadow-blue-50/50 border border-gray-100 overflow-hidden">
                        <div class="p-6 md:p-10">
                            <div class="mb-8 border-b border-gray-100 pb-6">
                                <h1 class="text-2xl md:text-4xl font-extrabold text-gray-900 mb-4 leading-tight">
                                    {{ $report->title }}
                                </h1>
                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                                    <span class="flex items-center gap-1.5 bg-gray-50 px-3 py-1 rounded-full">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $report->created_at->format('d M Y, H:i') }} WIB
                                    </span>
                                    <span class="flex items-center gap-1.5 bg-gray-50 px-3 py-1 rounded-full">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        {{ rand(10, 500) }} Dilihat
                                    </span>
                                </div>
                            </div>

                            <div class="prose prose-blue prose-lg max-w-none mb-8 text-gray-700 leading-relaxed">
                                <p class="whitespace-pre-wrap">{{ $report->description }}</p>
                            </div>

                            @if ($report->location_address)
                                <div
                                    class="bg-blue-50/50 rounded-2xl p-5 border border-blue-100 flex flex-col sm:flex-row items-start gap-4 mb-8">
                                    <div class="bg-white p-2.5 rounded-full shadow-sm text-red-500 shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-1">Lokasi
                                            Kejadian</h4>
                                        <p class="text-gray-700 font-medium">{{ $report->location_address }}</p>
                                        @if ($report->location_latitude && $report->location_longitude)
                                            <a href="https://maps.google.com/?q={{ $report->location_latitude }},{{ $report->location_longitude }}"
                                                target="_blank"
                                                class="text-xs text-blue-600 mt-2 inline-flex items-center hover:underline font-mono">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                    </path>
                                                </svg>
                                                {{ $report->location_latitude }}, {{ $report->location_longitude }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if ($report->attachments->count() > 0)
                                <div class="mt-8">
                                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        Bukti Lampiran ({{ $report->attachments->count() }})
                                    </h3>

                                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                        @foreach ($report->attachments as $attachment)
                                            <div
                                                class="group relative rounded-2xl overflow-hidden border border-gray-200 bg-gray-50 aspect-square hover:shadow-lg transition-all duration-300">

                                                {{-- LOGIC TAMPILAN BERDASARKAN TIPE FILE --}}
                                                @if ($attachment->isImage())
                                                    {{-- TAMPILKAN GAMBAR --}}
                                                    <img src="{{ $attachment->getUrl() }}"
                                                        alt="{{ $attachment->original_name }}"
                                                        class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-500">
                                                @elseif ($attachment->isVideo())
                                                    {{-- TAMPILKAN VIDEO ICON / PREVIEW --}}
                                                    <div
                                                        class="w-full h-full bg-gray-900 flex items-center justify-center text-white relative">
                                                        {{-- Video Element (opsional, bisa diganti thumbnail) --}}
                                                        <video class="w-full h-full object-cover opacity-60">
                                                            <source src="{{ $attachment->getUrl() }}"
                                                                type="{{ $attachment->mime_type }}">
                                                        </video>

                                                        {{-- Play Icon Overlay --}}
                                                        <div class="absolute inset-0 flex items-center justify-center">
                                                            <svg class="w-12 h-12 text-white opacity-90 drop-shadow-lg"
                                                                fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                @else
                                                    {{-- TAMPILKAN DOKUMEN / FILE LAIN --}}
                                                    <div
                                                        class="absolute inset-0 flex flex-col items-center justify-center p-4 text-center bg-gray-50">
                                                        <div
                                                            class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center mb-3 text-blue-500">
                                                            {{-- Icon berdasarkan tipe file (helper function di model) --}}
                                                            @if (str_contains($attachment->mime_type, 'pdf'))
                                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                                    </path>
                                                                </svg>
                                                            @elseif(str_contains($attachment->mime_type, 'word'))
                                                                <svg class="w-6 h-6 text-blue-700" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                                    </path>
                                                                </svg>
                                                            @else
                                                                <svg class="w-6 h-6 text-gray-500" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                                    </path>
                                                                </svg>
                                                            @endif
                                                        </div>
                                                        <span
                                                            class="text-[11px] font-semibold text-gray-600 break-all line-clamp-2 leading-tight px-2">
                                                            {{ $attachment->original_name }}
                                                        </span>
                                                        <span
                                                            class="text-[9px] text-gray-400 mt-1 uppercase">{{ pathinfo($attachment->filename, PATHINFO_EXTENSION) }}</span>
                                                    </div>
                                                @endif

                                                {{-- OVERLAY ACTION: DOWNLOAD / VIEW --}}
                                                <a href="{{ $attachment->getUrl() }}" target="_blank"
                                                    class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-[1px]">
                                                    <span
                                                        class="bg-white text-gray-900 text-xs font-bold px-4 py-2 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 flex items-center gap-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                            </path>
                                                        </svg>
                                                        Buka File
                                                    </span>
                                                </a>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl shadow-xl shadow-blue-50/50 border border-gray-100 p-6 md:p-10">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                    </path>
                                </svg>
                                Diskusi
                            </h3>
                            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2.5 py-1 rounded-full">
                                {{ $report->comments->count() }} Tanggapan
                            </span>
                        </div>

                        <div class="relative">
                            @if ($report->comments->count() > 0)
                                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-100 hidden md:block"></div>
                                <div class="space-y-6">
                                    @foreach ($report->comments as $comment)
                                        <div class="relative flex flex-col md:flex-row gap-4 md:gap-0 group">
                                            <div
                                                class="hidden md:flex items-center justify-center w-8 h-8 absolute left-0 bg-white border-4 border-white rounded-full z-10">
                                                <div class="w-3 h-3 bg-blue-500 rounded-full shadow-sm"></div>
                                            </div>

                                            <div class="md:ml-12 w-full">
                                                <div
                                                    class="bg-gray-50 rounded-2xl rounded-tl-none md:rounded-tl-2xl p-5 border border-gray-100 hover:bg-blue-50/30 transition-colors">
                                                    <div class="flex justify-between items-start mb-2">
                                                        <div>
                                                            <span
                                                                class="font-bold text-gray-900 text-sm block">{{ $comment->user->name }}</span>
                                                            <span
                                                                class="text-xs text-gray-500">{{ $comment->user->role ?? 'User' }}</span>
                                                        </div>
                                                        <span
                                                            class="text-xs text-gray-400 bg-white px-2 py-1 rounded border border-gray-100">
                                                            {{ $comment->created_at->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                    <p class="text-gray-700 text-sm leading-relaxed mt-2">
                                                        {{ $comment->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div
                                    class="text-center py-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                                    <div
                                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-100 mb-3">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.001 8.001 0 01-7.938-6H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V12z">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 text-sm font-medium">Belum ada diskusi.</p>
                                    <p class="text-gray-400 text-xs mt-1">Jadilah yang pertama memberikan tanggapan.</p>
                                </div>
                            @endif
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-100 flex gap-4 items-start">
                            <div class="hidden md:block w-10 h-10 rounded-full bg-gray-200 shrink-0 overflow-hidden">
                                <svg class="w-full h-full text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <textarea
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-100 focus:border-blue-500 p-4 text-sm transition-all resize-none"
                                    rows="3" placeholder="Tulis komentar atau tanggapan..."></textarea>
                                <div class="mt-3 text-right">
                                    <button
                                        class="bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition-all hover:-translate-y-0.5">
                                        Kirim Komentar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 lg:sticky lg:top-24">

                        <div class="text-center mb-8">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Status Laporan
                            </p>
                            <span
                                class="inline-flex items-center px-5 py-2.5 rounded-2xl text-sm font-bold border {{ $currentStatusColor }} shadow-sm w-full justify-center">
                                <span class="relative flex h-2.5 w-2.5 mr-3">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 bg-current"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-current"></span>
                                </span>
                                {{ $currentStatusLabel }}
                            </span>
                        </div>

                        <div class="space-y-5 border-t border-gray-100 pt-6">
                            <div class="group">
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1.5">Nomor Tiket
                                </p>
                                <div
                                    class="flex items-center justify-between bg-gray-50 p-3 rounded-xl border border-gray-100 group-hover:border-blue-200 transition-colors">
                                    <span class="font-mono text-lg font-bold text-gray-800 tracking-tight">
                                        #{{ $report->report_number }}
                                    </span>
                                    <button class="text-gray-400 hover:text-blue-600" title="Copy">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1.5">Kategori
                                </p>
                                <div class="flex items-center gap-3 p-3 bg-blue-50/50 rounded-xl border border-blue-100">
                                    <span
                                        class="font-bold text-gray-700 text-sm">{{ $report->category->name ?? 'Tidak ada kategori' }}</span>
                                </div>
                            </div>

                            <div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1.5">Pelapor</p>
                                <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-gray-50 transition-colors">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold shadow-md text-sm ring-2 ring-white">
                                        {{ substr($report->user->name, 0, 1) }}
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="font-bold text-gray-900 text-sm truncate">{{ $report->user->name }}</p>
                                        <p class="text-xs text-gray-500 truncate">Warga / Pelapor</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 space-y-3 pt-6 border-t border-gray-100">
                            @if (auth()->check() && auth()->user()->id === $report->user_id && in_array($report->status, ['pending', 'rejected']))
                                <a href="{{ route('reports.edit', $report->id) }}"
                                    class="flex items-center justify-center w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-blue-200 transition-all hover:-translate-y-1 gap-2 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Edit Laporan
                                </a>
                            @endif

                            <a href="{{ route('reports.index') }}"
                                class="flex items-center justify-center w-full bg-white border border-gray-200 text-gray-600 font-bold py-3.5 px-4 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-colors gap-2 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
