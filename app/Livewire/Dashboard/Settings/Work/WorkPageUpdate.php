<?php

namespace App\Livewire\Dashboard\Settings\Work;

use App\Models\WorkPage;
use App\Utils\ImageManger;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class WorkPageUpdate extends Component
{
    use WithFileUploads;

    public WorkPage $page;
    public $title_ar, $title_en, $description_ar, $description_en, $eyebrow_ar, $eyebrow_en, $image;

    protected ImageManger $imageManager;

    public function boot(ImageManger $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function mount()
    {
        $this->page = WorkPage::firstOrCreate(['id' => 1]);
        $this->fillFromModel();
    }

    protected function fillFromModel()
    {
        $this->title_ar = $this->page->getTranslation('title', 'ar', false);
        $this->title_en = $this->page->getTranslation('title', 'en', false);
        $this->description_ar = $this->page->getTranslation('description', 'ar', false);
        $this->description_en = $this->page->getTranslation('description', 'en', false);
        $this->eyebrow_ar = $this->page->getTranslation('eyebrow', 'ar', false);
        $this->eyebrow_en = $this->page->getTranslation('eyebrow', 'en', false);
        $this->image = $this->page->image;
    }

    public function rules()
    {
        return [
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'eyebrow_ar' => 'nullable|string|max:255',
            'eyebrow_en' => 'nullable|string|max:255',
            'image' => $this->image instanceof TemporaryUploadedFile ? 'nullable|image|max:4096' : 'nullable',
        ];
    }

    public function submit()
    {
        $this->validate();

        if ($this->image instanceof TemporaryUploadedFile && $this->image->isValid()) {
            if ($this->page->image && file_exists(public_path($this->page->image))) {
                $this->imageManager->deleteImage($this->page->image);
            }
            $this->page->image = $this->imageManager->uploadImage('uploads/work_page', $this->image);
        }

        $this->page->setTranslations('title', ['ar' => $this->title_ar, 'en' => $this->title_en]);
        $this->page->setTranslations('description', ['ar' => $this->description_ar, 'en' => $this->description_en]);
        $this->page->setTranslations('eyebrow', ['ar' => $this->eyebrow_ar, 'en' => $this->eyebrow_en]);
        $this->page->save();

        $this->fillFromModel();
        $this->dispatch('UpdateMS');
    }

    public function render()
    {
        return view('dashboard.settings.work.work-page-update');
    }
}
