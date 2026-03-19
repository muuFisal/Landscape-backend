<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\About;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function genralSetting()
    {
        $settings = Setting::first();
        return view('dashboard.settings.index', compact('settings'));
    } //End genralSetting method


    public function aboutSetting()
    {
        $about = About::first();
        return view('dashboard.settings.about.index', compact('about'));
    } //End genralSetting method


    public function faqs()
    {
        return view('dashboard.settings.faqs.index');
    } //End faqs method



    public function privacy()
    {
        return view('dashboard.settings.privacy.index');
    }

    public function terms()
    {
        return view('dashboard.settings.terms.index');
    }

    public function banners()
    {
        return view('dashboard.settings.banners.index');
    }

    public function whyChoose()
    {
        return view('dashboard.settings.why-choose.index');
    }

    public function requestService()
    {
        return view('dashboard.settings.request-service.index');
    }

    public function galleryPage()
    {
        return view('dashboard.settings.gallery.index');
    }

    public function galleryItems()
    {
        return view('dashboard.settings.gallery.items');
    }

    public function servicesPage()
    {
        return view('dashboard.settings.services.index');
    }

    public function services()
    {
        return view('dashboard.services.index');
    }

    public function workPage()
    {
        return view('dashboard.settings.work.index');
    }

    public function projects()
    {
        return view('dashboard.projects.index');
    }

    public function contacts()
    {
        return view('dashboard.contacts.index');
    }
}
