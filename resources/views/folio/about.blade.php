@extends('layouts.base')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50">
    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-16">
            <h1 class="text-5xl font-bold text-gray-1000 mb-6 bg-gradient-to-r from-blue-600 to-green-600 bg-clip-text text-transparent">
                Tentang LaporLoka
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed font-semibold">LaporLoka adalah platform pengaduan masyarakat berbasis digital yang dirancang untuk mempermudah warga melaporkan berbagai masalah lingkungan, sosial, maupun fasilitas publik secara cepat, transparan, dan efisien.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-16">
            <div class="bg-white p-10 rounded-3xl shadow-xl border border-gray-100 flex items-start gap-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.71 9.29a1 1 0 00-1.42 0L12 13.59l-2.29-2.3a1 1 0 00-1.42 1.42l3 3a1 1 0 001.42 0l5-5a1 1 0 000-1.42z"/>
                    <path d="M12 2a10 10 0 1010 10A10.011 10.011 0 0012 2zm0 18a8 8 0 118-8 8.009 8.009 0 01-8 8z"/>
                </svg>
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Visi Kami</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Mewujudkan lingkungan yang aman, nyaman, dan berkelanjutan melalui partisipasi aktif masyarakat dalam penyampaian pengaduan serta transparansi penyelesaian laporan.
                    </p>
                </div>
            </div>
            <div class="bg-white p-10 rounded-3xl shadow-xl border border-gray-100">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6h13v13H9zM5 19V5h4v14H5z" />
                    </svg>
                    Misi Kami
                </h2>
                <ul class="text-gray-700 leading-relaxed space-y-4 list-none">
                    <li class="flex items-start gap-3">
                        <span class="text-blue-500 mt-1">📱</span>
                        Menyediakan platform pelaporan yang mudah diakses semua kalangan.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-green-500 mt-1">🤝</span>
                        Mendorong kolaborasi antara masyarakat dan pemerintah.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-yellow-500 mt-1">🔍</span>
                        Meningkatkan transparansi proses tindak lanjut pengaduan.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-red-500 mt-1">🔔</span>
                        Memberikan notifikasi dan pelacakan status laporan secara real-time.
                    </li>
                </ul>
            </div>
        </div>

        <div class="bg-white p-12 rounded-3xl shadow-xl border border-gray-100 mb-16">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-12">Apa yang Bisa Dilakukan di LaporLoka?</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach ([
                    ['title' => 'Buat Pengaduan', 'desc' => 'Laporkan masalah lingkungan, fasilitas umum, atau gangguan sosial dengan mudah beserta bukti foto.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 6H7a2 2 0 01-2-2V6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v10a2 2 0 01-2 2z"/></svg>'],
                    ['title' => 'Pantau Status', 'desc' => 'Lihat perkembangan laporan secara real-time dari proses verifikasi hingga penyelesaian.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'],
                    ['title' => 'Kolaborasi Warga', 'desc' => 'Warga dapat saling memberi dukungan dan tambahan informasi pada laporan tertentu.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 11-8 0 4 4 0 018 0z"/></svg>'],
                ] as $item)
                <div class="text-center group p-6">
                    <div class="bg-gradient-to-br from-blue-500 to-green-600 text-white w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl font-bold shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                        {!! $item['icon'] !!}
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $item['title'] }}</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $item['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>


        <div class="text-center bg-gradient-to-r from-blue-600 to-green-600 p-12 rounded-3xl shadow-2xl text-white">
            <h2 class="text-3xl font-bold mb-4">Siap Berkontribusi untuk Lingkungan Lebih Baik?</h2>
            <p class="text-xl mb-8 text-blue-50">
                Mari bersama membangun perubahan! Sampaikan laporan Anda sekarang.
            </p>

            @guest
                <a href="{{ route('register') }}" class="inline-flex items-center bg-white text-blue-600 px-8 py-4 rounded-xl hover:bg-gray-50 transition-colors duration-200 font-bold text-lg shadow-lg">
                    Mulai Melapor
                    <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="inline-flex items-center bg-white text-blue-600 px-8 py-4 rounded-xl hover:bg-gray-50 transition-colors duration-200 font-bold text-lg shadow-lg">
                    Lanjut ke Dashboard
                    <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </a>
            @endguest

        </div>
    </div>
</div>
@endsection
