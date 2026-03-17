<?php

namespace App\Repositories\Api;

use App\Models\About;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Privacy;
use App\Models\Setting;
use App\Models\Terms;

class SettingRepository
{
    public function firstSettings(): ?Setting
    {
        return Setting::query()->first();
    }

    public function firstAbout(): ?About
    {
        return About::query()->first();
    }

    public function firstPrivacy(): ?Privacy
    {
        return Privacy::query()->first();
    }

    public function firstTerms(): ?Terms
    {
        return Terms::query()->first();
    }

    public function paginatedFaqs(int $perPage = 10)
    {
        return Faq::query()->where('status', 1)->paginate($perPage);
    }

    public function activeBanners()
    {
        return Banner::query()->where('status', 1)->get();
    }

    public function createContact(array $data): Contact
    {
        return Contact::query()->create($data);
    }
}
