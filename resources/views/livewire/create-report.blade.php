<div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Buat Laporan Baru</h2>
        <p class="text-gray-600">Laporkan masalah di lingkungan Anda dengan mudah</p>
    </div>

    @if(session()->has('success'))
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

    @if(session()->has('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
            <div class="flex">
                <svg class="w-5 h-5 text-red-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <strong>Error!</strong> {{ session('error') }}
                </div>
            </div>
        </div>
    @endif

    @guest
        <div class="text-center py-12 bg-gray-50 rounded-xl">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Masuk Diperlukan</h3>
            <p class="text-gray-600 mb-6">Anda harus masuk terlebih dahulu untuk membuat laporan</p>
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors duration-200 font-semibold">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="inline-flex items-center bg-gray-600 text-white px-6 py-3 rounded-xl hover:bg-gray-700 transition-colors duration-200 font-semibold">
                    Daftar
                </a>
            </div>
        </div>
    @else
        <form wire:submit="submitReport" class="space-y-6">
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Judul Laporan -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Laporan</label>
                    <input type="text" id="title" wire:model="title" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                           placeholder="Masukkan judul laporan yang singkat dan jelas">
                    @error('title') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                    <select id="category_id" wire:model="category_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Prioritas -->
                <div>
                    <label for="priority" class="block text-sm font-semibold text-gray-700 mb-2">Prioritas</label>
                    <select id="priority" wire:model="priority" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <option value="low">Rendah</option>
                        <option value="medium">Sedang</option>
                        <option value="high">Tinggi</option>
                        <option value="urgent">Mendesak</option>
                    </select>
                    @error('priority') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Lokasi -->
                <div class="md:col-span-2">
                    <div class="flex items-center justify-between mb-2">
                        <label for="location_address" class="block text-sm font-semibold text-gray-700">Alamat Lokasi</label>
                        <button type="button" wire:click="getCurrentLocation" 
                                class="text-sm text-blue-600 hover:text-blue-700 font-semibold">
                            📍 Gunakan Lokasi Saat Ini
                        </button>
                    </div>
                    <input type="text" id="location_address" wire:model="location_address" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                           placeholder="Masukkan alamat lengkap lokasi masalah">
                    @error('location_address') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Koordinat (Hidden/Optional) -->
                <div class="hidden md:col-span-2 grid grid-cols-2 gap-4">
                    <div>
                        <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                        <input type="number" id="latitude" wire:model="latitude" step="any"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Contoh: -6.2088">
                        @error('latitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                        <input type="number" id="longitude" wire:model="longitude" step="any"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Contoh: 106.8456">
                        @error('longitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Detail</label>
                <textarea id="description" wire:model="description" rows="5"
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                          placeholder="Jelaskan masalah secara detail, termasuk kapan terjadi, dampak yang ditimbulkan, dan informasi lainnya yang relevan..."></textarea>
                @error('description') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
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
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Mengirim...
                    </span>
                </button>
            </div>
        </form>
    @endguest

    <!-- Success Modal/Alert (if needed) -->
    @if($success && $reportNumber)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-8 rounded-2xl max-w-md w-full mx-4">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Laporan Berhasil Dibuat!</h3>
                    <p class="text-gray-600 mb-4">Nomor laporan Anda:</p>
                    <div class="bg-gray-100 p-3 rounded-lg font-mono font-bold text-lg text-blue-600 mb-6">
                        {{ $reportNumber }}
                    </div>
                    <button wire:click="$set('success', false)" 
                            class="w-full bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors duration-200 font-semibold">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('get-current-location', () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    @this.set('latitude', position.coords.latitude);
                    @this.set('longitude', position.coords.longitude);
                    
                    // Optional: Reverse geocoding to get address
                    if (window.google && google.maps) {
                        const geocoder = new google.maps.Geocoder();
                        const latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                        
                        geocoder.geocode({location: latlng}, (results, status) => {
                            if (status === 'OK' && results[0]) {
                                @this.set('location_address', results[0].formatted_address);
                            }
                        });
                    }
                },
                (error) => {
                    alert('Tidak dapat mengakses lokasi Anda. Silakan masukkan alamat secara manual.');
                }
            );
        } else {
            alert('Geolocation tidak didukung oleh browser ini.');
        }
    });
});
</script>
