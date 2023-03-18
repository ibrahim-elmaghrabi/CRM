<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\ProjectService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    private ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index(int $customerId)
    {
        return $this->projectService->index($customerId);
    }

    public function show(int $customerId, int $id)
    {
        return $this->projectService->show($customerId, $id);
    }

    public function store(ProjectRequest $request, $customerId)
    {
        return $this->projectService->store($request->validated()+['customer_id' => $customerId], $customerId);
    }

    public function update(int $customerId, int $id, ProjectRequest $request)
    {
        return $this->projectService->update($customerId, $id, $request->validated());
    }

    public function destroy(int $customerId, int $id)
    {
        return $this->projectService->destroy($customerId, $id);
    }
}
