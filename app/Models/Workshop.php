<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'instructor',
        'instructor_title',
        'description',
        'start_time',
        'end_time',
        'location',
        'price',
        'quota',
        'image',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'price' => 'integer',
        'quota' => 'integer',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function getRemainingQuotaAttribute()
    {
        $paidCount = $this->registrations()->where('payment_status', 'paid')->count();
        return max(0, $this->quota - $paidCount);
    }
}
