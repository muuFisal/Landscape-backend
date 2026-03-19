<?php

namespace App\Livewire\Dashboard\Projects;

use App\Models\Project;
use App\Utils\ImageManger;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectData extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshData' => '$refresh', 'deleteItem' => 'delete'];

    public $search = '';

    protected ImageManger $imageManager;

    public function boot(ImageManger $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function delete($id)
    {
        $project = Project::with('images')->findOrFail($id);
        foreach ($project->images as $img) {
            $this->imageManager->deleteImage($img->image);
        }
        $project->delete();
        $this->dispatch('itemDeleted');
    }

    public function updateStatus($id)
    {
        $project = Project::findOrFail($id);
        $project->status = !$project->status;
        $project->save();
        $this->dispatch('StatusUpdateMS');
    }

    public function render()
    {
        $projects = Project::query()
            ->with('service')
            ->where('title', 'like', '%' . $this->search . '%')
            ->orderBy('sort_order', 'asc')
            ->paginate(10);

        return view('dashboard.projects.project-data', compact('projects'));
    }
}
