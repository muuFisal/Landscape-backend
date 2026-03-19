<div>
    <form class="form form-horizontal" wire:submit.prevent='submit'>
        <div class="border rounded p-2 mb-3">
            <h5 class="mb-2 text-primary text-capitalize">{{ __('dashboard.why-choose-section') }}</h5>
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

        <div class="border rounded p-2 mb-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="mb-0 text-primary">{{ __('dashboard.why-choose-items') }}</h5>
                <button type="button" class="btn btn-sm btn-outline-primary" wire:click="addItem">{{ __('dashboard.add-item') }}</button>
            </div>

            @foreach ($items as $index => $item)
                <div class="border rounded p-2 mb-2">
                    <div class="d-flex justify-content-between mb-2">
                        <strong>#{{ $index + 1 }}</strong>
                        <button type="button" class="btn btn-sm btn-outline-danger" wire:click="removeItem({{ $index }})">{{ __('dashboard.delete') }}</button>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label">{{ __('dashboard.item-title-ar') }}</label>
                            <input type="text" class="form-control" wire:model.defer="items.{{ $index }}.title.ar">
                            @include('dashboard.includes.error', ['property' => 'items.' . $index . '.title.ar'])
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label">{{ __('dashboard.item-title-en') }}</label>
                            <input type="text" class="form-control" wire:model.defer="items.{{ $index }}.title.en">
                            @include('dashboard.includes.error', ['property' => 'items.' . $index . '.title.en'])
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label">{{ __('dashboard.item-desc-ar') }}</label>
                            <textarea class="form-control" rows="3" wire:model.defer="items.{{ $index }}.description.ar"></textarea>
                            @include('dashboard.includes.error', ['property' => 'items.' . $index . '.description.ar'])
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label">{{ __('dashboard.item-desc-en') }}</label>
                            <textarea class="form-control" rows="3" wire:model.defer="items.{{ $index }}.description.en"></textarea>
                            @include('dashboard.includes.error', ['property' => 'items.' . $index . '.description.en'])
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="form-label">{{ __('dashboard.sort-order') }}</label>
                            <input type="number" class="form-control" wire:model.defer="items.{{ $index }}.sort_order">
                            @include('dashboard.includes.error', ['property' => 'items.' . $index . '.sort_order'])
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">{{ __('dashboard.submit') }}</button>
    </form>
</div>
