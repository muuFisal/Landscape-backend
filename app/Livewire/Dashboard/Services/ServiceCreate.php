<?php

namespace App\Livewire\Dashboard\Services;

use App\Models\Service;
use App\Utils\ImageManger;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ServiceCreate extends Component
{
    use WithFileUploads;

    public $title_ar, $title_en, $description_ar, $description_en, $image, $sort_order = 0;
    public $has_projects = false, $show_in_projects_filter = true, $status = 1;

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
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'required|image|max:4096',
            'sort_order' => 'required|integer|min:0',
            'status' => 'required|boolean',
            'has_projects' => 'required|boolean',
            'show_in_projects_filter' => 'required|boolean',
        ];
    }

    public function submit()
    {
        $this->validate();

        $slug = Str::slug($this->title_en);
        if (Service::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . time();
        }

        $serviceData = [
            'slug' => $slug,
            'sort_order' => $this->sort_order,
            'status' => $this->status,
            'has_projects' => $this->has_projects,
            'show_in_projects_filter' => $this->show_in_projects_filter,
        ];

        if ($this->image instanceof TemporaryUploadedFile && $this->image->isValid()) {
            $serviceData['image'] = $this->imageManager->uploadImage('uploads/services', $this->image);
        }

        $service = Service::create($serviceData);
        $service->setTranslations('title', ['ar' => $this->title_ar, 'en' => $this->title_en]);
        $service->setTranslations('description', ['ar' => $this->description_ar, 'en' => $this->description_en]);
        $service->save();

        $this->reset(['title_ar', 'title_en', 'description_ar', 'description_en', 'image', 'sort_order', 'has_projects', 'show_in_projects_filter']);
        $this->dispatch('serviceAddMS');
        $this->dispatch('close-modal');
        $this->dispatch('refreshData')->to(ServiceData::class);
    }

    public function render()
    {
        return view('dashboard.services.service-create');
    }
}
