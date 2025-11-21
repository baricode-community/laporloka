<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'location_address',
        'location_latitude',
        'location_longitude',
        'status',
        'priority',
        'report_number',
        'reported_at',
        'resolved_at',
        'admin_notes',
        'assigned_to',
        'views_count',
        'is_public',
    ];

    protected $casts = [
        'location_latitude' => 'decimal:8',
        'location_longitude' => 'decimal:8',
        'reported_at' => 'datetime',
        'resolved_at' => 'datetime',
        'views_count' => 'integer',
        'is_public' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ReportCategory::class);
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ReportComment::class)->latest();
    }

    public function publicComments(): HasMany
    {
        return $this->comments()->where('is_internal', false);
    }

    public function internalComments(): HasMany
    {
        return $this->comments()->where('is_internal', true);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(ReportAttachment::class);
    }

    public function publicAttachments(): HasMany
    {
        return $this->attachments()->where('is_public', true);
    }

    public function isResolved(): bool
    {
        return $this->status === 'resolved';
    }

    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function getStatusColor(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'reviewed' => 'blue',
            'in_progress' => 'orange',
            'resolved' => 'green',
            'rejected' => 'red',
            default => 'gray',
        };
    }

    public function getPriorityColor(): string
    {
        return match($this->priority) {
            'low' => 'gray',
            'medium' => 'blue',
            'high' => 'orange',
            'urgent' => 'red',
            default => 'gray',
        };
    }

    public function getStatusBadgeColor($status = null): string
    {
        $status = $status ?? $this->status;
        return match($status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'reviewed' => 'bg-blue-100 text-blue-800',
            'in_progress' => 'bg-orange-100 text-orange-800',
            'resolved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getStatusText($status = null): string
    {
        $status = $status ?? $this->status;
        return match($status) {
            'pending' => 'Menunggu',
            'reviewed' => 'Ditinjau',
            'in_progress' => 'Diproses',
            'resolved' => 'Selesai',
            'rejected' => 'Ditolak',
            default => 'Tidak Diketahui',
        };
    }

    public function getPriorityBadgeColor($priority = null): string
    {
        $priority = $priority ?? $this->priority;
        return match($priority) {
            'low' => 'bg-gray-100 text-gray-800',
            'medium' => 'bg-blue-100 text-blue-800',
            'high' => 'bg-orange-100 text-orange-800',
            'urgent' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getPriorityText($priority = null): string
    {
        $priority = $priority ?? $this->priority;
        return match($priority) {
            'low' => 'Rendah',
            'medium' => 'Sedang',
            'high' => 'Tinggi',
            'urgent' => 'Mendesak',
            default => 'Sedang',
        };
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($report) {
            if (empty($report->report_number)) {
                $report->report_number = 'LP-' . date('Y') . '-' . str_pad(static::max('id') + 1, 6, '0', STR_PAD_LEFT);
            }
            if (empty($report->reported_at)) {
                $report->reported_at = now();
            }
        });
    }
}
