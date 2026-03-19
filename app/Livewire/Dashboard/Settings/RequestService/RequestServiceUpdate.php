<?php

namespace App\Livewire\Dashboard\Settings\RequestService;

use App\Models\RequestServiceSection;
use App\Utils\ImageManger;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class RequestServiceUpdate extends Component
{
    use WithFileUploads;

    public RequestServiceSection $section;
    public $small_label_ar, $small_label_en, $title_ar, $title_en, $description_ar, $description_en, $btn_text_ar, $btn_text_en, $image;

    protected ImageManger $imageManager;

    public function boot(ImageManger $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function mount()
    {
        $this->section = RequestServiceSection::firstOrCreate(['id' => 1]);
        $this->fillFromModel();
    }

    protected function fillFromModel()
    {
        $this->small_label_ar = $this->section->getTranslation('small_label', 'ar', false);
        $this->small_label_en = $this->section->getTranslation('small_label', 'en', false);
        $this->title_ar = $this->section->getTranslation('title', 'ar', false);
        $this->title_en = $this->section->getTranslation('title', 'en', false);
        $this->description_ar = $this->section->getTranslation('description', 'ar', false);
        $this->description_en = $this->section->getTranslation('description', 'en', false);
        $this->btn_text_ar = $this->section->getTranslation('button_text', 'ar', false);
        $this->btn_text_en = $this->section->getTranslation('button_text', 'en', false);
        $this->image = $this->section->image;
    }

    public function rules()
    {
        return [
            'small_label_ar' => 'required|string|max:255',
            'small_label_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'btn_text_ar' => 'required|string|max:255',
            'btn_text_en' => 'required|string|max:255',
            'image' => $this->image instanceof TemporaryUploadedFile ? 'nullable|image|max:2048' : 'nullable',
        ];
    }

    public function submit()
    {
        $this->validate();

        if ($this->image instanceof TemporaryUploadedFile && $this->image->isValid()) {
            if ($this->section->image) {
                $this->imageManager->deleteImage($this->section->image);
            }
            $this->section->image = $this->imageManager->uploadImage('uploads/settings/request-service', $this->image);
        }

        $this->section->setTranslations('small_label', ['ar' => $this->small_label_ar, 'en' => $this->small_label_en]);
        $this->section->setTranslations('title', ['ar' => $this->title_ar, 'en' => $this->title_en]);
        $this->section->setTranslations('description', ['ar' => $this->description_ar, 'en' => $this->description_en]);
        $this->section->setTranslations('button_text', ['ar' => $this->btn_text_ar, 'en' => $this->btn_text_en]);
        $this->section->save();

        $this->fillFromModel();
        $this->dispatch('UpdateMS');
    }

    public function render()
    {
        return view('dashboard.settings.request-service.request-service-update');
    }
}
