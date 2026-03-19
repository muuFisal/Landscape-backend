<?php

namespace App\Livewire\Dashboard\Settings\Gallery;

use App\Models\GalleryPage;
use App\Utils\ImageManger;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class GalleryPageUpdate extends Component
{
    use WithFileUploads;

    public GalleryPage $page;
    public $title_ar, $title_en, $description_ar, $description_en, $image;

    protected ImageManger $imageManager;

    public function boot(ImageManger $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function mount()
    {
        $this->page = GalleryPage::firstOrCreate(['id' => 1]);
        $this->fillFromModel();
    }

    protected function fillFromModel()
    {
        $this->title_ar = $this->page->getTranslation('title', 'ar', false);
        $this->title_en = $this->page->getTranslation('title', 'en', false);
        $this->description_ar = $this->page->getTranslation('description', 'ar', false);
        $this->description_en = $this->page->getTranslation('description', 'en', false);
        $this->image = $this->page->image;
    }

    public function rules()
    {
        return [
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'image' => $this->image instanceof TemporaryUploadedFile ? 'nullable|image|max:2048' : 'nullable',
        ];
    }

    public function submit()
    {
        $this->validate();

        if ($this->image instanceof TemporaryUploadedFile && $this->image->isValid()) {
            if ($this->page->image) {
                $this->imageManager->deleteImage($this->page->image);
            }
            $this->page->image = $this->imageManager->uploadImage('uploads/gallery', $this->image);
        }

        $this->page->setTranslations('title', ['ar' => $this->title_ar, 'en' => $this->title_en]);
        $this->page->setTranslations('description', ['ar' => $this->description_ar, 'en' => $this->description_en]);
        $this->page->save();

        $this->fillFromModel();
        $this->dispatch('UpdateMS');
    }

    public function render()
    {
        return view('dashboard.settings.gallery.gallery-page-update');
    }
}
