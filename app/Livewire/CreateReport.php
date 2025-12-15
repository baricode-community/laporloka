<?php

namespace App\Livewire;

use App\Models\Report;
use App\Models\ReportCategory;
use App\Models\ReportAttachment;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateReport extends Component
{
    use WithFileUploads;

    public $title = '';
    public $description = '';
    public $category_id = '';
    public $location_address = '';
    public $latitude = '';
    public $longitude = '';
    public $attachments = [];
    public $priority = 'medium';

    public $success = false;
    public $reportNumber = '';

    public function mount()
    {
        $this->priority = 'medium';
    }

    public function submitReport()
    {
        if (!auth()->check()) {
            session()->flash('error', 'Anda harus login terlebih dahulu.');
            return redirect()->route('login');
        }

        try {
            $this->validate([
                'title' => 'required|string|min:5|max:255',
                'description' => 'required|string|min:10',
                'category_id' => 'required|exists:report_categories,id',
                'location_address' => 'required|string|max:500',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'priority' => 'nullable|in:low,medium,high,urgent',
                'attachments' => 'nullable|array|max:5',
                'attachments.*' => 'file|max:51200', // Validasi size (50MB)
            ]);

            // 2. Create Report ke Database
            $report = Report::create([
                'user_id' => auth()->id(),
                'category_id' => $this->category_id,
                'title' => $this->title,
                'description' => $this->description,
                'location_address' => $this->location_address,
                'latitude' => $this->latitude ?: null,
                'longitude' => $this->longitude ?: null,
                'priority' => $this->priority,
                'status' => 'pending',
                'is_public' => true,
            ]);

            // 3. Handle Attachments
            if (!empty($this->attachments)) {
                foreach ($this->attachments as $file) {
                    try {
                        // Generate nama file unik
                        $originalName = $file->getClientOriginalName();
                        $extension = $file->extension();

                        // Fallback jika extension kosong (kasus octet-stream)
                        if (empty($extension)) {
                            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                        }

                        $fileName = \Illuminate\Support\Str::random(40) . '.' . $extension;

                        // Simpan Fisik
                        $path = $file->storeAs('report_attachments', $fileName, 'public');

                        // Simpan DB
                        ReportAttachment::create([
                            'report_id' => $report->id,
                            'user_id' => auth()->id(),
                            'filename' => $fileName,
                            'original_name' => $originalName,
                            'mime_type' => $file->getMimeType() ?? 'application/octet-stream',
                            'file_size' => $file->getSize(),
                            'file_path' => $path,
                            'is_public' => true,
                        ]);
                    } catch (\Exception $eFile) {
                        // Jika upload satu file gagal, lanjutkan ke file berikutnya
                        continue;
                    }
                }
            }

            // 4. Finalisasi
            $this->reportNumber = $report->report_number;
            $this->success = true;
            $this->resetForm();
            $this->dispatch('reportCreated', $report->id);
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e; // Lempar kembali agar error muncul di UI

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan sistem saat membuat laporan.');
        }
    }

    public function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->category_id = '';
        $this->location_address = '';
        $this->latitude = '';
        $this->longitude = '';
        $this->attachments = [];
        $this->priority = 'medium';
    }

    public function getCurrentLocation()
    {
        $this->dispatch('get-current-location');
    }

    public function setLocationData($latitude, $longitude, $address = null)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        if ($address) {
            $this->location_address = $address;
        }
    }

    public function removeAttachment($index)
    {
        array_splice($this->attachments, $index, 1);
    }

    public function render()
    {
        $categories = ReportCategory::where('is_active', true)->orderBy('sort_order')->get();

        return view('livewire.create-report', [
            'categories' => $categories,
        ]);
    }
}
