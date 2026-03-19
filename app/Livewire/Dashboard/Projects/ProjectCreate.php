<?php

namespace App\Livewire\Dashboard\Projects;

use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Service;
use App\Utils\ImageManger;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ProjectCreate extends Component
{
    use WithFileUploads;

    public $service_id, $title_ar, $title_en, $short_description_ar, $short_description_en;
    public $year, $location_ar, $location_en, $area_ar, $area_en;
    public $challenge_title_ar, $challenge_title_en, $challenge_description_ar, $challenge_description_en;
    public $solution_title_ar, $solution_title_en, $solution_description_ar, $solution_description_en;
    public $facts = [], $sort_order = 0, $status = 1;
    public $gallery_images = []; // Multi-upload for gallery

    protected ImageManger $imageManager;

    public function boot(ImageManger $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function rules()
    {
        return [
            'service_id' => 'required|exists:services,id',
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'short_description_ar' => 'nullable|string',
            'short_description_en' => 'nullable|string',
            'year' => 'nullable|string|max:50',
            'location_ar' => 'nullable|string|max:255',
            'location_en' => 'nullable|string|max:255',
            'area_ar' => 'nullable|string|max:255',
            'area_en' => 'nullable|string|max:255',
            'challenge_title_ar' => 'nullable|string|max:255',
            'challenge_title_en' => 'nullable|string|max:255',
            'challenge_description_ar' => 'nullable|string',
            'challenge_description_en' => 'nullable|string',
            'solution_title_ar' => 'nullable|string|max:255',
            'solution_title_en' => 'nullable|string|max:255',
            'solution_description_ar' => 'nullable|string',
            'solution_description_en' => 'nullable|string',
            'facts' => 'nullable|array',
            'gallery_images.*' => 'required|image|max:4096',
            'sort_order' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ];
    }

    public function addFact()
    {
        $this->facts[] = '';
    }

    public function removeFact($index)
    {
        unset($this->facts[$index]);
        $this->facts = array_values($this->facts);
    }

    public function submit()
    {
        $this->validate();

        $slug = Str::slug($this->title_en);
        if (Project::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . time();
        }

        $projectData = [
            'service_id' => $this->service_id,
            'slug' => $slug,
            'year' => $this->year,
            'facts' => array_filter($this->facts),
            'sort_order' => $this->sort_order,
            'status' => $this->status,
        ];

        $project = Project::create($projectData);
        $project->setTranslations('title', ['ar' => $this->title_ar, 'en' => $this->title_en]);
        $project->setTranslations('short_description', ['ar' => $this->short_description_ar, 'en' => $this->short_description_en]);
        $project->setTranslations('location', ['ar' => $this->location_ar, 'en' => $this->location_en]);
        $project->setTranslations('area', ['ar' => $this->area_ar, 'en' => $this->area_en]);
        $project->setTranslations('challenge_title', ['ar' => $this->challenge_title_ar ?? 'The Challenge', 'en' => $this->challenge_title_en ?? 'The Challenge']);
        $project->setTranslations('challenge_description', ['ar' => $this->challenge_description_ar, 'en' => $this->challenge_description_en]);
        $project->setTranslations('solution_title', ['ar' => $this->solution_title_ar ?? 'The Solution', 'en' => $this->solution_title_en ?? 'The Solution']);
        $project->setTranslations('solution_description', ['ar' => $this->solution_description_ar, 'en' => $this->solution_description_en]);
        $project->save();

        // Handle Gallery Images
        if (!empty($this->gallery_images)) {
            $paths = $this->imageManager->uploadMultiImage('uploads/projects/gallery', $this->gallery_images);
            foreach ($paths as $idx => $path) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => $path,
                    'sort_order' => $idx,
                    'status' => 1
                ]);
            }
        }

        $this->reset();
        $this->dispatch('projectAddMS');
        $this->dispatch('close-modal');
        $this->dispatch('refreshData')->to(ProjectData::class);
    }

    public function render()
    {
        $services = Service::where('has_projects', true)->where('status', true)->get();
        return view('dashboard.projects.project-create', compact('services'));
    }
}
