<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportCategory;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::with(['category', 'user'])
            ->where('is_public', true)
            ->latest('created_at');

        // Apply search filter
        if ($request->get('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->get('search') . '%')
                  ->orWhere('description', 'like', '%' . $request->get('search') . '%')
                  ->orWhere('location_address', 'like', '%' . $request->get('search') . '%');
            });
        }

        // Apply category filter
        if ($request->get('categoryFilter')) {
            $query->where('category_id', $request->get('categoryFilter'));
        }

        // Apply status filter
        if ($request->get('statusFilter')) {
            $query->where('status', $request->get('statusFilter'));
        }

        $reports = $query->paginate(12);

        $categories = ReportCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('reports.index', [
            'reports' => $reports,
            'categories' => $categories,
            'search' => $request->get('search', ''),
            'categoryFilter' => $request->get('categoryFilter', ''),
            'statusFilter' => $request->get('statusFilter', ''),
        ]);
    }

    public function show($id)
    {
        $report = Report::with(['category', 'user', 'comments', 'attachments'])
            ->where('id', $id)
            ->where('is_public', true)
            ->firstOrFail();

        return view('reports.show', [
            'report' => $report,
            'statusBadgeColor' => $this->getStatusBadgeColor($report->status),
            'statusText' => $this->getStatusText($report->status),
            'priorityBadgeColor' => $this->getPriorityBadgeColor($report->priority),
            'priorityText' => $this->getPriorityText($report->priority),
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