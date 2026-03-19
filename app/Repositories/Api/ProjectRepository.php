<?php

namespace App\Repositories\Api;

use App\Models\Project;
use App\Models\Service;
use App\Models\ServicesPage;
use App\Models\WorkPage;

class ProjectRepository
{
    public function firstServicesPage(): ?ServicesPage
    {
        return ServicesPage::query()->first();
    }

    public function activeServices()
    {
        return Service::query()->where('status', true)->orderBy('sort_order', 'asc')->get();
    }

    public function firstWorkPage(): ?WorkPage
    {
        return WorkPage::query()->first();
    }

    public function paginatedProjects(int $perPage = 10, ?string $serviceSlug = null)
    {
        $query = Project::query()->where('status', true);

        if ($serviceSlug) {
            $query->whereHas('service', function($q) use ($serviceSlug) {
                $q->where('slug', $serviceSlug);
            });
        }

        return $query->with('service')
            ->orderBy('sort_order', 'asc')
            ->paginate($perPage);
    }

    public function projectDetails(string $slug): ?Project
    {
        return Project::query()
            ->where('slug', $slug)
            ->where('status', true)
            ->with(['service', 'images' => function($q) {
                $q->where('status', true)->orderBy('sort_order', 'asc');
            }])
            ->first();
    }

    public function relatedProjects(Project $project, int $count = 3)
    {
        return Project::query()
            ->where('service_id', $project->service_id)
            ->where('id', '!=', $project->id)
            ->where('status', true)
            ->orderBy('sort_order', 'asc')
            ->take($count)
            ->get();
    }
}
