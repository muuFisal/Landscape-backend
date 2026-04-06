<div>
    <form class="form form-horizontal" wire:submit.prevent='submit'>
        @php
            $sections = [
                'about' => ['image' => 'about_image'],
                'mission' => ['image' => 'mission_image'],
                'vision' => ['image' => 'vision_image'],
                'shapes' => ['image' => null],
            ];
        @endphp

        @foreach ($sections as $section => $meta)
            <div class="border rounded p-2 mb-3">
                <h5 class="mb-2 text-primary text-capitalize">{{ __('dashboard.' . $section . '-section') }}</h5>
                <div class="row">
                    <div class="mb-1 col-md-6">
                        <label class="form-label">{{ __('dashboard.badge-ar') }}</label>
                        <input type="text" class="form-control" wire:model.defer="{{ $section }}_badge_ar">
                        @include('dashboard.includes.error', ['property' => $section . '_badge_ar'])
                    </div>
                    <div class="mb-1 col-md-6">
                        <label class="form-label">{{ __('dashboard.badge-en') }}</label>
                        <input type="text" class="form-control" wire:model.defer="{{ $section }}_badge_en">
                        @include('dashboard.includes.error', ['property' => $section . '_badge_en'])
                    </div>
                </div>

                <div class="row">
                    <div class="mb-1 col-md-6">
                        <label class="form-label">{{ __('dashboard.name-ar') }}</label>
                        <input type="text" class="form-control" wire:model.defer="{{ $section }}_title_ar">
                        @include('dashboard.includes.error', ['property' => $section . '_title_ar'])
                    </div>
                    <div class="mb-1 col-md-6">
                        <label class="form-label">{{ __('dashboard.name-en') }}</label>
                        <input type="text" class="form-control" wire:model.defer="{{ $section }}_title_en">
                        @include('dashboard.includes.error', ['property' => $section . '_title_en'])
                    </div>
                </div>

                <div class="mb-1" wire:ignore>
                    <label class="form-label">{{ __('dashboard.description-ar') }}</label>
                    <div id="{{ $section }}_description_ar_editor">{!! data_get($this, $section.'_description_ar') !!}</div>
                    @include('dashboard.includes.error', ['property' => $section . '_description_ar'])
                </div>

                <div class="mb-1" wire:ignore>
                    <label class="form-label">{{ __('dashboard.description-en') }}</label>
                    <div id="{{ $section }}_description_en_editor">{!! data_get($this, $section.'_description_en') !!}</div>
                    @include('dashboard.includes.error', ['property' => $section . '_description_en'])
                </div>

                @if ($meta['image'])
                    <div class="mb-1">
                        <label class="form-label">{{ __('dashboard.image') }}</label>
                        <div class="mb-2 p-1 border rounded bg-light-subtle">
                            @if (isset(${$meta['image']}) && is_object(${$meta['image']}))
                                <img src="{{ ${$meta['image']}->temporaryUrl() }}" width="180" class="img-fluid">
                            @elseif(!empty(${$meta['image']}))
                                <img src="{{ asset(${$meta['image']}) }}" width="180" class="img-fluid">
                            @endif
                        </div>
                        <input type="file" class="form-control" wire:model="{{ $meta['image'] }}">
                        @include('dashboard.includes.error', ['property' => $meta['image']])
                    </div>

                    @if ($section === 'about')
                        <div class="mb-1">
                            <label class="form-label">{{ __('dashboard.second-image') }}</label>
                            <div class="mb-2 p-1 border rounded bg-light-subtle">
                                @if (isset($second_image) && is_object($second_image))
                                    <img src="{{ $second_image->temporaryUrl() }}" width="180" class="img-fluid">
                                @elseif(!empty($second_image))
                                    <img src="{{ asset($second_image) }}" width="180" class="img-fluid">
                                @endif
                            </div>
                            <input type="file" class="form-control" wire:model="second_image">
                            @include('dashboard.includes.error', ['property' => 'second_image'])
                        </div>
                    @endif
                @endif
            </div>
        @endforeach

        <div class="border rounded p-2 mb-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="mb-0 text-primary">{{ __('dashboard.what-shapes-cards') }}</h5>
                <button type="button" class="btn btn-sm btn-outline-primary" wire:click="addShapeCard">{{ __('dashboard.add-card') }}</button>
            </div>

            @foreach ($shape_cards as $index => $card)
                <div class="border rounded p-2 mb-2">
                    <div class="d-flex justify-content-between mb-2">
                        <strong>#{{ $index + 1 }}</strong>
                        <button type="button" class="btn btn-sm btn-outline-danger" wire:click="removeShapeCard({{ $index }})">{{ __('dashboard.delete') }}</button>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label">{{ __('dashboard.name-ar') }}</label>
                            <input type="text" class="form-control" wire:model.defer="shape_cards.{{ $index }}.title.ar">
                            @include('dashboard.includes.error', ['property' => 'shape_cards.' . $index . '.title.ar'])
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label">{{ __('dashboard.name-en') }}</label>
                            <input type="text" class="form-control" wire:model.defer="shape_cards.{{ $index }}.title.en">
                            @include('dashboard.includes.error', ['property' => 'shape_cards.' . $index . '.title.en'])
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label">{{ __('dashboard.description-ar') }}</label>
                            <textarea class="form-control" rows="3" wire:model.defer="shape_cards.{{ $index }}.description.ar"></textarea>
                            @include('dashboard.includes.error', ['property' => 'shape_cards.' . $index . '.description.ar'])
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label">{{ __('dashboard.description-en') }}</label>
                            <textarea class="form-control" rows="3" wire:model.defer="shape_cards.{{ $index }}.description.en"></textarea>
                            @include('dashboard.includes.error', ['property' => 'shape_cards.' . $index . '.description.en'])
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">{{ __('dashboard.submit') }}</button>
    </form>
</div>

@push('css')
    <link href="{{ asset('summernote/summernote-bs5.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('summernote/summernote-bs5.js') }}"></script>
    <script src="{{ asset('summernote/lang/summernote-ar-AR.min.js') }}"></script>
    <script>
        function initSummernote(id, lang, callback) {
            $('#' + id).summernote({
                height: 220,
                lang: lang,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'hr']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                callbacks: {
                    onChange: callback
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const sections = ['about', 'mission', 'vision', 'shapes'];

            sections.forEach(section => {
                initSummernote(`${section}_description_ar_editor`, 'ar-AR', function(contents) {
                    @this.set(`${section}_description_ar`, contents);
                });

                initSummernote(`${section}_description_en_editor`, 'en-US', function(contents) {
                    @this.set(`${section}_description_en`, contents);
                });
            });

            Livewire.on('aboutUpdateMS', () => {
                sections.forEach(section => {
                    $(`#${section}_description_ar_editor`).summernote('code', @this.get(`${section}_description_ar`));
                    $(`#${section}_description_en_editor`).summernote('code', @this.get(`${section}_description_en`));
                });
            });
        });
    </script>
@endpush
