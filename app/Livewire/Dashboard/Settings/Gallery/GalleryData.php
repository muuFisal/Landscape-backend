<?php

namespace App\Livewire\Dashboard\Settings\Gallery;

use App\Models\Gallery;
use Livewire\Component;
use Livewire\WithPagination;

class GalleryData extends Component
{
    use WithPagination;
    protected $listeners = ['refreshData' => '$refresh', 'deleteItem'];

    public function updateStatus($itemId, $newStatus)
    {
        $item = Gallery::find($itemId);
        if (!$item) return;
        $item->status = $newStatus;
        $item->save();
        $this->dispatch('StatusUpdateMS');
    }

    public function deleteItem($data)
    {
        $id = is_array($data) ? $data['id'] : $data;
        $item = Gallery::find($id);
        if ($item) {
            $item->delete();
            $this->dispatch('itemDeleted');
        }
    }

    public function render()
    {
        $data = Gallery::orderBy('sort_order', 'asc')->paginate(10);
        return view('dashboard.settings.gallery.gallery-data', compact('data'));
    }
}
