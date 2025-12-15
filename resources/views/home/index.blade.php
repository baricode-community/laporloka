@extends('layouts.base')

@section('content')
    <div class="absolute inset-0 -z-10 h-full w-full bg-white bg-[linear-gradient(to_right,#f0f0f0_1px,transparent_1px),linear-gradient(to_bottom,#f0f0f0_1px,transparent_1px)] bg-[size:6rem_4rem]">
        <div class="absolute bottom-0 left-0 right-0 top-0 bg-[radial-gradient(circle_800px_at_100%_200px,#d5c5ff,transparent)]"></div>
    </div>

    <div class="relative isolate pt-14">
        <div class="container mx-auto px-4 py-12 sm:py-20">

            {{-- Hero Section --}}
            <div class="text-center mb-20">

                {{-- Badge Promo (Visible to Guests) --}}
                @guest
                    <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                        <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20 bg-white/50 backdrop-blur-sm">
                            Suarakan aspirasi untuk lingkungan yang lebih baik. <a href="{{ route('about') }}" class="font-semibold text-blue-600"><span class="absolute inset-0" aria-hidden="true"></span>Baca selengkapnya <span aria-hidden="true">&rarr;</span></a>
                        </div>
                    </div>
                @endguest

                {{-- Main Heading --}}
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-gray-900 mb-8">
                    Layanan Aspirasi & <br>
                    <span class="bg-gradient-to-r from-blue-600 to-green-500 bg-clip-text text-transparent">Pengaduan Online</span>
                </h1>

                <p class="mt-6 text-lg leading-8 text-gray-600 max-w-2xl mx-auto">
                    Sampaikan laporan Anda langsung kepada instansi pemerintah berwenang.
                    Mudah, Terpadu, dan Tuntas untuk pelayanan publik yang lebih baik.
                </p>

                {{-- Action Buttons --}}
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-x-6">
                    @auth
                        {{-- Tampilan JIKA LOGIN: Tombol ke Buat Laporan --}}
                        <a href="{{ url('/laporan/create') }}" class="w-full sm:w-auto rounded-xl bg-blue-600 px-8 py-4 text-base font-semibold text-white shadow-lg shadow-blue-200 hover:bg-blue-500 transition-all duration-300 hover:-translate-y-1 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Buat Laporan Baru
                        </a>
                        <a href="{{ route('reports.index') }}" class="w-full sm:w-auto rounded-xl bg-white border border-gray-200 px-8 py-4 text-base font-semibold text-gray-700 hover:bg-gray-50 transition-all duration-300">
                            Lihat Laporan Saya
                        </a>
                    @else
                        {{-- Tampilan JIKA TAMU --}}
                        <a href="{{ route('register') }}" class="w-full sm:w-auto rounded-xl bg-blue-600 px-8 py-4 text-base font-semibold text-white shadow-sm hover:bg-blue-500 transition-all duration-300 hover:-translate-y-1 shadow-blue-200">
                            Lapor Sekarang
                        </a>
                        <a href="#cara-kerja" class="text-sm font-semibold leading-6 text-gray-900">
                            Lihat Cara Kerja <span aria-hidden="true">→</span>
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Feature Cards (Sekarang ditampilkan untuk SEMUA user agar halaman tidak kosong saat login) --}}
            <div class="grid md:grid-cols-3 gap-8 mb-24 px-4">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 text-blue-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Aman & Rahasia</h3>
                    <p class="text-gray-600 leading-relaxed">Identitas pelapor dapat disamarkan (anonim) untuk menjamin keamanan dan privasi Anda.</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center mb-6 text-green-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Respon Cepat</h3>
                    <p class="text-gray-600 leading-relaxed">Laporan diteruskan langsung ke instansi terkait agar segera ditindaklanjuti.</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center mb-6 text-purple-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2v4a2 2 0 01-2 2H9a2 2 0 01-2-2V5z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Transparan</h3>
                    <p class="text-gray-600 leading-relaxed">Pantau status pengaduan Anda secara real-time dari verifikasi hingga selesai.</p>
                </div>
            </div>

            {{-- Cara Kerja Section --}}
            <div id="cara-kerja" class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 p-8 md:p-16 mb-24 relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-blue-50 rounded-full blur-3xl opacity-50"></div>

                <div class="relative z-10">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Alur Pengaduan</h2>
                        <p class="text-gray-500">Ikuti langkah mudah berikut untuk menyelesaikan masalah di lingkungan Anda.</p>
                    </div>

                    <div class="grid md:grid-cols-4 gap-8 text-center relative">
                        <div class="hidden md:block absolute top-10 left-0 w-full h-0.5 bg-gray-100 -z-10"></div>
                        @foreach([
                            ['step' => '1', 'title' => 'Tulis Laporan', 'desc' => 'Laporkan keluhan anda dengan jelas & lengkap.'],
                            ['step' => '2', 'title' => 'Verifikasi', 'desc' => 'Laporan diverifikasi oleh admin dalam 1x24 jam.'],
                            ['step' => '3', 'title' => 'Tindak Lanjut', 'desc' => 'Instansi terkait menangani laporan anda.'],
                            ['step' => '4', 'title' => 'Selesai', 'desc' => 'Laporan selesai dan anda menerima notifikasi.']
                        ] as $item)
                        <div class="group">
                            <div class="w-20 h-20 mx-auto bg-white border-4 border-blue-50 rounded-full flex items-center justify-center text-2xl font-bold text-blue-600 mb-6 shadow-sm group-hover:scale-110 group-hover:border-blue-200 transition-all duration-300">
                                {{ $item['step'] }}
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $item['title'] }}</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Recent Reports --}}
            <div class="mb-24">
                <livewire:recent-reports :limit="6" :show-pagination="false" />
                <div class="mt-8 text-center md:hidden">
                    <a href="{{ route('reports.index') }}" class="inline-flex items-center bg-white border border-gray-200 text-gray-700 px-6 py-3 rounded-xl font-medium shadow-sm hover:bg-gray-50 w-full justify-center">
                        Lihat Semua Laporan
                    </a>
                </div>
            </div>

            {{-- Footer CTA --}}
            <div class="relative bg-gray-900 rounded-3xl p-10 md:p-20 text-center overflow-hidden">
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-96 h-96 bg-blue-600 rounded-full blur-[100px] opacity-30"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-96 h-96 bg-green-600 rounded-full blur-[100px] opacity-30"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Siap Berpartisipasi?</h2>
                    <p class="text-gray-300 text-lg mb-10 max-w-2xl mx-auto">Jangan biarkan masalah lingkunganmu berlarut-larut. Ambil peran sekarang untuk perubahan yang nyata.</p>

                    @guest
                        <a href="{{ route('register') }}" class="inline-block bg-white text-gray-900 px-10 py-4 rounded-xl font-bold hover:bg-blue-50 transition-colors shadow-lg hover:shadow-white/20">
                            Daftar Akun Gratis
                        </a>
                    @else
                        <a href="{{ url('/laporan/create') }}" class="inline-block bg-blue-600 text-white px-10 py-4 rounded-xl font-bold hover:bg-blue-500 transition-colors shadow-lg shadow-blue-500/30">
                            Buat Laporan Sekarang
                        </a>
                    @endguest
                </div>
            </div>

        </div>
    </div>
@endsection
