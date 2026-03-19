<x-update-modal title="{{ __('dashboard.update-service') }}">
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label">{{ __('dashboard.title-ar') }}</label>
            <input type="text" class="form-control" wire:model.defer="title_ar">
            @include('dashboard.includes.error', ['property' => 'title_ar'])
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label">{{ __('dashboard.title-en') }}</label>
            <input type="text" class="form-control" wire:model.defer="title_en">
            @include('dashboard.includes.error', ['property' => 'title_en'])
        </div>
        <div class="mb-1 col-md-12">
            <label class="form-label">{{ __('dashboard.description-ar') }}</label>
            <textarea class="form-control" rows="2" wire:model.defer="description_ar"></textarea>
            @include('dashboard.includes.error', ['property' => 'description_ar'])
        </div>
        <div class="mb-1 col-md-12">
            <label class="form-label">{{ __('dashboard.description-en') }}</label>
            <textarea class="form-control" rows="2" wire:model.defer="description_en"></textarea>
            @include('dashboard.includes.error', ['property' => 'description_en'])
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-check-label d-block mb-50">{{ __('dashboard.has_projects') }}</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" wire:model.defer="has_projects" id="update_has_projects">
                <label class="form-check-label" for="update_has_projects">{{ __('dashboard.yes') }}</label>
            </div>
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-check-label d-block mb-50">{{ __('dashboard.show_in_filter') }}</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" wire:model.defer="show_in_projects_filter" id="update_show_in_filter">
                <label class="form-check-label" for="update_show_in_filter">{{ __('dashboard.visible') }}</label>
            </div>
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label">{{ __('dashboard.sort-order') }}</label>
            <input type="number" class="form-control" wire:model.defer="sort_order">
            @include('dashboard.includes.error', ['property' => 'sort_order'])
        </div>
        <div class="mb-1 col-md-12 text-center">
             @if ($image && !($image instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile))
                <img src="{{ asset($image) }}" width="120" class="img-fluid rounded mb-1">
             @elseif($image instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                <img src="{{ $image->temporaryUrl() }}" width="120" class="img-fluid rounded mb-1">
             @endif
            <label class="form-label d-block text-start">{{ __('dashboard.image') }}</label>
            <input type="file" class="form-control" wire:model="image">
            @include('dashboard.includes.error', ['property' => 'image'])
        </div>
    </div>
</x-update-modal>

