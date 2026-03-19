@extends('dashboard.master', ['title' => __('dashboard.why-choose-section')])
@section('why-choose-active', 'active')
@section('settings-open', 'open')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{ __('dashboard.why-choose-section') }}</h4>
                </div>
                <div class="card-body mt-2">
                    @livewire('dashboard.settings.why-choose.why-choose-update')
                </div>
            </div>
        </div>
    </div>
@endsection
