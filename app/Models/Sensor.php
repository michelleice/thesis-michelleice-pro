<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function device() {
        return $this->belongsTo(Device::class);
    }
    public function sensorValues() {
        return $this->hasMany(SensorValue::class);
    }
}
