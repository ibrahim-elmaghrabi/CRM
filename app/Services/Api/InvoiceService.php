<?php

namespace App\Services\Api;

use App\Http\Resources\InvoiceResource;
use App\Repositories\Eloquent\InvoiceRepository;
use App\Repositories\Eloquent\CustomerRepository;
use App\Repositories\Contracts\InvoiceRepositoryContract;
use App\Repositories\Contracts\CustomerRepositoryContract;

class InvoiceService
{
    private InvoiceRepository $invoiceRepository;

    private CustomerRepository $customerRepository;

    public function __construct(InvoiceRepositoryContract $invoiceContract, CustomerRepositoryContract $customerContract )
    {
        $this->invoiceRepository = $invoiceContract;
        $this->customerRepository= $customerContract;
    }
    public function index($customerId)
    {
        $invoices= $this->invoiceRepository->getWhere('customer_id', $customerId);
        return httpResponse(1, "Success", InvoiceResource::collection($invoices));
    }

    public function show(int $customerId, int $id)
    {
        $invoice = $this->invoiceRepository->find($id);
        if($invoice->customer_id != $customerId)
        {
            return httpResponse(0, "Failed: invoice not found");
        }
        return httpResponse(1, "Success", new InvoiceResource($invoice));
    }

    public function store($request, $customerId)
    {
         $customer = $this->customerRepository->find($customerId);
         if(! $customer)
         {
            return httpResponse(0, 'Failed: customer not found');
         }
         $invoice = $this->invoiceRepository->store($request);
         return httpResponse(1, "Success", new InvoiceResource($invoice));
    }

    public function update(int $customerId, int $id, $request)
    {
        $invoice = $this->invoiceRepository->find($id);
        if(! $invoice)
         {
            return httpResponse(0, 'Failed: Invoice not found');
         }
         if($invoice->customer_id != $customerId)
         {
            return httpResponse(0, 'Failed: Customer not found');
         }
        $updatedInvoice= $this->invoiceRepository->update($id, $request);
        return httpResponse(1, "Success", new InvoiceResource($updatedInvoice));
    }

    public function destroy(int $customerId, int $id)
    {
        $invoice = $this->invoiceRepository->find($id);
        if(! $invoice)
        {
            return httpResponse(0, 'Failed: Invoice not found');
        }
        if($invoice->customer_id != $customerId)
        {
            dd($invoice->customer_id, $customerId);
            return httpResponse(0, 'Failed: Customer not Found');
        }
        $invoice->delete();
        return httpResponse(1, "Success");
    }
}
