@extends('dashboard.master', ['title' => __('dashboard.services')])
@section('services-active', 'active')
@section('services-open', 'open')
@section('services-open', 'open')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('dashboard.services') }}</h4>
                    <button type="button" class="btn btn-primary waves-effect" data-bs-toggle="modal"
                        data-bs-target="#createModal">
                        <i data-feather='plus'></i> {{ __('dashboard.add-item') }}
                    </button>
                </div>
                @livewire('dashboard.services.service-create')
                @livewire('dashboard.services.service-update')
                <div class="card-body">
                    @livewire('dashboard.services.service-data')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('serviceAddMS', function() {
                Swal.fire({
                    position: 'top-start',
                    icon: 'success',
                    title: '{{ __('dashboard.add-successfully') }}',
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: { confirmButton: 'btn btn-primary' },
                    buttonsStyling: false
                });
            });

            Livewire.on('serviceUpdateMS', function() {
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

            Livewire.on('StatusUpdateMS', function() {
                Swal.fire({
                    position: 'top-start',
                    icon: 'success',
                    title: '{{ __('dashboard.status-change') }}',
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: { confirmButton: 'btn btn-primary' },
                    buttonsStyling: false
                });
            });

            Livewire.on('deleteItem', function(data) {
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

            window.addEventListener('open-edit-modal', event => {
                $('#editModal').modal('show');
            });

            window.addEventListener('close-edit-modal', event => {
                $('#editModal').modal('hide');
            });
            
            window.addEventListener('close-modal', event => {
                $('#createModal').modal('hide');
            });
        });
    </script>
@endpush
