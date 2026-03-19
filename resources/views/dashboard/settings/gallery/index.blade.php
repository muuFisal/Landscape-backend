@extends('dashboard.master', ['title' => __('dashboard.gallery-page')])
@section('gallery-page-active', 'active')
@section('settings-open', 'open')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{ __('dashboard.gallery-page') }}</h4>
                </div>
                <div class="card-body mt-2">
                    @livewire('dashboard.settings.gallery.gallery-page-update')
                </div>
            </div>
        </div>
    </div>
@endsection
