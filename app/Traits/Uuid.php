<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uuid {
    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::orderedUuid();
        });
    }
}