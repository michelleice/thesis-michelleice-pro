@extends('layouts.admin')

@push('scripts')
<script src="{{ asset('js/views/devices/show.js') }}"></script>
@endpush

@section('content')
<x-page-header>
    <x-slot name="title">{{ $device->name }}</x-slot>

    <li class="breadcrumb-item">@lang('Devices')</li>
    <li class="breadcrumb-item active">@lang('Details')</li>
</x-page-header>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('Details')</h3>
                    </div>
                    <div class="card-body">
                        <h6 class="font-weight-bold mb-3">{{ $device->name }}
                            <small class="mt-2 d-block">@lang('Alias'): <span class="text-monospace rounded p-1" style="background-color: rgba(0, 0, 0, .15);">{{ $device->alias }}</span></small>
                        </h6>
                        <div class="text-muted">
                            <span class="d-block"><i class="fas fa-sign-in-alt mr-1"></i> {{ $device->sensors()->count() }} @lang('sensor(s) connected')</span>
                            <small class="ml-4">
                                @foreach ($device->sensors as $sensor)
                                     <span class="text-monospace">{{ $sensor->alias }}</span> ({{ $sensor->type }})@if (!$loop->last),@endif
                                @endforeach
                            </small>
                            <span class="d-block"><i class="fas fa-sign-out-alt mr-1"></i> {{ $device->outputs()->count() }} @lang('available output(s)')</span>
                            <small class="ml-4">
                                @foreach ($device->outputs as $output)
                                     <span class="text-monospace">{{ $output->alias }}</span> ({{ $output->type }})@if (!$loop->last),@endif
                                @endforeach
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($device->sensors as $sensor)
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <div class="mb-2">@lang('Sensor'): {{ $sensor->type }}</div>
                                <div>
                                    <small>@lang('Alias'): <span class="text-monospace rounded p-1" style="background-color: rgba(0, 0, 0, .15);">{{ $sensor->alias }}</span></small>
                                </div>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#configure-sensor-modal" data-sensor-id="{{ $sensor->id }}">
                                    <i class="fas fa-cog" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Configure this sensor for this device."></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas class="sensor-reading" data-sensor-id="{{ $sensor->id }}"></canvas>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection