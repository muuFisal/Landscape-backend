<?php

namespace App\Livewire\Dashboard\Settings\Banners;

use App\Models\Banner;
use App\Utils\ImageManger;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class BannerUpdate extends Component
{
    use WithFileUploads;

    public Banner $bannerModel;
    public $banner, $status, $sort_order;
    public $title_ar, $title_en, $primary_label_ar, $primary_label_en, $secondary_label_ar, $secondary_label_en;
    public $sub_labels = [];

    protected ImageManger $imageManager;

    protected $listeners = ['editBanner'];

    public function boot(ImageManger $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function editBanner($id)
    {
        $this->bannerModel = Banner::findOrFail($id);
        $this->status = $this->bannerModel->status;
        $this->sort_order = $this->bannerModel->sort_order;
        
        $this->title_ar = $this->bannerModel->getTranslation('title', 'ar', false);
        $this->title_en = $this->bannerModel->getTranslation('title', 'en', false);
        $this->primary_label_ar = $this->bannerModel->getTranslation('primary_label', 'ar', false);
        $this->primary_label_en = $this->bannerModel->getTranslation('primary_label', 'en', false);
        $this->secondary_label_ar = $this->bannerModel->getTranslation('secondary_label', 'ar', false);
        $this->secondary_label_en = $this->bannerModel->getTranslation('secondary_label', 'en', false);
        
        $this->sub_labels = $this->bannerModel->sub_labels ?? [['ar' => '', 'en' => '']];

        $this->dispatch('updateModalToggle');
    }

    public function addSubLabel()
    {
        $this->sub_labels[] = ['ar' => '', 'en' => ''];
    }

    public function removeSubLabel($index)
    {
        unset($this->sub_labels[$index]);
        $this->sub_labels = array_values($this->sub_labels);
    }

    public function rules()
    {
        return [
            'banner' => 'nullable|mimes:jpg,jpeg,png,gif,webp,avif,bmp,svg|max:2048',
            'status' => 'required|in:0,1',
            'sort_order' => 'required|integer|min:0',
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'primary_label_ar' => 'required|string|max:255',
            'primary_label_en' => 'required|string|max:255',
            'secondary_label_ar' => 'required|string|max:255',
            'secondary_label_en' => 'required|string|max:255',
            'sub_labels' => 'required|array|min:1',
            'sub_labels.*.ar' => 'required|string|max:100',
            'sub_labels.*.en' => 'required|string|max:100',
        ];
    }

    public function submit()
    {
        $this->validate();

        $data = [
            'status' => $this->status,
            'sort_order' => $this->sort_order,
            'sub_labels' => array_values($this->sub_labels),
        ];

        $this->bannerModel->setTranslations('title', ['ar' => $this->title_ar, 'en' => $this->title_en]);
        $this->bannerModel->setTranslations('primary_label', ['ar' => $this->primary_label_ar, 'en' => $this->primary_label_en]);
        $this->bannerModel->setTranslations('secondary_label', ['ar' => $this->secondary_label_ar, 'en' => $this->secondary_label_en]);

        if ($this->banner instanceof TemporaryUploadedFile && $this->banner->isValid()) {
            if ($this->bannerModel->banner) {
                $this->imageManager->deleteImage($this->bannerModel->banner);
            }
            $data['banner'] = $this->imageManager->uploadImage('uploads/settings/banners', $this->banner);
        }

        $this->bannerModel->update($data);

        $this->dispatch('bannerUpdateMS');
        $this->dispatch('updateModalToggle');
        $this->dispatch('refreshData')->to(BannerData::class);
    }

    public function render()
    {
        return view('dashboard.settings.banners.banner-update');
    }
}
