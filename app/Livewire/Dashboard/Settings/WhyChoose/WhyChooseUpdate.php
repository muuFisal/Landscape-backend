<?php

namespace App\Livewire\Dashboard\Settings\WhyChoose;

use App\Models\WhyChooseSection;
use App\Models\WhyChooseSectionItem;
use App\Utils\ImageManger;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class WhyChooseUpdate extends Component
{
    use WithFileUploads;

    public WhyChooseSection $section;
    public $title_ar, $title_en, $description_ar, $description_en, $image;
    public array $items = [];

    protected ImageManger $imageManager;

    public function boot(ImageManger $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function mount()
    {
        $this->section = WhyChooseSection::firstOrCreate(['id' => 1]);
        $this->fillFromModel();
    }

    protected function fillFromModel()
    {
        $this->title_ar = $this->section->getTranslation('title', 'ar', false);
        $this->title_en = $this->section->getTranslation('title', 'en', false);
        $this->description_ar = $this->section->getTranslation('description', 'ar', false);
        $this->description_en = $this->section->getTranslation('description', 'en', false);
        $this->image = $this->section->image;

        $this->items = $this->section->items()
            ->orderBy('sort_order', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => [
                        'ar' => $item->getTranslation('title', 'ar', false),
                        'en' => $item->getTranslation('title', 'en', false),
                    ],
                    'description' => [
                        'ar' => $item->getTranslation('description', 'ar', false),
                        'en' => $item->getTranslation('description', 'en', false),
                    ],
                    'sort_order' => $item->sort_order,
                ];
            })->toArray();

        if (empty($this->items)) {
            $this->addItem();
        }
    }

    public function addItem()
    {
        $this->items[] = [
            'id' => null,
            'title' => ['ar' => '', 'en' => ''],
            'description' => ['ar' => '', 'en' => ''],
            'sort_order' => count($this->items),
        ];
    }

    public function removeItem($index)
    {
        $id = $this->items[$index]['id'] ?? null;
        if ($id) {
            WhyChooseSectionItem::find($id)?->delete();
        }
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function rules()
    {
        return [
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'image' => $this->image instanceof TemporaryUploadedFile ? 'nullable|image|max:2048' : 'nullable',
            'items.*.title.ar' => 'required|string|max:255',
            'items.*.title.en' => 'required|string|max:255',
            'items.*.description.ar' => 'required|string',
            'items.*.description.en' => 'required|string',
            'items.*.sort_order' => 'required|integer',
        ];
    }

    public function submit()
    {
        $this->validate();

        if ($this->image instanceof TemporaryUploadedFile && $this->image->isValid()) {
            if ($this->section->image) {
                $this->imageManager->deleteImage($this->section->image);
            }
            $this->section->image = $this->imageManager->uploadImage('uploads/settings/why-choose', $this->image);
        }

        $this->section->setTranslations('title', ['ar' => $this->title_ar, 'en' => $this->title_en]);
        $this->section->setTranslations('description', ['ar' => $this->description_ar, 'en' => $this->description_en]);
        $this->section->save();

        foreach ($this->items as $itemData) {
            $item = isset($itemData['id']) ? WhyChooseSectionItem::find($itemData['id']) : new WhyChooseSectionItem();
            $item->why_choose_section_id = $this->section->id;
            $item->setTranslations('title', $itemData['title']);
            $item->setTranslations('description', $itemData['description']);
            $item->sort_order = $itemData['sort_order'];
            $item->save();
        }

        $this->fillFromModel();
        $this->dispatch('UpdateMS');
    }

    public function render()
    {
        return view('dashboard.settings.why-choose.why-choose-update');
    }
}
