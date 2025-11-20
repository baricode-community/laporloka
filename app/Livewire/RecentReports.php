<?php

namespace App\Livewire;

use App\Models\Report;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class RecentReports extends Component
{
    use WithPagination;

    public $limit = 6;
    public $showPagination = false;
    public $newReportId = null;

    public function mount($limit = 6, $showPagination = false)
    {
        $this->limit = $limit;
        $this->showPagination = $showPagination;
    }

    #[On('reportCreated')]
    public function refreshReports($reportId = null)
    {
        // Store the new report ID for highlighting
        if ($reportId) {
            $this->newReportId = $reportId;
        }
        
        // Force refresh the reports list
        $this->resetPage();
        
        // Dispatch event for visual notification
        if ($reportId) {
            $this->dispatch('reportAdded', ['message' => 'Laporan baru telah ditambahkan!']);
            
            // Clear the highlight after 10 seconds
            $this->js('setTimeout(() => { $wire.clearNewReportHighlight(); }, 10000);');
        }
    }

    public function clearNewReportHighlight()
    {
        $this->newReportId = null;
    }

    public function render()
    {
        $query = Report::with(['category', 'user'])
            ->where('is_public', true)
            ->latest('created_at');

        if ($this->showPagination) {
            $reports = $query->paginate($this->limit);
        } else {
            $reports = $query->limit($this->limit)->get();
        }

        return view('livewire.recent-reports', [
            'reports' => $reports,
        ]);
    }

    public function getStatusBadgeColor($status)
    {
        return match($status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'reviewed' => 'bg-blue-100 text-blue-800',
            'in_progress' => 'bg-orange-100 text-orange-800',
            'resolved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getStatusText($status)
    {
        return match($status) {
            'pending' => 'Menunggu',
            'reviewed' => 'Ditinjau',
            'in_progress' => 'Diproses',
            'resolved' => 'Selesai',
            'rejected' => 'Ditolak',
            default => 'Tidak Diketahui',
        };
    }

    public function getPriorityBadgeColor($priority)
    {
        return match($priority) {
            'low' => 'bg-gray-100 text-gray-800',
            'medium' => 'bg-blue-100 text-blue-800',
            'high' => 'bg-orange-100 text-orange-800',
            'urgent' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getPriorityText($priority)
    {
        return match($priority) {
            'low' => 'Rendah',
            'medium' => 'Sedang',
            'high' => 'Tinggi',
            'urgent' => 'Mendesak',
            default => 'Sedang',
        };
    }
}
