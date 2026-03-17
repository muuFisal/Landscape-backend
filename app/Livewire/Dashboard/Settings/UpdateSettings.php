<?php

namespace App\Livewire\Dashboard\Settings;

use App\Models\Setting;
use App\Utils\ImageManger;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class UpdateSettings extends Component
{
    use WithFileUploads;

    protected $listeners = ['refresh' => '$refresh'];

    public Setting $settings;

    public $site_name_ar, $site_name_en;
    public $site_title_ar, $site_title_en;
    public $site_desc_ar, $site_desc_en;
    public $site_address_ar, $site_address_en;
    public $meta_key_ar, $meta_key_en;
    public $meta_desc_ar, $meta_desc_en;

    public $site_phone, $whatsapp, $site_email, $email_support;
    public $facebook, $x_url, $youtube, $instagram, $tiktok, $linkedin;
    public $logo, $light_logo, $dark_logo, $favicon;
    public $site_copyright, $promotion_url;

    protected ImageManger $imageManager;

    public function boot(ImageManger $imageManager): void
    {
        $this->imageManager = $imageManager;
    }

    public function mount(): void
    {
        $this->settings = Setting::query()->firstOrCreate([], [
            'site_name' => ['ar' => 'MDO', 'en' => 'MDO'],
            'site_title' => ['ar' => 'MDO Landscape', 'en' => 'MDO Landscape'],
            'site_desc' => ['ar' => 'Landscape studio', 'en' => 'Landscape studio'],
            'site_address' => ['ar' => 'Cairo, Egypt', 'en' => 'Cairo, Egypt'],
            'meta_key' => ['ar' => '', 'en' => ''],
            'meta_desc' => ['ar' => 'Landscape studio', 'en' => 'Landscape studio'],
            'site_phone' => '+201000000000',
            'site_email' => 'info@mdo-landscape.com',
            'email_support' => 'support@mdo-landscape.com',
            'logo' => 'uploads/images/logo.png',
            'light_logo' => 'uploads/images/logo.png',
            'dark_logo' => 'uploads/images/logo.png',
            'favicon' => 'uploads/images/logo.png',
            'site_copyright' => '© '.now()->year.' MDO. All rights reserved.',
            'promotion_url' => '#',
        ]);

        $this->fillFromModel();
    }

    protected function fillFromModel(): void
    {
        $this->site_name_ar = $this->settings->getTranslation('site_name', 'ar');
        $this->site_name_en = $this->settings->getTranslation('site_name', 'en');
        $this->site_title_ar = $this->settings->getTranslation('site_title', 'ar');
        $this->site_title_en = $this->settings->getTranslation('site_title', 'en');
        $this->site_desc_ar = $this->settings->getTranslation('site_desc', 'ar');
        $this->site_desc_en = $this->settings->getTranslation('site_desc', 'en');
        $this->site_address_ar = $this->settings->getTranslation('site_address', 'ar');
        $this->site_address_en = $this->settings->getTranslation('site_address', 'en');
        $this->meta_key_ar = $this->settings->getTranslation('meta_key', 'ar');
        $this->meta_key_en = $this->settings->getTranslation('meta_key', 'en');
        $this->meta_desc_ar = $this->settings->getTranslation('meta_desc', 'ar');
        $this->meta_desc_en = $this->settings->getTranslation('meta_desc', 'en');
        $this->site_phone = $this->settings->site_phone;
        $this->whatsapp = $this->settings->whatsapp;
        $this->site_email = $this->settings->site_email;
        $this->email_support = $this->settings->email_support;
        $this->facebook = $this->settings->facebook;
        $this->x_url = $this->settings->x_url;
        $this->youtube = $this->settings->youtube;
        $this->instagram = $this->settings->instagram;
        $this->tiktok = $this->settings->tiktok;
        $this->linkedin = $this->settings->linkedin;
        $this->logo = $this->settings->logo;
        $this->light_logo = $this->settings->light_logo ?: $this->settings->logo;
        $this->dark_logo = $this->settings->dark_logo ?: $this->settings->logo;
        $this->favicon = $this->settings->favicon;
        $this->site_copyright = $this->settings->site_copyright;
        $this->promotion_url = $this->settings->promotion_url;
        $this->resetValidation();
    }

    public function rules(): array
    {
        $rules = [
            'site_name_ar' => ['required', 'string', 'max:255'],
            'site_name_en' => ['required', 'string', 'max:255'],
            'site_title_ar' => ['required', 'string', 'max:255'],
            'site_title_en' => ['required', 'string', 'max:255'],
            'site_desc_ar' => ['required', 'string'],
            'site_desc_en' => ['required', 'string'],
            'site_address_ar' => ['required', 'string', 'max:255'],
            'site_address_en' => ['required', 'string', 'max:255'],
            'meta_key_ar' => ['nullable', 'string'],
            'meta_key_en' => ['nullable', 'string'],
            'meta_desc_ar' => ['required', 'string'],
            'meta_desc_en' => ['required', 'string'],
            'site_phone' => ['required', 'string', 'max:50'],
            'whatsapp' => ['nullable', 'string', 'max:50'],
            'site_email' => ['required', 'email', 'max:255'],
            'email_support' => ['required', 'email', 'max:255'],
            'facebook' => ['nullable', 'url'],
            'x_url' => ['nullable', 'url'],
            'youtube' => ['nullable', 'url'],
            'instagram' => ['nullable', 'url'],
            'tiktok' => ['nullable', 'url'],
            'linkedin' => ['nullable', 'url'],
            'site_copyright' => ['required', 'string'],
            'promotion_url' => ['nullable', 'string'],
        ];

        foreach (['logo', 'light_logo', 'dark_logo', 'favicon'] as $field) {
            $rules[$field] = $this->{$field} instanceof TemporaryUploadedFile
                ? ['nullable', 'image', 'max:4096']
                : ['nullable'];
        }

        return $rules;
    }

    protected function uploadAndReplace(string $field): void
    {
        $file = $this->{$field};

        if (! ($file instanceof UploadedFile) || ! $file->isValid()) {
            return;
        }

        $oldPath = $this->settings->{$field};
        if (! empty($oldPath) && $oldPath !== 'uploads/images/logo.png') {
            $this->imageManager->deleteImage($oldPath);
        }

        $this->settings->{$field} = $this->imageManager->uploadImage('uploads/settings', $file, 'public');
        $this->{$field} = $this->settings->{$field};
    }

    public function submit(): void
    {
        $data = $this->validate();

        foreach (['logo', 'light_logo', 'dark_logo', 'favicon'] as $field) {
            $this->uploadAndReplace($field);
        }

        $this->settings->setTranslations('site_name', ['ar' => $data['site_name_ar'], 'en' => $data['site_name_en']]);
        $this->settings->setTranslations('site_title', ['ar' => $data['site_title_ar'], 'en' => $data['site_title_en']]);
        $this->settings->setTranslations('site_desc', ['ar' => $data['site_desc_ar'], 'en' => $data['site_desc_en']]);
        $this->settings->setTranslations('site_address', ['ar' => $data['site_address_ar'], 'en' => $data['site_address_en']]);
        $this->settings->setTranslations('meta_key', ['ar' => (string) ($data['meta_key_ar'] ?? ''), 'en' => (string) ($data['meta_key_en'] ?? '')]);
        $this->settings->setTranslations('meta_desc', ['ar' => $data['meta_desc_ar'], 'en' => $data['meta_desc_en']]);

        $this->settings->fill([
            'site_phone' => $data['site_phone'],
            'whatsapp' => $data['whatsapp'] ?? null,
            'site_email' => $data['site_email'],
            'email_support' => $data['email_support'],
            'facebook' => $data['facebook'] ?? null,
            'x_url' => $data['x_url'] ?? null,
            'youtube' => $data['youtube'] ?? null,
            'instagram' => $data['instagram'] ?? null,
            'tiktok' => $data['tiktok'] ?? null,
            'linkedin' => $data['linkedin'] ?? null,
            'site_copyright' => $data['site_copyright'],
            'promotion_url' => $data['promotion_url'] ?? null,
        ]);

        $this->settings->save();

        $this->fillFromModel();
        $this->dispatch('settingUpdateMS');
    }

    public function render()
    {
        return view('dashboard.settings.update-settings');
    }
}
