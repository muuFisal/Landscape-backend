<div>
    <form class="form form-horizontal" wire:submit.prevent='submit'>
        <div class="border rounded p-2 mb-3">
            <h5 class="mb-2 text-primary text-capitalize">{{ __('dashboard.request-service-section') }}</h5>
            
            <div class="row">
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.eyebrow-ar') }}</label>
                    <input type="text" class="form-control" wire:model.defer="small_label_ar">
                    @include('dashboard.includes.error', ['property' => 'small_label_ar'])
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.eyebrow-en') }}</label>
                    <input type="text" class="form-control" wire:model.defer="small_label_en">
                    @include('dashboard.includes.error', ['property' => 'small_label_en'])
                </div>
            </div>

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
            </div>

            <div class="mb-1">
                <label class="form-label">{{ __('dashboard.description-ar') }}</label>
                <textarea class="form-control" rows="3" wire:model.defer="description_ar"></textarea>
                @include('dashboard.includes.error', ['property' => 'description_ar'])
            </div>

            <div class="mb-1">
                <label class="form-label">{{ __('dashboard.description-en') }}</label>
                <textarea class="form-control" rows="3" wire:model.defer="description_en"></textarea>
                @include('dashboard.includes.error', ['property' => 'description_en'])
            </div>

            <div class="row">
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.btn-text-ar') }}</label>
                    <input type="text" class="form-control" wire:model.defer="btn_text_ar">
                    @include('dashboard.includes.error', ['property' => 'btn_text_ar'])
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.btn-text-en') }}</label>
                    <input type="text" class="form-control" wire:model.defer="btn_text_en">
                    @include('dashboard.includes.error', ['property' => 'btn_text_en'])
                </div>
            </div>

            <div class="mb-1">
                <label class="form-label">{{ __('dashboard.image') }}</label>
                <div class="mb-2 p-1 border rounded bg-light-subtle">
                    @if ($image instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                        <img src="{{ $image->temporaryUrl() }}" width="180" class="img-fluid">
                    @elseif(!empty($image))
                        <img src="{{ asset($image) }}" width="180" class="img-fluid">
                    @endif
                </div>
                <input type="file" class="form-control" wire:model="image">
                @include('dashboard.includes.error', ['property' => 'image'])
            </div>
        </div>

        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">{{ __('dashboard.submit') }}</button>
    </form>
</div>
