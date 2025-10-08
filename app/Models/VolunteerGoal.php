<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VolunteerGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'goal_type',
        'target_hours',
        'current_hours',
        'period_type',
        'start_date',
        'end_date',
        'category',
        'description',
        'is_active',
        'is_achieved',
        'achieved_at',
        'milestone_settings'
    ];

    protected $casts = [
        'target_hours' => 'decimal:2',
        'current_hours' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'is_achieved' => 'boolean',
        'achieved_at' => 'datetime',
        'milestone_settings' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCurrent($query)
    {
        $now = Carbon::now();
        return $query->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
    }

    public function getProgressPercentageAttribute()
    {
        if ($this->target_hours <= 0) return 0;
        return min(100, ($this->current_hours / $this->target_hours) * 100);
    }

    public function getRemainingHoursAttribute()
    {
        return max(0, $this->target_hours - $this->current_hours);
    }

    public function getDaysRemainingAttribute()
    {
        return Carbon::now()->diffInDays($this->end_date, false);
    }

    public function getIsOverdueAttribute()
    {
        return Carbon::now()->isAfter($this->end_date) && !$this->is_achieved;
    }

    public function updateCurrentHours()
    {
        $volunteerHours = $this->user->volunteerHours()
            ->whereBetween('date', [$this->start_date, $this->end_date])
            ->where('status', 'approved')
            ->sum('hours');


        $checkedInHours = \DB::table('activity_participants')
            ->join('activities', 'activity_participants.activity_id', '=', 'activities.id')
            ->where('activity_participants.user_id', $this->user_id)
            ->where('activity_participants.checked_in', true)
            ->sum(\DB::raw('COALESCE(activity_participants.actual_hours, activities.total_hour)'));

        $totalHours = $checkedInHours;

        $this->update([
            'current_hours' => $totalHours,
            'is_achieved' => $totalHours >= $this->target_hours,
            'achieved_at' => $totalHours >= $this->target_hours && !$this->is_achieved
                ? Carbon::now()
                : $this->achieved_at
        ]);

        return $this;
    }
}
