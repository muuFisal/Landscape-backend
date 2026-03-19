<?php

namespace App\Livewire\Dashboard\Settings\Gallery;

use App\Models\Gallery;
use App\Utils\ImageManger;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class GalleryUpdate extends Component
{
    use WithFileUploads;

    public ?Gallery $galleryModel = null;
    public $title_ar, $title_en, $image, $sort_order, $status;

    protected $listeners = ['editGalleryItem'];
    protected ImageManger $imageManager;

    public function boot(ImageManger $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function editGalleryItem($id)
    {
        $this->galleryModel = Gallery::findOrFail($id);
        $this->title_ar = $this->galleryModel->getTranslation('title', 'ar', false);
        $this->title_en = $this->galleryModel->getTranslation('title', 'en', false);
        $this->sort_order = $this->galleryModel->sort_order;
        $this->status = $this->galleryModel->status;
        $this->image = null;

        $this->dispatch('updateModalToggle');
    }

    public function rules()
    {
        return [
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
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
            if ($this->galleryModel->image) {
                $this->imageManager->deleteImage($this->galleryModel->image);
            }
            $data['image'] = $this->imageManager->uploadImage('uploads/gallery/items', $this->image);
        }

        $this->galleryModel->update($data);
        $this->galleryModel->setTranslations('title', ['ar' => $this->title_ar, 'en' => $this->title_en]);
        $this->galleryModel->save();

        $this->dispatch('galleryUpdateMS');
        $this->dispatch('updateModalToggle');
        $this->dispatch('refreshData')->to(GalleryData::class);
    }

    public function render()
    {
        return view('dashboard.settings.gallery.gallery-update');
    }
}
