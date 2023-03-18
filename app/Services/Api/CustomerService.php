<?php

namespace App\Services\Api;

use App\Events\CustomerCreation;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Repositories\Eloquent\CustomerRepository;
use App\Repositories\Contracts\CustomerRepositoryContract;

class CustomerService
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepositoryContract $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index()
    {
        $customers= $this->customerRepository->all();
        return httpResponse(1, "Success", CustomerResource::collection($customers));
    }

    public function show($id)
    {
        $customer=  $this->customerRepository->find($id);
        return httpResponse(1, "Success", new CustomerResource($customer));

    }

    public function store($request)
    {
        $customer= $this->customerRepository->store($request);
        event(new CustomerCreation($customer));
        return httpResponse(1, "Success", new CustomerResource($customer));
    }

    public function update($id, $request)
    {
        $customer= $this->customerRepository->update($id, $request);
        return httpResponse(1, "Success", new CustomerResource($customer));
    }

    public function destroy($id)
    {
        $deletedCustomer =  $this->customerRepository->deleteById($id);
        if(! $deletedCustomer)
        {
            return httpResponse(0, 'Failed, something wrong try again');
        }
        
        return httpResponse(1, "Success");
    }
}