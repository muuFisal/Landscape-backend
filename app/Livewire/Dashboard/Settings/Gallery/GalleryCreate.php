<?php

namespace App\Livewire\Dashboard\Settings\Gallery;

use App\Models\Gallery;
use App\Utils\ImageManger;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class GalleryCreate extends Component
{
    use WithFileUploads;

    public $title_ar, $title_en, $image, $sort_order = 0, $status = 1;

    protected ImageManger $imageManager;

    public function boot(ImageManger $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function rules()
    {
        return [
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'sort_order' => 'required|integer|min:0',
            'status' => 'required|in:0,1',
        ];
    }

    public function submit()
    {
        $this->validate();

        $data = [
            'sort_order' => $this->sort_order,
            'status' => $this->status,
        ];

        if ($this->image instanceof TemporaryUploadedFile && $this->image->isValid()) {
            $data['image'] = $this->imageManager->uploadImage('uploads/gallery/items', $this->image);
        }

        $gallery = Gallery::create($data);
        $gallery->setTranslations('title', ['ar' => $this->title_ar, 'en' => $this->title_en]);
        $gallery->save();

        $this->reset(['title_ar', 'title_en', 'image', 'sort_order']);
        $this->dispatch('galleryAddMS');
        $this->dispatch('createModalToggle');
        $this->dispatch('refreshData')->to(GalleryData::class);
    }

    public function render()
    {
        return view('dashboard.settings.gallery.gallery-create');
    }
}
