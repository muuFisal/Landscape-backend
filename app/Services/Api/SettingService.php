<?php

namespace App\Services\Api;

use App\Repositories\Api\SettingRepository;

class SettingService
{
    public function __construct(protected SettingRepository $settingRepository)
    {
    }

    public function getSettings()
    {
        return $this->settingRepository->firstSettings();
    }

    public function getAbout()
    {
        return $this->settingRepository->firstAbout();
    }

    public function getPrivacy()
    {
        return $this->settingRepository->firstPrivacy();
    }

    public function getTerms()
    {
        return $this->settingRepository->firstTerms();
    }

    public function getFaqs(int $perPage = 10)
    {
        return $this->settingRepository->paginatedFaqs($perPage);
    }

    public function getBanners()
    {
        return $this->settingRepository->activeBanners();
    }

    public function whyChoose()
    {
        return $this->settingRepository->firstWhyChoose();
    }

    public function requestService()
    {
        return $this->settingRepository->firstRequestService();
    }

    public function galleryPage()
    {
        return $this->settingRepository->firstGalleryPage();
    }

    public function galleryItems(int $perPage = 10)
    {
        return $this->settingRepository->activeGalleryItems($perPage);
    }

    public function createContact(array $data)
    {
        return $this->settingRepository->createContact($data);
    }
}
