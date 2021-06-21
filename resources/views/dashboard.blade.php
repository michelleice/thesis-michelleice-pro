@extends('layouts.admin')

@section('content')
<x-page-header>
    <x-slot name="title">@lang('Dashboard')</x-slot>

    <li class="breadcrumb-item active">@lang('Dashboard')</li>
</x-page-header>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            @lang('Status')
                        </h3>
                    </div>
                    <div class="card-body">
                        <i class="fas fa-check mr-1 text-success"></i> @lang('All systems operational')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection