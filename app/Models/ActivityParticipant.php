<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'user_id',
        'status',
        'registered_at',
        'notes',
        'checked_in',
        'checked_in_at',
        'checked_in_by',
        'actual_hours',
        'checkin_notes'
    ];

    protected $casts = [
        'registered_at' => 'datetime',
        'checked_in_at' => 'datetime',
        'checked_in' => 'boolean',
        'actual_hours' => 'decimal:2'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkedInBy()
    {
        return $this->belongsTo(User::class, 'checked_in_by');
    }

    // Helper methods for status checking
    public function isCheckedIn()
    {
        return $this->checked_in;
    }

    public function getCheckinStatusAttribute()
    {
        if ($this->checked_in) {
            return 'checked_in';
        }

        if ($this->status === 'registered') {
            return 'registered';
        }

        return $this->status;
    }

    public function getStatusBadgeAttribute()
    {
        switch ($this->checkin_status) {
            case 'checked_in':
                return [
                    'class' => 'bg-green-100 text-green-800',
                    'text' => 'เช็คชื่อแล้ว',
                    'icon' => '✓'
                ];
            case 'registered':
                return [
                    'class' => 'bg-blue-100 text-blue-800',
                    'text' => 'ลงทะเบียนแล้ว',
                    'icon' => '📋'
                ];
            case 'completed':
                return [
                    'class' => 'bg-purple-100 text-purple-800',
                    'text' => 'เสร็จสิ้น',
                    'icon' => '🏆'
                ];
            default:
                return [
                    'class' => 'bg-gray-100 text-gray-800',
                    'text' => 'ยังไม่ได้เช็คชื่อ',
                    'icon' => '⏳'
                ];
        }
    }
}
