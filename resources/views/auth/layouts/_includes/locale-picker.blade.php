@php
    $url = request()->url();
    $queries = request()->query();
    if (\array_key_exists('lang', $queries)) {
        unset($queries['lang']);
    }
    $qs = '?';
    foreach ($queries as $key => $value) {
        $key = \urlencode($key);
        $value = \urlencode($value);
        $qs .= "{$key}={$value}&";
    }
@endphp
<div class="dropdown position-absolute">
    <button class="btn btn-link text-dark dropdown-toggle text-decoration-none" id="displayLanguageList" data-toggle="dropdown">
        <i class="fas fa-globe"></i>
    </button>

    <div class="dropdown-menu" aria-labelledby="displayLanguageList">

        <a class="dropdown-item" href="{{ $qs }}lang=id">Bahasa Indonesia</a>
        <a class="dropdown-item" href="{{ $qs }}lang=en">English</a>
    </div>
</div>