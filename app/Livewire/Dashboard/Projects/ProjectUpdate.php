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

class ProjectUpdate extends Component
{
    use WithFileUploads;

    public $project, $project_id, $service_id, $title_ar, $title_en, $short_description_ar, $short_description_en;
    public $year, $location_ar, $location_en, $area_ar, $area_en;
    public $challenge_title_ar, $challenge_title_en, $challenge_description_ar, $challenge_description_en;
    public $solution_title_ar, $solution_title_en, $solution_description_ar, $solution_description_en;
    public $facts = [], $sort_order = 0, $status = 1;
    public $gallery_images = []; // Multi-upload for NEW gallery images
    public $existing_images = []; // To view current images

    protected ImageManger $imageManager;

    protected $listeners = ['editProject' => 'loadProject', 'deleteImage' => 'deleteProjectImage'];

    public function boot(ImageManger $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function loadProject($id)
    {
        $this->project = Project::with('images')->findOrFail($id);
        $this->project_id = $this->project->id;
        $this->service_id = $this->project->service_id;
        $this->title_ar = $this->project->getTranslation('title', 'ar', false);
        $this->title_en = $this->project->getTranslation('title', 'en', false);
        $this->short_description_ar = $this->project->getTranslation('short_description', 'ar', false);
        $this->short_description_en = $this->project->getTranslation('short_description', 'en', false);
        $this->year = $this->project->year;
        $this->location_ar = $this->project->getTranslation('location', 'ar', false);
        $this->location_en = $this->project->getTranslation('location', 'en', false);
        $this->area_ar = $this->project->getTranslation('area', 'ar', false);
        $this->area_en = $this->project->getTranslation('area', 'en', false);
        $this->challenge_title_ar = $this->project->getTranslation('challenge_title', 'ar', false);
        $this->challenge_title_en = $this->project->getTranslation('challenge_title', 'en', false);
        $this->challenge_description_ar = $this->project->getTranslation('challenge_description', 'ar', false);
        $this->challenge_description_en = $this->project->getTranslation('challenge_description', 'en', false);
        $this->solution_title_ar = $this->project->getTranslation('solution_title', 'ar', false);
        $this->solution_title_en = $this->project->getTranslation('solution_title', 'en', false);
        $this->solution_description_ar = $this->project->getTranslation('solution_description', 'ar', false);
        $this->solution_description_en = $this->project->getTranslation('solution_description', 'en', false);
        $this->facts = is_array($this->project->facts) ? $this->project->facts : [];
        $this->sort_order = $this->project->sort_order;
        $this->status = $this->project->status;
        $this->existing_images = $this->project->images()->orderBy('sort_order', 'asc')->get()->toArray();
        
        $this->dispatch('open-edit-modal');
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

    public function deleteProjectImage($id)
    {
        $img = ProjectImage::findOrFail($id);
        if ($img->image && file_exists(public_path($img->image))) {
            $this->imageManager->deleteImage($img->image);
        }
        $img->delete();
        $this->existing_images = $this->project->images()->orderBy('sort_order', 'asc')->get()->toArray();
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
            'gallery_images.*' => 'nullable|image|max:4096',
            'sort_order' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ];
    }

    public function submit()
    {
        $this->validate();

        $this->project->service_id = $this->service_id;
        $this->project->year = $this->year;
        $this->project->facts = array_filter($this->facts);
        $this->project->sort_order = $this->sort_order;
        $this->project->status = $this->status;

        $this->project->setTranslations('title', ['ar' => $this->title_ar, 'en' => $this->title_en]);
        $this->project->setTranslations('short_description', ['ar' => $this->short_description_ar, 'en' => $this->short_description_en]);
        $this->project->setTranslations('location', ['ar' => $this->location_ar, 'en' => $this->location_en]);
        $this->project->setTranslations('area', ['ar' => $this->area_ar, 'en' => $this->area_en]);
        $this->project->setTranslations('challenge_title', ['ar' => $this->challenge_title_ar, 'en' => $this->challenge_title_en]);
        $this->project->setTranslations('challenge_description', ['ar' => $this->challenge_description_ar, 'en' => $this->challenge_description_en]);
        $this->project->setTranslations('solution_title', ['ar' => $this->solution_title_ar, 'en' => $this->solution_title_en]);
        $this->project->setTranslations('solution_description', ['ar' => $this->solution_description_ar, 'en' => $this->solution_description_en]);
        $this->project->save();

        if (!empty($this->gallery_images)) {
             $paths = $this->imageManager->uploadMultiImage('uploads/projects/gallery', $this->gallery_images);
             foreach ($paths as $idx => $path) {
                 ProjectImage::create([
                     'project_id' => $this->project->id,
                     'image' => $path,
                     'sort_order' => 100 + $idx, // High sort order for new ones
                     'status' => 1
                 ]);
             }
        }

        $this->dispatch('projectUpdateMS', ['id' => $this->project->id]);
        $this->dispatch('close-edit-modal');
        $this->dispatch('refreshData')->to(ProjectData::class);
    }

    public function render()
    {
        $services = Service::where('has_projects', true)->where('status', true)->get();
        return view('dashboard.projects.project-update', compact('services'));
    }
}
