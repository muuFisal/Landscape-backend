<?php

namespace App\Services\Dashboard;

use App\Models\Admin;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;

class HomeService
{
    public function getHomeData(): array
    {
        $stats = [
            [
                'label' => 'total-admins',
                'count' => Admin::count(),
                'icon' => 'fa-solid fa-user-shield',
                'color' => 'primary',
            ],
            [
                'label' => 'total-users',
                'count' => User::count(),
                'icon' => 'fa-solid fa-users',
                'color' => 'info',
            ],
            [
                'label' => 'total-services',
                'count' => Service::count(),
                'icon' => 'fa-solid fa-grip',
                'color' => 'success',
            ],
            [
                'label' => 'total-projects',
                'count' => Project::count(),
                'icon' => 'fa-solid fa-layer-group',
                'color' => 'warning',
            ],
            [
                'label' => 'total-contacts',
                'count' => Contact::count(),
                'icon' => 'fa-solid fa-envelope-open-text',
                'color' => 'danger',
            ],
            [
                'label' => 'total-faqs',
                'count' => Faq::count(),
                'icon' => 'fa-solid fa-circle-question',
                'color' => 'secondary',
            ],
            [
                'label' => 'total-gallery-items',
                'count' => Gallery::count(),
                'icon' => 'fa-solid fa-image',
                'color' => 'primary',
            ],
        ];

        $latestContacts = Contact::query()
            ->select(['id', 'name', 'email', 'phone', 'subject', 'created_at'])
            ->latest()
            ->take(5)
            ->get();

        $latestProjects = Project::query()
            ->with(['service:id,title'])
            ->select(['id', 'service_id', 'title', 'year', 'status', 'created_at'])
            ->latest()
            ->take(5)
            ->get();

        $projectsByService = Service::query()
            ->select(['id', 'title'])
            ->withCount('projects')
            ->orderByDesc('projects_count')
            ->take(5)
            ->get();

        return [
            'stats' => $stats,
            'latestContacts' => $latestContacts,
            'latestProjects' => $latestProjects,
            'projectsByService' => $projectsByService,
            'asOf' => now(),
        ];
    }
}
