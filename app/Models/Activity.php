<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_th',
        'status',
        'description',
        'location',
        'start_time',
        'end_time',
        'accept_amount',
        'create_by',
        'image_file_name',
        'total_hour',
        'tags'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'tags' => 'array',
        'accept_amount' => 'integer',
        'create_by' => 'integer',
        'total_hour' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'create_by');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'ongoing']);
    }
}
