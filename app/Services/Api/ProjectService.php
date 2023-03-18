<?php

namespace App\Services\Api;

use App\Events\ProjectCreation;
use App\Http\Resources\ProjectResource;
use App\Repositories\Eloquent\ProjectRepository;
use App\Repositories\Eloquent\CustomerRepository;
use App\Repositories\Contracts\ProjectRepositoryContract;
use App\Repositories\Contracts\CustomerRepositoryContract;

class ProjectService
{
    private ProjectRepository $projectRepository;

    private CustomerRepository $customerRepository;

    public function __construct(ProjectRepositoryContract $projectContract, CustomerRepositoryContract $customerContract )
    {
        $this->projectRepository = $projectContract;
        $this->customerRepository= $customerContract;
    }
    public function index($customerId)
    {
        $projects= $this->projectRepository->getWhere('customer_id', $customerId);
        return httpResponse(1, "Success", ProjectResource::collection($projects));
    }

    public function show(int $customerId, int $id)
    {
        $project = $this->projectRepository->find($id);
        if($project->customer_id != $customerId)
        {
            return httpResponse(0, "Failed: project not found");
        }
        return httpResponse(1, "Success", new ProjectResource($project));
    }

    public function store($request, $customerId)
    {
         $customer = $this->customerRepository->find($customerId);
         if(! $customer)
         {
            return httpResponse(0, 'Failed: customer not found');
         }
         $project = $this->projectRepository->store($request);
         event(new ProjectCreation($project));
         return httpResponse(1, "Success", new ProjectResource($project));
    }

    public function update(int $customerId, int $id, $request)
    {
        $project = $this->projectRepository->find($id);
        if(! $project)
         {
            return httpResponse(0, 'Failed: project not found');
         }
         if($project->customer_id != $customerId)
         {
            return httpResponse(0, 'Failed: Customer not found');
         }
        $updatedProject= $this->projectRepository->update($id, $request);
        return httpResponse(1, "Success", new ProjectResource($updatedProject));
    }

    public function destroy(int $customerId, int $id)
    {
        $project = $this->projectRepository->find($id);
        if(! $project)
        {
            return httpResponse(0, 'Failed: Project not found');
        }
        if($project->customer_id != $customerId)
        {
            dd($project->customer_id, $customerId);
            return httpResponse(0, 'Failed: Customer not Found');
        }
        $project->delete();
        return httpResponse(1, "Success");
    }
}