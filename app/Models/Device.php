<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Device extends Model
{
    use HasFactory;

    protected $hidden = [
        'pin',
        'serial_number',
        'user_id',
    ];

    public function outputs() {
        return $this->hasMany(Output::class);
    }
    public function sensors() {
        return $this->hasMany(Sensor::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function refreshAuthenticationToken() {
        $this->device_authentication_token = Str::random(128);
        $this->save();
    }
}
