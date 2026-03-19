@extends('dashboard.master', ['title' => __('dashboard.services-page')])
@section('services-page-active', 'active')
@section('services-open', 'open')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('dashboard.services-page-details') }}</h4>
                </div>
                <div class="card-body">
                    @livewire('dashboard.settings.services.services-page-update')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('UpdateMS', function() {
                Swal.fire({
                    position: 'top-start',
                    icon: 'success',
                    title: '{{ __('dashboard.updated-successfully') }}',
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: { confirmButton: 'btn btn-primary' },
                    buttonsStyling: false
                });
            });
        });
    </script>
@endpush
