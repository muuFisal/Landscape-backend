<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectDetailsResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ServicesPageResource;
use App\Http\Resources\WorkPageResource;
use App\Services\Api\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(protected ProjectService $projectService)
    {
    }

    public function servicesPage()
    {
        $page = $this->projectService->servicesPage();
        if (!$page) return ApiResponse::sendResponse(200, __('front.Settings-retrieved-successfully'), []);
        return ApiResponse::sendResponse(200, __('front.Settings-retrieved-successfully'), new ServicesPageResource($page));
    }

    public function services()
    {
        $services = $this->projectService->activeServices();
        return ApiResponse::sendResponse(200, __('front.Settings-retrieved-successfully'), ServiceResource::collection($services));
    }

    public function workPage()
    {
        $page = $this->projectService->workPage();
        if (!$page) return ApiResponse::sendResponse(200, __('front.Settings-retrieved-successfully'), []);
        return ApiResponse::sendResponse(200, __('front.Settings-retrieved-successfully'), new WorkPageResource($page));
    }

    public function projects(Request $request)
    {
        $projects = $this->projectService->paginatedProjects(
            $request->integer('per_page', 10),
            $request->query('service')
        );

        return ApiResponse::sendResponse(200, __('front.Settings-retrieved-successfully'), ProjectResource::collection($projects), [
            'total' => $projects->total(),
            'current_page' => $projects->currentPage(),
            'last_page' => $projects->lastPage(),
            'per_page' => $projects->perPage(),
        ]);
    }

    public function projectDetails(string $slug)
    {
        $project = $this->projectService->projectDetails($slug);
        if (!$project) return ApiResponse::sendResponse(404, __('front.somthing-went-wrong'), []);

        return ApiResponse::sendResponse(200, __('front.Settings-retrieved-successfully'), new ProjectDetailsResource($project));
    }

    public function relatedProjects(string $slug)
    {
        $project = $this->projectService->projectDetails($slug);
        if (!$project) return ApiResponse::sendResponse(404, __('front.somthing-went-wrong'), []);

        $related = $this->projectService->relatedProjects($project);
        return ApiResponse::sendResponse(200, __('front.Settings-retrieved-successfully'), ProjectResource::collection($related->load('service')));
    }
}
