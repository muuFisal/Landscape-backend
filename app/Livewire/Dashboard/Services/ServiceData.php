<?php

namespace App\Livewire\Dashboard\Services;

use App\Models\Service;
use App\Utils\ImageManger;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceData extends Component
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
        $service = Service::findOrFail($id);
        if ($service->image) {
            $this->imageManager->deleteImage($service->image);
        }
        $service->delete();
        $this->dispatch('itemDeleted');
    }

    public function updateStatus($id)
    {
        $service = Service::findOrFail($id);
        $service->status = !$service->status;
        $service->save();
        $this->dispatch('StatusUpdateMS');
    }

    public function render()
    {
        $services = Service::query()
            ->where('title', 'like', '%' . $this->search . '%')
            ->orderBy('sort_order', 'asc')
            ->paginate(10);

        return view('dashboard.services.service-data', compact('services'));
    }
}
