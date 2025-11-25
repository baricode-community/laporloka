@extends('layouts.base')

@section('content')
    <div class="absolute inset-0 -z-10 h-full w-full bg-white bg-[linear-gradient(to_right,#f0f0f0_1px,transparent_1px),linear-gradient(to_bottom,#f0f0f0_1px,transparent_1px)] bg-[size:6rem_4rem]">
        <div class="absolute bottom-0 left-0 right-0 top-0 bg-[radial-gradient(circle_800px_at_100%_200px,#d5c5ff,transparent)]"></div>
    </div>

    <div class="relative isolate pt-14">
        <div class="container mx-auto px-4 py-12 sm:py-20">

            <div class="text-center mb-20">
                <span class="inline-block py-1 px-3 rounded-full bg-blue-50 text-blue-600 text-sm font-semibold mb-4 border border-blue-100">
                    Profil Kami
                </span>
                <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-gray-900 mb-6">
                    Tentang <span class="bg-gradient-to-r from-blue-600 to-green-500 bg-clip-text text-transparent">LaporLoka</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    LaporLoka adalah jembatan digital antara warga dan pemangku kepentingan. Kami hadir untuk mempermudah pelaporan masalah lingkungan, sosial, dan fasilitas publik demi terciptanya tatanan masyarakat yang lebih baik.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 mb-24 items-start">
                <div class="bg-white/80 backdrop-blur-sm p-10 rounded-[2.5rem] shadow-xl border border-gray-100 h-full transform hover:-translate-y-1 transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-8 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Visi Kami</h2>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        "Mewujudkan lingkungan yang aman, nyaman, dan berkelanjutan melalui partisipasi aktif masyarakat dalam penyampaian pengaduan serta transparansi penyelesaian laporan."
                    </p>
                </div>

                <div class="bg-white/80 backdrop-blur-sm p-10 rounded-[2.5rem] shadow-xl border border-gray-100 h-full transform hover:-translate-y-1 transition-all duration-300">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-8 text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2v4a2 2 0 01-2 2H9a2 2 0 01-2-2V5z" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Misi Kami</h2>
                    <ul class="space-y-5">
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-gray-600">Platform pelaporan yang inklusif dan mudah diakses.</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-gray-600">Kolaborasi erat antara warga dan pemerintah.</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-yellow-100 flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-gray-600">Transparansi total dalam proses tindak lanjut.</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-red-100 flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-gray-600">Notifikasi real-time untuk setiap perkembangan.</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mb-24">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Fitur Utama LaporLoka</h2>
                    <p class="text-gray-500">Apa saja yang bisa Anda lakukan di platform ini?</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    @foreach ([
                        ['title' => 'Buat Pengaduan', 'desc' => 'Laporkan masalah lingkungan, fasilitas umum, atau gangguan sosial dengan mudah beserta bukti foto.', 'color' => 'blue'],
                        ['title' => 'Pantau Status', 'desc' => 'Lihat perkembangan laporan secara real-time dari proses verifikasi hingga penyelesaian.', 'color' => 'green'],
                        ['title' => 'Kolaborasi Warga', 'desc' => 'Warga dapat saling memberi dukungan dan tambahan informasi pada laporan tertentu.', 'color' => 'purple'],
                    ] as $index => $item)
                    <div class="group bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 rounded-2xl mb-6 flex items-center justify-center text-3xl
                            {{ $item['color'] == 'blue' ? 'bg-blue-50 text-blue-600' : '' }}
                            {{ $item['color'] == 'green' ? 'bg-green-50 text-green-600' : '' }}
                            {{ $item['color'] == 'purple' ? 'bg-purple-50 text-purple-600' : '' }}
                        ">
                            @if($index == 0)
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            @elseif($index == 1)
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @else
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $item['title'] }}</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="relative bg-gray-900 rounded-3xl p-10 md:p-16 text-center overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-96 h-96 bg-blue-600 rounded-full blur-[100px] opacity-30"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-96 h-96 bg-green-600 rounded-full blur-[100px] opacity-30"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Bergabunglah Bersama Kami</h2>
                    <p class="text-gray-300 text-lg mb-10 max-w-2xl mx-auto">
                        Satu laporan dari Anda sangat berarti untuk lingkungan yang lebih baik. Jangan ragu untuk berkontribusi.
                    </p>

                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center bg-white text-gray-900 px-8 py-4 rounded-xl hover:bg-blue-50 transition-all duration-200 font-bold text-lg shadow-lg hover:shadow-white/20 transform hover:-translate-y-1">
                            Mulai Melapor
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center bg-white text-gray-900 px-8 py-4 rounded-xl hover:bg-blue-50 transition-all duration-200 font-bold text-lg shadow-lg hover:shadow-white/20 transform hover:-translate-y-1">
                            Ke Dashboard
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </a>
                    @endguest
                </div>
            </div>

        </div>
    </div>
@endsection
