<?php

namespace App\Livewire\Dashboard\Services;

use App\Models\Service;
use App\Utils\ImageManger;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ServiceUpdate extends Component
{
    use WithFileUploads;

    public $service, $service_id, $title_ar, $title_en, $description_ar, $description_en, $image, $sort_order = 0;
    public $has_projects = false, $show_in_projects_filter = true, $status = 1;

    protected ImageManger $imageManager;

    protected $listeners = ['editService' => 'loadService'];

    public function boot(ImageManger $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function loadService($id)
    {
        $this->service = Service::findOrFail($id);
        $this->service_id = $this->service->id;
        $this->title_ar = $this->service->getTranslation('title', 'ar', false);
        $this->title_en = $this->service->getTranslation('title', 'en', false);
        $this->description_ar = $this->service->getTranslation('description', 'ar', false);
        $this->description_en = $this->service->getTranslation('description', 'en', false);
        $this->image = $this->service->image;
        $this->sort_order = $this->service->sort_order;
        $this->status = $this->service->status;
        $this->has_projects = $this->service->has_projects;
        $this->show_in_projects_filter = $this->service->show_in_projects_filter;
        
        $this->dispatch('open-edit-modal');
    }

    public function rules()
    {
        return [
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => $this->image instanceof TemporaryUploadedFile ? 'nullable|image|max:4096' : 'nullable',
            'sort_order' => 'required|integer|min:0',
            'status' => 'required|boolean',
            'has_projects' => 'required|boolean',
            'show_in_projects_filter' => 'required|boolean',
        ];
    }

    public function submit()
    {
        $this->validate();

        $this->service->sort_order = $this->sort_order;
        $this->service->status = $this->status;
        $this->service->has_projects = $this->has_projects;
        $this->service->show_in_projects_filter = $this->show_in_projects_filter;

        if ($this->image instanceof TemporaryUploadedFile && $this->image->isValid()) {
            if ($this->service->image && file_exists(public_path($this->service->image))) {
                $this->imageManager->deleteImage($this->service->image);
            }
            $this->service->image = $this->imageManager->uploadImage('uploads/services', $this->image);
        }

        $this->service->setTranslations('title', ['ar' => $this->title_ar, 'en' => $this->title_en]);
        $this->service->setTranslations('description', ['ar' => $this->description_ar, 'en' => $this->description_en]);
        $this->service->save();

        $this->dispatch('serviceUpdateMS', ['id' => $this->service->id]);
        $this->dispatch('close-edit-modal');
        $this->dispatch('refreshData')->to(ServiceData::class);
    }

    public function render()
    {
        return view('dashboard.services.service-update');
    }
}
