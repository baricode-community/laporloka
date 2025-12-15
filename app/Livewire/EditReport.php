<?php

namespace App\Livewire;

use App\Models\Report;
use App\Models\ReportCategory;
use App\Models\ReportAttachment;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditReport extends Component
{
    use WithFileUploads;

    public Report $report; // Model Binding

    // Form Properties
    public $title = '';
    public $description = '';
    public $category_id = '';
    public $location_address = '';
    public $latitude = '';
    public $longitude = '';
    public $priority = 'medium';

    // File Handling
    public $newAttachments = []; // File baru yang akan diupload
    public $existingAttachments = []; // File lama dari database

    public $success = false;

    public function mount(Report $report)
    {
        $this->report = $report;

        // Pre-fill data form dari database
        $this->title = $report->title;
        $this->description = $report->description;
        $this->category_id = $report->category_id;
        $this->location_address = $report->location_address;
        $this->latitude = $report->latitude;
        $this->longitude = $report->longitude;
        $this->priority = $report->priority;

        // Load lampiran lama
        $this->existingAttachments = $report->attachments;
    }

    public function updateReport()
    {
        // 1. Validasi
        $this->validate([
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10',
            'category_id' => 'required|exists:report_categories,id',
            'location_address' => 'required|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'priority' => 'nullable|in:low,medium,high,urgent',
            'newAttachments' => 'nullable|array|max:5',
            'newAttachments.*' => 'file|max:51200', // 50MB
        ]);

        if (auth()->id() !== $this->report->user_id) {
            session()->flash('error', 'Unauthorized action.');
            return redirect()->route('reports.index');
        }

        try {
            // 2. Update Data Utama
            $this->report->update([
                'category_id' => $this->category_id,
                'title' => $this->title,
                'description' => $this->description,
                'location_address' => $this->location_address,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'priority' => $this->priority,
            ]);

            // 3. Handle New Attachments (Upload File Baru)
            if (!empty($this->newAttachments)) {
                foreach ($this->newAttachments as $file) {
                    try {
                        $originalName = $file->getClientOriginalName();
                        $extension = $file->extension() ?: pathinfo($originalName, PATHINFO_EXTENSION);
                        $fileName = \Illuminate\Support\Str::random(40) . '.' . $extension;
                        $path = $file->storeAs('report_attachments', $fileName, 'public');

                        ReportAttachment::create([
                            'report_id' => $this->report->id,
                            'user_id' => auth()->id(),
                            'filename' => $fileName,
                            'original_name' => $originalName,
                            'mime_type' => $file->getMimeType() ?? 'application/octet-stream',
                            'file_size' => $file->getSize(),
                            'file_path' => $path,
                            'is_public' => true,
                        ]);
                    } catch (\Exception $e) {
                        continue;
                    }
                }
            }

            // 4. Sukses
            $this->newAttachments = []; // Reset input file
            $this->existingAttachments = $this->report->refresh()->attachments; // Refresh list file lama
            $this->success = true;
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal mengupdate laporan: ' . $e->getMessage());
        }
    }

    // Fungsi menghapus file lama yang sudah ada di database
    public function deleteExistingAttachment($attachmentId)
    {
        $attachment = ReportAttachment::find($attachmentId);

        if ($attachment && $attachment->report_id === $this->report->id) {
            // Hapus file fisik dari storage
            if (Storage::disk('public')->exists($attachment->file_path)) {
                Storage::disk('public')->delete($attachment->file_path);
            }

            // Hapus record dari database
            $attachment->delete();

            // Refresh list
            $this->existingAttachments = $this->report->refresh()->attachments;
        }
    }

    // Fungsi menghapus file baru yang belum disubmit (dari array upload sementara)
    public function removeNewAttachment($index)
    {
        array_splice($this->newAttachments, $index, 1);
    }

    public function getCurrentLocation()
    {
        $this->dispatch('get-current-location');
    }

    public function setLocationData($latitude, $longitude, $address = null)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        if ($address) $this->location_address = $address;
    }

    public function render()
    {
        $categories = ReportCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('livewire.edit-report', [
            'categories' => $categories
        ]);
    }
}
