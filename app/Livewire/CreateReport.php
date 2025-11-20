<?php

namespace App\Livewire;

use App\Models\Report;
use App\Models\ReportCategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class CreateReport extends Component
{
    use WithFileUploads;

    #[Validate('required|string|min:5|max:255')]
    public $title = '';

    #[Validate('required|string|min:10')]
    public $description = '';

    #[Validate('required|exists:report_categories,id')]
    public $category_id = '';

    #[Validate('required|string|max:500')]
    public $location_address = '';

    #[Validate('nullable|numeric|between:-90,90')]
    public $latitude = '';

    #[Validate('nullable|numeric|between:-180,180')]
    public $longitude = '';

    #[Validate('nullable|array|max:5')]
    public $attachments = [];

    #[Validate('nullable|in:low,medium,high,urgent')]
    public $priority = 'medium';

    public $success = false;
    public $reportNumber = '';

    public function mount()
    {
        $this->priority = 'medium';
    }

    public function submitReport()
    {
        $this->validate();

        // Check if user is authenticated for creating reports
        if (!auth()->check()) {
            session()->flash('error', 'Anda harus login terlebih dahulu untuk membuat laporan.');
            return redirect()->route('login');
        }

        try {
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

            // Handle file attachments if needed (for future implementation)
            // ... attachment handling code

            $this->reportNumber = $report->report_number;
            $this->success = true;
            $this->resetForm();

            // Broadcast event to refresh recent reports
            $this->dispatch('reportCreated', $report->id);
            
            session()->flash('success', "Laporan berhasil dibuat dengan nomor: {$this->reportNumber}");
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menyimpan laporan. Silakan coba lagi.');
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
        // This will trigger JavaScript to get current location
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

    public function render()
    {
        $categories = ReportCategory::where('is_active', true)->orderBy('sort_order')->get();
        
        return view('livewire.create-report', [
            'categories' => $categories,
        ]);
    }
}
