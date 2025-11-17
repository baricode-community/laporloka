@extends('layouts.base')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50">
        <div class="container mx-auto px-4 py-12">
            <!-- Hero Section -->
            <div class="text-center mb-16">
                <h1 class="text-5xl font-bold text-gray-900 mb-6 bg-gradient-to-r from-blue-600 to-green-600 bg-clip-text text-transparent">
                    Selamat Datang di LaporLoka
                </h1>
                <p class="text-xl text-gray-700 max-w-3xl mx-auto leading-relaxed">
                    Platform pengaduan masyarakat modern yang memungkinkan warga untuk melaporkan
                    berbagai masalah di lingkungan sekitar secara mudah, cepat, dan transparan.
                </p>
            </div>
            
            <!-- Main Cards -->
            <div class="grid md:grid-cols-2 gap-8 mb-16">
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl transition-shadow duration-300">
                    <div class="bg-blue-100 w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Apa itu LaporLoka?</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Sistem pengaduan masyarakat terintegrasi yang menghubungkan warga dengan pihak berwenang
                        untuk penyelesaian masalah lingkungan secara efektif dan efisien.
                    </p>
                    <a href="{{ route('login') }}" class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors duration-200 font-semibold">
                        Masuk Sekarang
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl transition-shadow duration-300">
                    <div class="bg-green-100 w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Belum Punya Akun?</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Daftar sekarang untuk dapat membuat, melacak, dan memantau pengaduan Anda secara real-time
                        dengan notifikasi langsung ke perangkat Anda.
                    </p>
                    <a href="{{ route('register') }}" class="inline-flex items-center bg-green-600 text-white px-6 py-3 rounded-xl hover:bg-green-700 transition-colors duration-200 font-semibold">
                        Daftar Gratis
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- How It Works -->
            <div class="bg-white p-12 rounded-3xl shadow-xl border border-gray-100 mb-16">
                <h2 class="text-4xl font-bold text-center text-gray-900 mb-12">Cara Menggunakan LaporLoka</h2>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center group">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl font-bold shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                            1
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Daftar atau Masuk</h3>
                        <p class="text-gray-700 leading-relaxed">Buat akun baru dengan data valid atau masuk menggunakan akun yang sudah terdaftar</p>
                    </div>
                    
                    <div class="text-center group">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl font-bold shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                            2
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Buat Pengaduan</h3>
                        <p class="text-gray-700 leading-relaxed">Laporkan masalah dengan detail lengkap, lokasi, dan foto sebagai bukti pendukung</p>
                    </div>
                    
                    <div class="text-center group">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl font-bold shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                            3
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Tracking Status</h3>
                        <p class="text-gray-700 leading-relaxed">Monitor perkembangan pengaduan secara real-time dan terima notifikasi update terbaru</p>
                    </div>
                </div>
            </div>
            
            <!-- CTA Section -->
            @guest
            <div class="text-center bg-gradient-to-r from-blue-600 to-green-600 p-12 rounded-3xl shadow-2xl text-white">
                <h2 class="text-3xl font-bold mb-4">Mulai Laporkan Masalah Anda</h2>
                <p class="text-xl mb-8 text-blue-50">Bergabunglah dengan ribuan warga untuk menciptakan lingkungan yang lebih baik</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="inline-flex items-center bg-white text-blue-600 px-8 py-4 rounded-xl hover:bg-gray-50 transition-colors duration-200 font-bold text-lg shadow-lg">
                        Daftar Sekarang
                        <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="{{ route('about') }}" class="inline-flex items-center bg-blue-700 text-white px-8 py-4 rounded-xl hover:bg-blue-800 transition-colors duration-200 font-bold text-lg">
                        Pelajari Lebih Lanjut
                        <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @else
            <div class="text-center bg-gradient-to-r from-blue-600 to-green-600 p-12 rounded-3xl shadow-2xl text-white">
                <h2 class="text-3xl font-bold mb-4">Selamat Datang Kembali!</h2>
                <p class="text-xl mb-8 text-blue-50">Lanjutkan ke dashboard untuk mengelola dan memantau pengaduan Anda</p>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center bg-white text-blue-600 px-8 py-4 rounded-xl hover:bg-gray-50 transition-colors duration-200 font-bold text-lg shadow-lg">
                    Ke Dashboard
                    <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </a>
            </div>
            @endguest

            <!-- Report Creation Section -->
            <div id="create-report-section" class="mb-16">
                <livewire:create-report />
            </div>

            <!-- Recent Reports Section -->
            <div class="mb-16">
                <livewire:recent-reports :limit="6" :show-pagination="false" />
            </div>
        </div>
    </div>
@endsection