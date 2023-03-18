<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\CustomerService;
use App\Http\Requests\CustomerRequest;
use App\Services\Api\CustomerExportService;

class CustomerController extends Controller
{
    private CustomerService $customerService;
    private CustomerExportService $customerExportService;
    
    public function __construct(CustomerService $customerService, CustomerExportService $customerExportService)
    {
        $this->customerService= $customerService;
        $this->customerExportService= $customerExportService;
    }

    public function index()
    {
      return $this->customerService->index();
    }

    public function show(int $id)
    {
        return $this->customerService->show($id) ?? response()->json(['status' => 'customer notFound'], Response::HTTP_NOT_FOUND);
     }

    public function store(CustomerRequest $request)
    {
        return $this->customerService->store($request->validated());
    }

    public function update($id, CustomerRequest $request)
    {
        return $this->customerService->update($id, $request->validated());
    }

    public function destroy(int $id)
    {
        return $this->customerService->destroy($id);
    }

    public function export(Request $request)
    {
        return $this->customerExportService->export($request->formate);
    }
}
