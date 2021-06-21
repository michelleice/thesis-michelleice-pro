<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait APIToken {
    public function getAPIKeyName() {
        return 'api_token';
    }
    public function generateAPIToken() {
        $this->{$this->getAPIKeyName()} = (string) Str::random(64);
        $this->save();
    }
    public function removeAPIToken() {
        $this->{$this->getAPIKeyName()} = null;
        $this->save();
    }
}
