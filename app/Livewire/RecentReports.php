<?php

namespace App\Livewire;

use App\Models\Report;
use Livewire\Component;
use Livewire\WithPagination;

class RecentReports extends Component
{
    use WithPagination;

    public $limit = 6;
    public $showPagination = false;

    public function mount($limit = 6, $showPagination = false)
    {
        $this->limit = $limit;
        $this->showPagination = $showPagination;
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
