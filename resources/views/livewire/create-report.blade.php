<div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Buat Laporan Baru</h2>
        <p class="text-gray-600">Laporkan masalah di lingkungan Anda dengan mudah</p>
    </div>

    @if (session()->has('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
            <div class="flex">
                <svg class="w-5 h-5 text-green-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <div>
                    <strong>Berhasil!</strong> {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
            <div class="flex">
                <svg class="w-5 h-5 text-red-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <strong>Error!</strong> {{ session('error') }}
                </div>
            </div>
        </div>
    @endif

    @guest
        <div class="text-center py-12 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border-2 border-blue-200">
            <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Login Diperlukan untuk Membuat Laporan</h3>
            <p class="text-gray-700 mb-8 max-w-md mx-auto">
                Untuk membuat laporan masalah, Anda perlu masuk terlebih dahulu. Ini membantu kami melacak pengaduan Anda
                dan memberikan update status.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('login') }}"
                    class="inline-flex items-center justify-center bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Masuk Sekarang
                </a>
                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center bg-white text-blue-600 border-2 border-blue-600 px-8 py-4 rounded-xl hover:bg-blue-50 transition-all duration-200 font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Daftar Akun Baru
                </a>
            </div>

            <div class="mt-8 p-4 bg-blue-100 rounded-lg max-w-sm mx-auto">
                <p class="text-sm text-blue-800">
                    <strong>Info:</strong> Gunakan akun <code>test@example.com</code> untuk testing
                </p>
            </div>
        </div>
    @else
        <form wire:submit="submitReport" class="space-y-6">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Laporan</label>
                    <input type="text" id="title" wire:model="title"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        placeholder="Masukkan judul laporan yang singkat dan jelas">
                    @error('title')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                    <select id="category_id" wire:model="category_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="priority" class="block text-sm font-semibold text-gray-700 mb-2">Prioritas</label>
                    <select id="priority" wire:model="priority"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <option value="low">Rendah</option>
                        <option value="medium">Sedang</option>
                        <option value="high">Tinggi</option>
                        <option value="urgent">Mendesak</option>
                    </select>
                    @error('priority')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <div class="flex items-center justify-between mb-2">
                        <label for="location_address" class="block text-sm font-semibold text-gray-700">Alamat
                            Lokasi</label>
                        <button type="button" onclick="getMyLocation()" id="location-btn"
                            class="text-sm text-blue-600 hover:text-blue-700 font-semibold flex items-center space-x-1 transition-colors duration-200"
                            title="Klik untuk mendapatkan lokasi GPS Anda saat ini">
                            <span>📍</span>
                            <span id="location-btn-text">Gunakan Lokasi Saat Ini</span>
                        </button>
                    </div>
                    <input type="text" id="location_address" wire:model="location_address"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        placeholder="Masukkan alamat lengkap lokasi masalah">
                    @error('location_address')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="hidden md:col-span-2 grid grid-cols-2 gap-4">
                    <div>
                        <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                        <input type="number" id="latitude" wire:model="latitude" step="any"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Contoh: -6.2088">
                        @error('latitude')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                        <input type="number" id="longitude" wire:model="longitude" step="any"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Contoh: 106.8456">
                        @error('longitude')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Detail</label>
                <textarea id="description" wire:model="description" rows="5"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                    placeholder="Jelaskan masalah secara detail, termasuk kapan terjadi, dampak yang ditimbulkan, dan informasi lainnya yang relevan..."></textarea>
                @error('description')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-sm font-semibold text-gray-700">Foto / Video / Dokumen Bukti</label>
                    <span class="text-xs text-gray-500">Max 5 file (Img, Video, PDF, Doc) - Max 10MB/file</span>
                </div>

                <div
                    x-data="{ isDropping: false, isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                    class="relative w-full"
                >
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full min-h-[160px] border-2 border-dashed rounded-2xl cursor-pointer transition-colors relative overflow-hidden group"
                        :class="isDropping ? 'border-blue-500 bg-blue-50' : 'border-gray-300 bg-gray-50 hover:bg-gray-100'"
                        @dragover.prevent="isDropping = true"
                        @dragleave.prevent="isDropping = false"
                        @drop.prevent="isDropping = false; $refs.fileInput.files = $event.dataTransfer.files; $refs.fileInput.dispatchEvent(new Event('change', { bubbles: true }))"
                    >

                        @if ($attachments)
                            <div class="absolute inset-0 flex items-center gap-3 overflow-x-auto p-4 bg-white/95 backdrop-blur-sm z-10">
                                @foreach ($attachments as $index => $file)
                                    <div class="relative shrink-0 w-24 h-24 rounded-xl overflow-hidden border border-gray-200 shadow-sm group/item">

                                        {{-- Logika Preview --}}
                                        @php
                                            $mime = $file->getMimeType();
                                        @endphp

                                        @if (str_starts_with($mime, 'image/'))
                                            <img src="{{ $file->temporaryUrl() }}" class="w-full h-full object-cover">
                                        @elseif (str_starts_with($mime, 'video/'))
                                            <div class="w-full h-full bg-gray-900 flex items-center justify-center text-white">
                                                <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path></svg>
                                            </div>
                                        @else
                                            <div class="w-full h-full bg-gray-100 flex flex-col items-center justify-center text-gray-500 p-2 text-center">
                                                <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                <span class="text-[8px] font-mono leading-tight truncate w-full">{{ $file->getClientOriginalName() }}</span>
                                            </div>
                                        @endif

                                        {{-- Tombol Hapus --}}
                                        <button type="button" wire:click.prevent="removeAttachment({{ $index }})"
                                            class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 shadow-md hover:bg-red-600 transition-colors z-20">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                @endforeach

                                <div class="ml-auto flex flex-col gap-2 pr-2">
                                    <span class="text-xs text-gray-500 font-medium whitespace-nowrap">{{ count($attachments) }} File</span>
                                    <button type="button" wire:click="$set('attachments', [])" class="text-xs text-red-600 hover:text-red-800 underline">Reset</button>
                                </div>
                            </div>
                        @endif

                        <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4" x-show="!isUploading">
                            <svg class="w-10 h-10 mb-4 text-blue-500 bg-blue-50 p-2 rounded-lg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-600"><span class="font-bold text-blue-600 hover:underline">Klik upload</span> atau drag & drop</p>
                            <p class="text-xs text-gray-500">Img, Video, PDF, Doc (Max 10MB)</p>
                        </div>

                        <div x-show="isUploading" class="absolute inset-0 flex items-center justify-center bg-white/80 z-20">
                            <div class="w-full max-w-xs px-4">
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium text-blue-700">Mengupload...</span>
                                    <span class="text-sm font-medium text-blue-700" x-text="progress + '%'"></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                                </div>
                            </div>
                        </div>

                        <input x-ref="fileInput" id="dropzone-file" type="file" wire:model="attachments" multiple class="hidden"
                             accept="image/*,video/*,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
                    </label>
                </div>

                @error('attachments') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                @error('attachments.*') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end pt-6">
                <button type="submit"
                    class="inline-flex items-center bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition-all duration-200 font-semibold text-lg shadow-lg hover:shadow-xl"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Kirim Laporan
                    </span>
                    <span wire:loading class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Mengirim...
                    </span>
                </button>
            </div>
        </form>
    @endguest

    @if($success && $reportNumber)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm transition-opacity">

            <div class="bg-white p-8 rounded-2xl max-w-md w-full mx-4 shadow-2xl transform scale-100 transition-transform">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-2">Laporan Berhasil Dibuat!</h3>
                    <p class="text-gray-600 mb-4">Nomor laporan Anda:</p>

                    <div class="bg-gray-50 border border-gray-100 p-4 rounded-xl font-mono font-bold text-xl text-blue-600 mb-8 tracking-wider select-all">
                        {{ $reportNumber }}
                    </div>

                    {{-- Tombol Tutup --}}
                    <a href="{{ route('reports.index') }}"
                       class="block w-full bg-blue-600 text-white px-6 py-3.5 rounded-xl hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 font-bold shadow-blue-200">
                        Tutup & Lihat Daftar
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    // Simple geolocation function
    window.getMyLocation = function() {
        if (!navigator.geolocation) {
            alert('Geolocation tidak didukung oleh browser ini.');
            return;
        }

        const locationBtn = document.getElementById('location-btn');
        const locationBtnText = document.getElementById('location-btn-text');
        const locationInput = document.querySelector('#location_address');

        // Show loading state
        locationBtnText.textContent = 'Mengambil Lokasi...';
        locationBtn.disabled = true;
        locationBtn.classList.add('opacity-50', 'cursor-not-allowed');
        locationInput.placeholder = 'Mengambil lokasi...';

        navigator.geolocation.getCurrentPosition(
            async (position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    console.log('Location found:', latitude, longitude);

                    // Set coordinates directly to Livewire
                    @this.set('latitude', latitude);
                    @this.set('longitude', longitude);

                    try {
                        // Simple reverse geocoding
                        const response = await fetch(
                            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=16&addressdetails=1`
                            );

                        if (response.ok) {
                            const data = await response.json();
                            console.log('Geocoding result:', data);

                            if (data && data.display_name) {
                                @this.set('location_address', data.display_name);
                            } else {
                                @this.set('location_address', `${latitude}, ${longitude}`);
                            }
                        } else {
                            @this.set('location_address', `${latitude}, ${longitude}`);
                        }
                    } catch (error) {
                        console.error('Error getting address:', error);
                        @this.set('location_address', `${latitude}, ${longitude}`);
                    }

                    // Success state
                    locationBtnText.textContent = 'Lokasi Berhasil ✓';
                    locationBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    locationBtn.classList.add('text-green-600');
                    locationInput.placeholder = 'Masukkan alamat lengkap lokasi masalah';

                    // Reset after 3 seconds
                    setTimeout(() => {
                        locationBtnText.textContent = 'Gunakan Lokasi Saat Ini';
                        locationBtn.classList.remove('text-green-600');
                        locationBtn.disabled = false;
                    }, 3000);
                },
                (error) => {
                    console.error('Geolocation error:', error);

                    // Reset button state
                    locationBtnText.textContent = 'Gunakan Lokasi Saat Ini';
                    locationBtn.disabled = false;
                    locationBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    locationInput.placeholder = 'Masukkan alamat lengkap lokasi masalah';

                    let errorMessage = 'Tidak dapat mengakses lokasi Anda.';
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            errorMessage =
                            'Akses lokasi ditolak. Silakan izinkan akses lokasi di browser Anda.';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMessage = 'Layanan lokasi tidak tersedia.';
                            break;
                        case error.TIMEOUT:
                            errorMessage = 'Permintaan lokasi timeout.';
                            break;
                    }

                    alert(errorMessage + ' Silakan masukkan alamat secara manual.');
                }, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 60000
                }
        );
    };
</script>
