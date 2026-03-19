<x-create-modal title="{{ __('dashboard.add-item') }}">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="mb-1 col-md-6">
                    <label class="form-label font-weight-bold">{{ __('dashboard.service') }}</label>
                    <select class="form-select" wire:model.defer="service_id">
                        <option value="">{{ __('dashboard.select-service') }}</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->title }}</option>
                        @endforeach
                    </select>
                    @include('dashboard.includes.error', ['property' => 'service_id'])
                </div>
                <div class="mb-1 col-md-3">
                    <label class="form-label font-weight-bold">{{ __('dashboard.year') }}</label>
                    <input type="text" class="form-control" wire:model.defer="year" placeholder="e.g. 2024">
                    @include('dashboard.includes.error', ['property' => 'year'])
                </div>
                <div class="mb-1 col-md-3">
                    <label class="form-label font-weight-bold">{{ __('dashboard.sort-order') }}</label>
                    <input type="number" class="form-control" wire:model.defer="sort_order">
                    @include('dashboard.includes.error', ['property' => 'sort_order'])
                </div>
            </div>

            <hr class="my-2">
            <h6 class="mb-1 text-primary">{{ __('dashboard.title_and_intro') }}</h6>
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
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.short-description-ar') }}</label>
                    <textarea class="form-control" rows="2" wire:model.defer="short_description_ar"></textarea>
                    @include('dashboard.includes.error', ['property' => 'short_description_ar'])
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.short-description-en') }}</label>
                    <textarea class="form-control" rows="2" wire:model.defer="short_description_en"></textarea>
                    @include('dashboard.includes.error', ['property' => 'short_description_en'])
                </div>
            </div>

            <hr class="my-2">
            <h6 class="mb-1 text-primary">{{ __('dashboard.location_and_area') }}</h6>
            <div class="row">
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.location-ar') }}</label>
                    <input type="text" class="form-control" wire:model.defer="location_ar">
                    @include('dashboard.includes.error', ['property' => 'location_ar'])
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.location-en') }}</label>
                    <input type="text" class="form-control" wire:model.defer="location_en">
                    @include('dashboard.includes.error', ['property' => 'location_en'])
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.area-ar') }}</label>
                    <input type="text" class="form-control" wire:model.defer="area_ar">
                    @include('dashboard.includes.error', ['property' => 'area_ar'])
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.area-en') }}</label>
                    <input type="text" class="form-control" wire:model.defer="area_en">
                    @include('dashboard.includes.error', ['property' => 'area_en'])
                </div>
            </div>

            <hr class="my-2">
            <h6 class="mb-1 text-primary">{{ __('dashboard.challenge_block') }}</h6>
            <div class="row">
                 <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.challenge-title-ar') }}</label>
                    <input type="text" class="form-control" wire:model.defer="challenge_title_ar" placeholder="التحدي">
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.challenge-title-en') }}</label>
                    <input type="text" class="form-control" wire:model.defer="challenge_title_en" placeholder="The Challenge">
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.description-ar') }}</label>
                    <textarea class="form-control" rows="2" wire:model.defer="challenge_description_ar"></textarea>
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.description-en') }}</label>
                    <textarea class="form-control" rows="2" wire:model.defer="challenge_description_en"></textarea>
                </div>
            </div>

            <hr class="my-2">
            <h6 class="mb-1 text-primary">{{ __('dashboard.solution_block') }}</h6>
            <div class="row">
                 <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.solution-title-ar') }}</label>
                    <input type="text" class="form-control" wire:model.defer="solution_title_ar" placeholder="الحل">
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.solution-title-en') }}</label>
                    <input type="text" class="form-control" wire:model.defer="solution_title_en" placeholder="The Solution">
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.description-ar') }}</label>
                    <textarea class="form-control" rows="2" wire:model.defer="solution_description_ar"></textarea>
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.description-en') }}</label>
                    <textarea class="form-control" rows="2" wire:model.defer="solution_description_en"></textarea>
                </div>
            </div>

            <hr class="my-2">
            <h6 class="mb-1 text-primary">{{ __('dashboard.project_facts') }}</h6>
            <div class="row mb-1">
                @foreach($facts as $index => $fact)
                    <div class="col-md-6 mb-50 d-flex gap-50">
                        <input type="text" class="form-control form-control-sm" wire:model.defer="facts.{{ $index }}" placeholder="Fact/Tag">
                        <button type="button" class="btn btn-sm btn-outline-danger" wire:click="removeFact({{ $index }})">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                @endforeach
                <div class="col-12 mt-50">
                    <button type="button" class="btn btn-sm btn-outline-success" wire:click="addFact">
                        <i data-feather="plus"></i> {{ __('dashboard.add-fact') }}
                    </button>
                </div>
            </div>

            <hr class="my-2">
            <h6 class="mb-1 text-primary text-capitalize">{{ __('dashboard.project-gallery') }}</h6>
            <div class="mb-1">
                 <label class="form-label font-weight-bold">{{ __('dashboard.gallery-images') }}</label>
                 <input type="file" class="form-control" wire:model="gallery_images" multiple>
                 <p class="small text-muted mt-50">You can select multiple images. Max 4MB per image.</p>
                 @include('dashboard.includes.error', ['property' => 'gallery_images.*'])
            </div>
            
            <div class="row mt-1" wire:loading wire:target="gallery_images">
                <div class="col-12 text-center">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p>{{ __('dashboard.uploading') }}...</p>
                </div>
            </div>
            
            <div class="row mt-1 bg-light p-1 rounded">
                @foreach ($gallery_images as $tempImg)
                    <div class="col-md-2 mb-1">
                        <img src="{{ $tempImg->temporaryUrl() }}" class="img-fluid rounded border shadow-sm">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-create-modal>
