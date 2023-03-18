<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\InvoiceService;
use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;

class InvoiceController extends Controller
{
    private InvoiceService $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index(int $customerId)
    {
        return $this->invoiceService->index($customerId);
    }

    public function show(int $customerId, int $id )
    {
        return $this->invoiceService->show($customerId,$id);
    }

    public function store(InvoiceRequest $request, $customerId)
    {
        return $this->invoiceService->store($request->validated()+['customer_id' => $customerId], $customerId);
    }

    public function update(int $customerId, int $id, InvoiceRequest $request)
    {
        return $this->invoiceService->update($customerId, $id, $request->validated());
    }

    public function destroy(int $customerId, int $id)
    {
        return $this->invoiceService->destroy($customerId, $id);
    }
}
