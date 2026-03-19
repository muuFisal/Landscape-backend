@extends('dashboard.master', ['title' => __('dashboard.request-service-section')])
@section('request-service-active', 'active')
@section('settings-open', 'open')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{ __('dashboard.request-service-section') }}</h4>
                </div>
                <div class="card-body mt-2">
                    @livewire('dashboard.settings.request-service.request-service-update')
                </div>
            </div>
        </div>
    </div>
@endsection
