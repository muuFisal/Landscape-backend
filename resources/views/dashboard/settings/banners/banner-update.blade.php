<x-update-modal title="{{ __('dashboard.update-banner') }}">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-1">
                <label class="form-label">{{ __('dashboard.title-ar') }}</label>
                <input type="text" wire:model='title_ar' class="form-control">
                @include('dashboard.includes.error', ['property' => 'title_ar'])
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-1">
                <label class="form-label">{{ __('dashboard.title-en') }}</label>
                <input type="text" wire:model='title_en' class="form-control">
                @include('dashboard.includes.error', ['property' => 'title_en'])
            </div>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-md-6">
            <div class="mb-1">
                <label class="form-label">{{ __('dashboard.primary-label-ar') }}</label>
                <input type="text" wire:model='primary_label_ar' class="form-control">
                @include('dashboard.includes.error', ['property' => 'primary_label_ar'])
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-1">
                <label class="form-label">{{ __('dashboard.primary-label-en') }}</label>
                <input type="text" wire:model='primary_label_en' class="form-control">
                @include('dashboard.includes.error', ['property' => 'primary_label_en'])
            </div>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-md-6">
            <div class="mb-1">
                <label class="form-label">{{ __('dashboard.secondary-label-ar') }}</label>
                <input type="text" wire:model='secondary_label_ar' class="form-control">
                @include('dashboard.includes.error', ['property' => 'secondary_label_ar'])
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-1">
                <label class="form-label">{{ __('dashboard.secondary-label-en') }}</label>
                <input type="text" wire:model='secondary_label_en' class="form-control">
                @include('dashboard.includes.error', ['property' => 'secondary_label_en'])
            </div>
        </div>
    </div>

    <div class="border rounded p-2 mt-2 mb-2">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <h6 class="mb-0">{{ __('dashboard.sub-labels') }}</h6>
            <button type="button" class="btn btn-sm btn-outline-primary" wire:click="addSubLabel">{{ __('dashboard.add') }}</button>
        </div>
        @foreach($sub_labels as $index => $label)
            <div class="row mb-1 align-items-end">
                <div class="col-md-5">
                    <label class="form-label">{{ __('dashboard.label-ar') }}</label>
                    <input type="text" wire:model="sub_labels.{{ $index }}.ar" class="form-control form-control-sm">
                </div>
                <div class="col-md-5">
                    <label class="form-label">{{ __('dashboard.label-en') }}</label>
                    <input type="text" wire:model="sub_labels.{{ $index }}.en" class="form-control form-control-sm">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-sm btn-danger" wire:click="removeSubLabel({{ $index }})"><i class="fa fa-trash"></i></button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @include('dashboard.includes.error', ['property' => "sub_labels.$index.ar"])
                    @include('dashboard.includes.error', ['property' => "sub_labels.$index.en"])
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-1">
                <label class="form-label">{{ __('dashboard.banner-image') }} <code>(1300*500)</code></label>
                <input type="file" wire:model='banner' class="form-control">
                @if ($banner)
                    <div class="mt-1">
                        <img src="{{ $banner->temporaryUrl() }}" width="150" class="rounded border">
                    </div>
                @elseif (isset($this->bannerModel->banner))
                    <div class="mt-1">
                        <img src="{{ asset($this->bannerModel->banner) }}" width="150" class="rounded border">
                    </div>
                @endif
                @include('dashboard.includes.error', ['property' => 'banner'])
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-1">
                <label class="form-label">{{ __('dashboard.sort-order') }}</label>
                <input type="number" wire:model="sort_order" class="form-control">
                @include('dashboard.includes.error', ['property' => 'sort_order'])
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-1">
                <label class="form-label">{{ __('dashboard.status') }}</label>
                <select wire:model="status" class="form-control">
                    <option value="1">{{ __('dashboard.active') }}</option>
                    <option value="0">{{ __('dashboard.inactive') }}</option>
                </select>
                @include('dashboard.includes.error', ['property' => 'status'])
            </div>
        </div>
    </div>
</x-update-modal>
