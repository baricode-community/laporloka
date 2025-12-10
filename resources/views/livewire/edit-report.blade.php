<div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Edit Laporan</h2>
            <p class="text-gray-600">Perbarui informasi laporan Anda</p>
        </div>
        <div class="hidden md:block">
            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-lg text-sm font-mono font-bold">
                #{{ $report->report_number }}
            </span>
        </div>
    </div>

    @if (session()->has('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg flex gap-3">
            <svg class="w-5 h-5 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div><strong>Error!</strong> {{ session('error') }}</div>
        </div>
    @endif

    <form wire:submit="updateReport" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Laporan</label>
                <input type="text" wire:model="title"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('title')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                <select wire:model="category_id"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500">
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
                <label class="block text-sm font-semibold text-gray-700 mb-2">Prioritas</label>
                <select wire:model="priority"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500">
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
                    <label class="block text-sm font-semibold text-gray-700">Alamat Lokasi</label>
                    <button type="button" onclick="getMyLocation()" id="location-btn"
                        class="text-sm text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-1">
                        <span>📍</span> <span id="location-btn-text">Update Lokasi Saat Ini</span>
                    </button>
                </div>
                <input type="text" id="location_address" wire:model="location_address"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500">
                @error('location_address')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <input type="hidden" wire:model="latitude">
            <input type="hidden" wire:model="longitude">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Detail</label>
            <textarea wire:model="description" rows="5"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500"></textarea>
            @error('description')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-3">Foto / Video / Dokumen Bukti</label>

            <div class="space-y-4">
                {{-- 1. TAMPILAN FILE YANG SUDAH ADA (EXISTING) --}}
                @if (count($existingAttachments) > 0)
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl">
                        <p class="text-xs font-bold text-gray-500 mb-3 uppercase tracking-wider">File Terlampir
                            ({{ count($existingAttachments) }})</p>
                        <div class="flex gap-3 overflow-x-auto pb-2">
                            @foreach ($existingAttachments as $file)
                                <div
                                    class="relative shrink-0 w-24 h-24 rounded-lg overflow-hidden border border-gray-300 group shadow-sm bg-white">
                                    {{-- Preview Logic Sederhana --}}
                                    @if ($file->isImage())
                                        <img src="{{ Storage::url($file->file_path) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full flex flex-col items-center justify-center text-gray-500 p-1">
                                            <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            <span
                                                class="text-[8px] truncate w-full text-center">{{ $file->original_name }}</span>
                                        </div>
                                    @endif

                                    {{-- Tombol Hapus File Lama --}}
                                    <button type="button" wire:click="deleteExistingAttachment({{ $file->id }})"
                                        wire:confirm="Yakin ingin menghapus file ini secara permanen?"
                                        class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1 shadow-md opacity-80 hover:opacity-100 transition-opacity"
                                        title="Hapus file ini">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- 2. UPLOAD FILE BARU (Drag & Drop) --}}
                <div x-data="{ isDropping: false, isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress" class="relative w-full">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full min-h-[140px] border-2 border-dashed rounded-2xl cursor-pointer transition-colors relative overflow-hidden group"
                        :class="isDropping ? 'border-blue-500 bg-blue-50' : 'border-gray-300 bg-white hover:bg-gray-50'"
                        @dragover.prevent="isDropping = true" @dragleave.prevent="isDropping = false"
                        @drop.prevent="isDropping = false">
                        {{-- Preview File Baru --}}
                        @if ($newAttachments)
                            <div
                                class="absolute inset-0 flex items-center gap-3 overflow-x-auto p-4 bg-white/95 backdrop-blur-sm z-10">
                                @foreach ($newAttachments as $index => $file)
                                    <div
                                        class="relative shrink-0 w-20 h-20 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                                        @if (str_starts_with($file->getMimeType(), 'image/'))
                                            <img src="{{ $file->temporaryUrl() }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div
                                                class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-500">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                        <button type="button" wire:click="removeNewAttachment({{ $index }})"
                                            class="absolute top-0 right-0 bg-red-500 text-white p-0.5 rounded-bl-lg">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4"
                            x-show="!isUploading">
                            <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            <p class="text-sm text-gray-500"><span class="font-bold text-blue-600">Klik tambah</span>
                                atau drag & drop file baru</p>
                        </div>

                        <div x-show="isUploading"
                            class="absolute inset-0 flex items-center justify-center bg-white/80 z-20">
                            <div class="w-full max-w-xs px-4">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" :style="'width: ' + progress + '%'">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input id="dropzone-file" type="file" wire:model="newAttachments" multiple class="hidden"
                            accept="image/*,video/*,application/pdf,application/msword" />
                    </label>
                    @error('newAttachments.*')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-4 border-t border-gray-100 gap-3">
            <a href="{{ route('reports.show', $report->id) }}"
                class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition-colors">
                Batal
            </a>
            <button type="submit"
                class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700 font-bold shadow-lg shadow-blue-200 transition-all flex items-center"
                wire:loading.attr="disabled">
                <span wire:loading.remove>Simpan Perubahan</span>
                <span wire:loading class="flex items-center gap-2">
                    <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Menyimpan...
                </span>
            </button>
        </div>
    </form>

    @if ($success)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
            <div class="bg-white p-8 rounded-2xl max-w-sm w-full mx-4 text-center shadow-2xl">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Perubahan Disimpan!</h3>
                <p class="text-gray-600 mb-6">Data laporan berhasil diperbarui.</p>
                <a href="{{ route('reports.show', $report->id) }}"
                    class="block w-full bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700">
                    Kembali ke Detail
                </a>
            </div>
        </div>
    @endif
</div>

{{-- Script Geolocation (Sama dengan create) --}}
<script>
    window.getMyLocation = function() {
        if (!navigator.geolocation) {
            alert('Geolocation tidak didukung browser ini.');
            return;
        }
        const btnText = document.getElementById('location-btn-text');
        btnText.textContent = 'Mendeteksi...';

        navigator.geolocation.getCurrentPosition(
            async (position) => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    @this.set('latitude', lat);
                    @this.set('longitude', lng);

                    try {
                        const res = await fetch(
                            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=16&addressdetails=1`
                            );
                        if (res.ok) {
                            const data = await res.json();
                            if (data.display_name) @this.set('location_address', data.display_name);
                        }
                    } catch (e) {}
                    btnText.textContent = 'Update Lokasi Saat Ini';
                },
                (err) => {
                    alert('Gagal mendeteksi lokasi.');
                    btnText.textContent = 'Update Lokasi Saat Ini';
                }
        );
    };
</script>
