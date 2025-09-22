<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_name',
        'description',
        'hours',
        'date',
        'status'
    ];

    protected $casts = [
        'date' => 'date',
        'hours' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
