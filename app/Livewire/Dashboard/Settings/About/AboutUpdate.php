<?php

namespace App\Livewire\Dashboard\Settings\About;

use App\Models\About;
use App\Utils\ImageManger;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class AboutUpdate extends Component
{
    use WithFileUploads;

    public About $about;

    public $about_badge_ar, $about_badge_en, $about_title_ar, $about_title_en, $about_description_ar, $about_description_en, $about_image, $second_image;
    public $mission_badge_ar, $mission_badge_en, $mission_title_ar, $mission_title_en, $mission_description_ar, $mission_description_en, $mission_image;
    public $vision_badge_ar, $vision_badge_en, $vision_title_ar, $vision_title_en, $vision_description_ar, $vision_description_en, $vision_image;
    public $shapes_badge_ar, $shapes_badge_en, $shapes_title_ar, $shapes_title_en, $shapes_description_ar, $shapes_description_en;
    public array $shape_cards = [];

    protected ImageManger $imageManager;

    protected $listeners = ['refresh' => '$refresh'];

    public function boot(ImageManger $imageManager): void
    {
        $this->imageManager = $imageManager;
    }

    public function mount(): void
    {
        $this->about = About::query()->firstOrCreate(['id' => 1]);
        $this->fillFromModel();
    }

    protected function fillFromModel(): void
    {
        foreach (['about', 'mission', 'vision', 'shapes'] as $section) {
            foreach (['badge', 'title', 'description'] as $field) {
                $property = "{$section}_{$field}";
                $column = "{$section}_{$field}";
                $this->{$property.'_ar'} = $this->about->getTranslation($column, 'ar', false) ?? '';
                $this->{$property.'_en'} = $this->about->getTranslation($column, 'en', false) ?? '';
            }
        }

        $this->about_image = $this->about->about_image ?: $this->about->image;
        $this->second_image = $this->about->second_image;
        $this->mission_image = $this->about->mission_image;
        $this->vision_image = $this->about->vision_image;
        $this->shape_cards = is_array($this->about->shapes_items) && count($this->about->shapes_items)
            ? $this->about->shapes_items
            : [
                ['title' => ['ar' => '', 'en' => ''], 'description' => ['ar' => '', 'en' => '']],
                ['title' => ['ar' => '', 'en' => ''], 'description' => ['ar' => '', 'en' => '']],
                ['title' => ['ar' => '', 'en' => ''], 'description' => ['ar' => '', 'en' => '']],
            ];

        $this->resetValidation();
    }

    public function addShapeCard(): void
    {
        $this->shape_cards[] = ['title' => ['ar' => '', 'en' => ''], 'description' => ['ar' => '', 'en' => '']];
    }

    public function removeShapeCard(int $index): void
    {
        unset($this->shape_cards[$index]);
        $this->shape_cards = array_values($this->shape_cards);
    }

    public function rules(): array
    {
        $rules = [
            'about_badge_ar' => ['nullable', 'string', 'max:255'],
            'about_badge_en' => ['nullable', 'string', 'max:255'],
            'about_title_ar' => ['required', 'string', 'max:255'],
            'about_title_en' => ['required', 'string', 'max:255'],
            'about_description_ar' => ['required', 'string'],
            'about_description_en' => ['required', 'string'],
            'mission_badge_ar' => ['nullable', 'string', 'max:255'],
            'mission_badge_en' => ['nullable', 'string', 'max:255'],
            'mission_title_ar' => ['required', 'string', 'max:255'],
            'mission_title_en' => ['required', 'string', 'max:255'],
            'mission_description_ar' => ['required', 'string'],
            'mission_description_en' => ['required', 'string'],
            'vision_badge_ar' => ['nullable', 'string', 'max:255'],
            'vision_badge_en' => ['nullable', 'string', 'max:255'],
            'vision_title_ar' => ['required', 'string', 'max:255'],
            'vision_title_en' => ['required', 'string', 'max:255'],
            'vision_description_ar' => ['required', 'string'],
            'vision_description_en' => ['required', 'string'],
            'shapes_badge_ar' => ['nullable', 'string', 'max:255'],
            'shapes_badge_en' => ['nullable', 'string', 'max:255'],
            'shapes_title_ar' => ['required', 'string', 'max:255'],
            'shapes_title_en' => ['required', 'string', 'max:255'],
            'shapes_description_ar' => ['required', 'string'],
            'shapes_description_en' => ['required', 'string'],
            'shape_cards' => ['required', 'array', 'min:1'],
            'shape_cards.*.title.ar' => ['required', 'string', 'max:255'],
            'shape_cards.*.title.en' => ['required', 'string', 'max:255'],
            'shape_cards.*.description.ar' => ['required', 'string'],
            'shape_cards.*.description.en' => ['required', 'string'],
        ];

        foreach (['about_image', 'second_image', 'mission_image', 'vision_image'] as $field) {
            $rules[$field] = $this->{$field} instanceof TemporaryUploadedFile
                ? ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,avif,bmp,svg,ico', 'max:12288']
                : ['nullable'];
        }

        return $rules;
    }

    protected function uploadAndReplace(string $property, string $column): void
    {
        $file = $this->{$property};

        if (! ($file instanceof UploadedFile) || ! $file->isValid()) {
            return;
        }

        $oldPath = $this->about->{$column};
        if (! empty($oldPath) && $oldPath !== 'uploads/images/logo.png') {
            $this->imageManager->deleteImage($oldPath);
        }

        $this->about->{$column} = $this->imageManager->uploadImage('uploads/settings/about', $file, 'public');
        $this->{$property} = $this->about->{$column};
    }

    public function submit(): void
    {
        $this->validate();

        $this->uploadAndReplace('about_image', 'about_image');
        $this->uploadAndReplace('second_image', 'second_image');
        $this->uploadAndReplace('mission_image', 'mission_image');
        $this->uploadAndReplace('vision_image', 'vision_image');

        foreach (['about', 'mission', 'vision', 'shapes'] as $section) {
            foreach (['badge', 'title', 'description'] as $field) {
                $column = "{$section}_{$field}";
                $this->about->setTranslations($column, [
                    'ar' => (string) ($this->{$column.'_ar'} ?? ''),
                    'en' => (string) ($this->{$column.'_en'} ?? ''),
                ]);
            }
        }

        $this->about->fill([
            'title' => ['ar' => $this->about_title_ar, 'en' => $this->about_title_en],
            'desc' => ['ar' => $this->about_description_ar, 'en' => $this->about_description_en],
            'image' => $this->about->about_image,
            'shapes_items' => array_values($this->shape_cards),
        ]);

        $this->about->save();

        $this->fillFromModel();
        $this->dispatch('aboutUpdateMS');
    }

    public function render()
    {
        return view('dashboard.settings.about.about-update');
    }
}
