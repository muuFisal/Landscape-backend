<x-update-modal title="{{ __('dashboard.update-gallery-item') }}">
    <form class="form form-horizontal" wire:submit.prevent='submit'>
        <div class="row">
            <div class="mb-1 col-md-6">
                <label class="form-label">{{ __('dashboard.name-ar') }}</label>
                <input type="text" class="form-control" wire:model.defer="title_ar">
                @include('dashboard.includes.error', ['property' => 'title_ar'])
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label">{{ __('dashboard.name-en') }}</label>
                <input type="text" class="form-control" wire:model.defer="title_en">
                @include('dashboard.includes.error', ['property' => 'title_en'])
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label">{{ __('dashboard.sort-order') }}</label>
                <input type="number" class="form-control" wire:model.defer="sort_order">
                @include('dashboard.includes.error', ['property' => 'sort_order'])
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label">{{ __('dashboard.status') }}</label>
                <select class="form-select" wire:model.defer="status">
                    <option value="1">{{ __('dashboard.active') }}</option>
                    <option value="0">{{ __('dashboard.inactive') }}</option>
                </select>
                @include('dashboard.includes.error', ['property' => 'status'])
            </div>
            <div class="mb-1 col-md-12 text-center">
                @if ($galleryModel && $galleryModel->image)
                    <img src="{{ asset($galleryModel->image) }}" width="120" class="img-fluid mb-1">
                @endif
            </div>
            <div class="mb-1 col-md-12">
                <label class="form-label">{{ __('dashboard.image') }}</label>
                <input type="file" class="form-control" wire:model="image">
                @include('dashboard.includes.error', ['property' => 'image'])
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">{{ __('dashboard.save') }}</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('dashboard.close') }}</button>
        </div>
    </form>
</x-update-modal>
