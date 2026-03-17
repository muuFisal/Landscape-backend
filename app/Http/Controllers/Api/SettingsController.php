<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactRequest;
use App\Http\Resources\AboutResource;
use App\Http\Resources\BannerResource;
use App\Http\Resources\FaqResource;
use App\Http\Resources\PrivacyResource;
use App\Http\Resources\Settings\SettingResource;
use App\Http\Resources\TermsResource;
use App\Services\Api\SettingService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct(protected SettingService $settingService)
    {
    }

    public function index(Request $request)
    {
        $settings = $this->settingService->getSettings();

        if (! $settings) {
            return ApiResponse::sendResponse(404, __('front.somthing-went-wrong'), []);
        }

        return ApiResponse::sendResponse(200, __('front.Settings-retrieved-successfully'), new SettingResource($settings));
    }

    public function about()
    {
        $about = $this->settingService->getAbout();

        if (! $about) {
            return ApiResponse::sendResponse(404, __('dashboard.somthing-went-wrong'), []);
        }

        return ApiResponse::sendResponse(200, __('dashboard.about-retrieved-successfully'), new AboutResource($about));
    }

    public function privacy()
    {
        $privacy = $this->settingService->getPrivacy();

        if (! $privacy) {
            return ApiResponse::sendResponse(404, __('dashboard.somthing-went-wrong'), []);
        }

        return ApiResponse::sendResponse(200, __('dashboard.privacy-retrieved-successfully'), new PrivacyResource($privacy));
    }

    public function terms()
    {
        $terms = $this->settingService->getTerms();

        if (! $terms) {
            return ApiResponse::sendResponse(404, __('dashboard.somthing-went-wrong'), []);
        }

        return ApiResponse::sendResponse(200, __('dashboard.privacy-retrieved-successfully'), new TermsResource($terms));
    }

    public function faq(Request $request)
    {
        $faq = $this->settingService->getFaqs((int) $request->integer('per_page', 10));

        return ApiResponse::sendResponse(200, __('dashboard.faq-retrieved-successfully'), FaqResource::collection($faq), [
            'total' => $faq->total(),
            'current_page' => $faq->currentPage(),
            'last_page' => $faq->lastPage(),
            'per_page' => $faq->perPage(),
        ]);
    }

    public function contact(ContactRequest $request)
    {
        $this->settingService->createContact($request->validated());

        return ApiResponse::sendResponse(201, __('front.contact-send-successfully'), []);
    }

    public function banners()
    {
        $banners = $this->settingService->getBanners();

        if ($banners->isEmpty()) {
            return ApiResponse::sendResponse(404, __('front.no-banners-found'), []);
        }

        return ApiResponse::sendResponse(200, __('front.retrieved-successfully'), BannerResource::collection($banners));
    }
}
