<x-update-modal title="{{ __('dashboard.update-project') }}">
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
                    <input type="text" class="form-control" wire:model.defer="year">
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
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.title-en') }}</label>
                    <input type="text" class="form-control" wire:model.defer="title_en">
                </div>
                 <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.short-description-ar') }}</label>
                    <textarea class="form-control" rows="2" wire:model.defer="short_description_ar"></textarea>
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.short-description-en') }}</label>
                    <textarea class="form-control" rows="2" wire:model.defer="short_description_en"></textarea>
                </div>
            </div>

            <hr class="my-2">
            <h6 class="mb-1 text-primary">{{ __('dashboard.location_and_area') }}</h6>
            <div class="row">
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.location-ar') }}</label>
                    <input type="text" class="form-control" wire:model.defer="location_ar">
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.location-en') }}</label>
                    <input type="text" class="form-control" wire:model.defer="location_en">
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.area-ar') }}</label>
                    <input type="text" class="form-control" wire:model.defer="area_ar">
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.area-en') }}</label>
                    <input type="text" class="form-control" wire:model.defer="area_en">
                </div>
            </div>

            <hr class="my-2">
            <h6 class="mb-1 text-primary">{{ __('dashboard.challenge_block') }}</h6>
            <div class="row">
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.challenge-title-ar') }}</label>
                    <input type="text" class="form-control" wire:model.defer="challenge_title_ar">
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.challenge-title-en') }}</label>
                    <input type="text" class="form-control" wire:model.defer="challenge_title_en">
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
                    <input type="text" class="form-control" wire:model.defer="solution_title_ar">
                </div>
                <div class="mb-1 col-md-6">
                    <label class="form-label">{{ __('dashboard.solution-title-en') }}</label>
                    <input type="text" class="form-control" wire:model.defer="solution_title_en">
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
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                @endforeach
                <div class="col-12 mt-50">
                    <button type="button" class="btn btn-sm btn-outline-success" wire:click="addFact">
                        <i class="fa-solid fa-plus"></i> {{ __('dashboard.add-fact') }}
                    </button>
                </div>
            </div>

            <hr class="my-2">
            <h6 class="mb-1 text-primary">{{ __('dashboard.project-gallery') }}</h6>
            
            <div class="row mb-2">
                @forelse($existing_images as $img)
                    <div class="col-md-3 mb-1 text-center position-relative">
                        <img src="{{ asset($img['image']) }}" class="img-fluid rounded border">
                        <button type="button" class="btn btn-icon btn-danger btn-sm position-absolute" 
                                style="top: 5px; right: 20px;"
                                wire:click="deleteProjectImage({{ $img['id'] }})"
                                onclick="return confirm('{{ __('dashboard.are_you_sure') }}')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                @empty
                    <div class="col-12 text-muted small px-2">No existing images.</div>
                @endforelse
            </div>

            <div class="mb-1">
                 <label class="form-label font-weight-bold">{{ __('dashboard.add-new-images') }}</label>
                 <input type="file" class="form-control" wire:model="gallery_images" multiple>
                 @include('dashboard.includes.error', ['property' => 'gallery_images.*'])
            </div>
            
            <div class="row mt-1" wire:loading wire:target="gallery_images">
                <div class="col-12 text-center">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
            </div>
            
            <div class="row mt-1 bg-light p-1 rounded">
                @foreach ($gallery_images as $tempImg)
                    <div class="col-md-2 mb-1">
                        <img src="{{ $tempImg->temporaryUrl() }}" class="img-fluid rounded border">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-update-modal>
