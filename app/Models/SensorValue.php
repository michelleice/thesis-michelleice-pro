<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'recorded_at',
        'sensor_id',
        'sensor_value',
    ];
    protected $casts = [
        'recorded_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    protected $dateFormat = 'Y-m-d H:i:s.u';
    
    public function sensor() {
        return $this->belongsTo(Sensor::class);
    }

    public function scopeLatest($query) {
        return $query->orderBy('recorded_at', 'DESC');
    }
}
