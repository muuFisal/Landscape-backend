<?php

namespace App\Services\Api;

use App\Repositories\Api\ProjectRepository;
use App\Models\Project;

class ProjectService
{
    public function __construct(protected ProjectRepository $projectRepository)
    {
    }

    public function servicesPage()
    {
        return $this->projectRepository->firstServicesPage();
    }

    public function activeServices()
    {
        return $this->projectRepository->activeServices();
    }

    public function workPage()
    {
        return $this->projectRepository->firstWorkPage();
    }

    public function paginatedProjects(int $perPage = 10, ?string $serviceSlug = null)
    {
        return $this->projectRepository->paginatedProjects($perPage, $serviceSlug);
    }

    public function projectDetails(string $slug)
    {
        return $this->projectRepository->projectDetails($slug);
    }

    public function relatedProjects(Project $project)
    {
        return $this->projectRepository->relatedProjects($project);
    }
}
