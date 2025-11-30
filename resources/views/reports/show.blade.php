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
        class="absolute inset-0 -z-10 h-full w-full bg-white bg-[linear-gradient(to_right,#f0f0f0_1px,transparent_1px),linear-gradient(to_bottom,#f0f0f0_1px,transparent_1px)] bg-[size:6rem_4rem]">
        <div
            class="absolute bottom-0 left-0 right-0 top-0 bg-[radial-gradient(circle_800px_at_100%_200px,#d5c5ff,transparent)]">
        </div>
    </div>

    <div class="relative isolate pt-8 pb-20">
        <div class="container mx-auto px-4">

            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-8">

                    <div class="bg-white rounded-[2rem] shadow-xl shadow-blue-50 border border-gray-100 overflow-hidden">
                        <div class="p-8 md:p-10">
                            <div class="mb-6">
                                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 leading-tight">
                                    {{ $report->title }}
                                </h1>
                                <div class="flex items-center gap-3 text-sm text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $report->created_at->format('d M Y, H:i') }} WIB
                                    </span>
                                    <span>&bull;</span>
                                    <span class="flex items-center gap-1">
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

                            <div class="prose prose-blue max-w-none mb-8 text-gray-700 leading-relaxed">
                                <p class="whitespace-pre-wrap">{{ $report->description }}</p>
                            </div>

                            @if ($report->location_address)
                                <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100 flex items-start gap-3 mb-8">
                                    <div class="bg-white p-2 rounded-full shadow-sm text-red-500 mt-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-900">Lokasi Kejadian</h4>
                                        <p class="text-gray-600 text-sm mt-1">{{ $report->location_address }}</p>
                                        @if ($report->location_latitude && $report->location_longitude)
                                            <p class="text-xs text-gray-400 mt-1 font-mono">
                                                {{ $report->location_latitude }}, {{ $report->location_longitude }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if ($report->attachments->count() > 0)
                                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Bukti Lampiran
                                </h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    @foreach ($report->attachments as $attachment)
                                        <div
                                            class="group relative rounded-xl overflow-hidden border border-gray-200 bg-gray-50 hover:shadow-md transition-all">
                                            @if (str_contains($attachment->file_type, 'image/'))
                                                {{-- Placeholder Image Logic: Ganti src dengan path storage asli Anda --}}
                                                <div
                                                    class="aspect-square bg-gray-200 w-full flex items-center justify-center overflow-hidden">
                                                    {{-- Contoh: <img src="{{ Storage::url($attachment->path) }}" class="object-cover w-full h-full"> --}}
                                                    <svg class="w-10 h-10 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @else
                                                <div
                                                    class="aspect-square w-full flex flex-col items-center justify-center p-4 text-center">
                                                    <svg class="w-10 h-10 text-blue-500 mb-2" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                    <span
                                                        class="text-xs font-medium text-gray-600 truncate w-full">{{ $attachment->original_filename }}</span>
                                                </div>
                                            @endif

                                            <a href="#"
                                                class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                                                <span
                                                    class="bg-white/90 text-gray-900 text-xs font-bold px-2 py-1 rounded shadow-sm">Lihat</span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] shadow-xl shadow-blue-50 border border-gray-100 p-8 md:p-10">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                </path>
                            </svg>
                            Diskusi & Tindak Lanjut
                            <span
                                class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">{{ $report->comments->count() }}</span>
                        </h3>

                        @if ($report->comments->count() > 0)
                            <div
                                class="space-y-6 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-gray-200 before:to-transparent">
                                @foreach ($report->comments as $comment)
                                    <div class="relative flex items-start group">
                                        <div
                                            class="absolute left-0 top-0 mt-1 ml-3 h-4 w-4 rounded-full border-2 border-white bg-blue-500 shadow">
                                        </div>
                                        <div
                                            class="ml-10 w-full bg-gray-50 rounded-2xl p-5 border border-gray-100 hover:bg-blue-50/50 transition-colors">
                                            <div class="flex justify-between items-center mb-2">
                                                <span
                                                    class="font-bold text-gray-900 text-sm">{{ $comment->user->name }}</span>
                                                <span
                                                    class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-gray-700 text-sm leading-relaxed">{{ $comment->comment }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                                <p class="text-gray-500 text-sm">Belum ada tanggapan atau komentar.</p>
                            </div>
                        @endif
                        <div class="mt-8 pt-6 border-t border-gray-100">
                            <textarea class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:ring-blue-500 p-4 text-sm"
                                rows="3" placeholder="Tulis komentar..."></textarea>
                            <div class="mt-2 text-right">
                                <button
                                    class="bg-blue-600 text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-blue-700">Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">

                    <div class="bg-white rounded-[2rem] shadow-lg border border-gray-100 p-6 sticky top-24">
                        <div class="text-center mb-6">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Status Laporan</p>
                            <span
                                class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold border ring-1 {{ $currentStatusColor }} shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-current mr-2 animate-pulse"></span>
                                {{ $currentStatusLabel }}
                            </span>
                        </div>

                        <div class="space-y-4 border-t border-gray-100 pt-6">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Nomor Tiket</p>
                                <p
                                    class="font-mono text-lg font-bold text-gray-800 bg-gray-50 p-2 rounded-lg text-center select-all">
                                    {{ $report->report_number }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Kategori</p>
                                <div class="flex items-center gap-2 p-3 bg-blue-50 rounded-xl">
                                    <span class="text-xl">{{ $report->category->icon ?? '📝' }}</span>
                                    <span class="font-bold text-gray-700 text-sm">{{ $report->category->name }}</span>
                                </div>
                            </div>

                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Pelapor</p>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-blue-500 to-green-500 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                        {{ substr($report->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900 text-sm">{{ $report->user->name }}</p>
                                        <p class="text-xs text-gray-500">Warga</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 space-y-3">
                            @if (auth()->check() && auth()->user()->id === $report->user_id)
                                <a href="#"
                                    class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-blue-200 transition-all hover:-translate-y-1">
                                    Edit Laporan
                                </a>
                            @endif

                            <a href="{{ route('reports.index') }}"
                                class="block w-full text-center bg-white border border-gray-200 text-gray-600 font-bold py-3 px-4 rounded-xl hover:bg-gray-50 transition-colors">
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-br from-blue-600 to-green-600 rounded-[2rem] p-6 text-white shadow-lg text-center">
                        <h4 class="font-bold text-lg mb-2">Butuh Bantuan?</h4>
                        <p class="text-blue-50 text-sm mb-4">Jika laporan ini tidak kunjung diproses, Anda dapat mengajukan
                            banding.</p>
                        <button
                            class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white text-sm font-bold py-2 px-4 rounded-lg w-full transition-colors">
                            Hubungi Admin
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
