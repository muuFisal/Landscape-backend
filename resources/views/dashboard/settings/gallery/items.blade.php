@extends('dashboard.master', ['title' => __('dashboard.gallery-items')])
@section('gallery-items-active', 'active')
@section('gallery-open', 'open')
@section('settings-open', 'open')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{ __('dashboard.gallery-items') }}</h4>
                    <button type="button" class="btn btn-primary waves-effect" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fa-solid fa-plus"></i> {{ __('dashboard.create-gallery-item') }}
                    </button>
                </div>
                @livewire('dashboard.settings.gallery.gallery-create')
                @livewire('dashboard.settings.gallery.gallery-update')
                <div class="card-body mt-2">
                    @livewire('dashboard.settings.gallery.gallery-data')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('galleryAddMS', function() {
                Swal.fire({
                    position: 'top-start',
                    icon: 'success',
                    title: '{{ __('dashboard.add-successfully') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
            Livewire.on('galleryUpdateMS', function() {
                Swal.fire({
                    position: 'top-start',
                    icon: 'success',
                    title: '{{ __('dashboard.updated-successfully') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
            Livewire.on('StatusUpdateMS', function() {
                Swal.fire({
                    position: 'top-start',
                    icon: 'success',
                    title: '{{ __('dashboard.status-change') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
            Livewire.on('deleteItemConfirm', function(data) {
                Swal.fire({
                    title: "{{ __('dashboard.are_you_sure') }}",
                    text: "{{ __('dashboard.confirm_delete_message') }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "{{ __('dashboard.yes_delete') }}",
                    cancelButtonText: "{{ __('dashboard.cancel') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('deleteItem', { id: data.id });
                    }
                });
            });
            window.addEventListener('itemDeleted', function() {
                Swal.fire({
                    title: "{{ __('dashboard.success') }}",
                    text: "{{ __('dashboard.item_deleted_successfully') }}",
                    icon: "success",
                    timer: 1000
                });
            });
        });
    </script>
@endpush
