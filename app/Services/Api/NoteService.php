<?php

namespace App\Services\Api;

use App\Http\Resources\NoteResource;
use App\Repositories\Eloquent\NoteRepository;
use App\Repositories\Eloquent\CustomerRepository;
use App\Repositories\Contracts\NoteRepositoryContract;
use App\Repositories\Contracts\CustomerRepositoryContract;

class NoteService
{
    private NoteRepository $noteRepository;

    private CustomerRepository $customerRepository;

    public function __construct(NoteRepositoryContract $noteContract, CustomerRepositoryContract $customerContract )
    {
        $this->noteRepository = $noteContract;
        $this->customerRepository= $customerContract;
    }
    public function index($customerId)
    {
        $notes= $this->noteRepository->getWhere('customer_id', $customerId);
        return httpResponse(1, "Success", NoteResource::collection($notes));
    }

    public function show(int $customerId, int $id)
    {
        $note = $this->noteRepository->find($id);
        if($note->customer_id != $customerId)
        {
            return httpResponse(0, "Failed: note not found");
        }
        return httpResponse(1, "Success", new NoteResource($note));
    }

    public function store($request, $customerId)
    {
         $customer = $this->customerRepository->find($customerId);
         if(! $customer)
         {
            return httpResponse(0, 'Failed: customer not found');
         }
         $note = $this->noteRepository->store($request);
         return httpResponse(1, "Success", new NoteResource($note));
    }

    public function update(int $customerId, int $id, $request)
    {
        $note = $this->noteRepository->find($id);
        if(! $note)
         {
            return httpResponse(0, 'Failed: Note not found');
         }
         if($note->customer_id != $customerId)
         {
            return httpResponse(0, 'Failed: Customer not found');
         }
        $updatedNote= $this->noteRepository->update($id, $request);
        return httpResponse(1, "Success", new NoteResource($updatedNote));
    }

    public function destroy(int $customerId, int $id)
    {
        $note = $this->noteRepository->find($id);
        if(! $note)
        {
            return httpResponse(0, 'Failed: Note not found');
        }
        if($note->customer_id != $customerId)
        {
            dd($note->customer_id, $customerId);
            return httpResponse(0, 'Failed: Customer not Found');
        }
        $note->delete();
        return httpResponse(1, "Success");
    }
}