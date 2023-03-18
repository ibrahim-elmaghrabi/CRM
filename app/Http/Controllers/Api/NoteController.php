<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\NoteService;
use App\Http\Requests\NoteRequest;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    private NoteService $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function index(int $customerId)
    {
        return $this->noteService->index($customerId);
    }

    public function show(int $customerId, int $id )
    {
        return $this->noteService->show($customerId,$id);
    }

    public function store(NoteRequest $request, $customerId)
    {
        return $this->noteService->store($request->validated()+['customer_id' => $customerId], $customerId);
    }

    public function update(int $customerId, int $id, NoteRequest $request)
    {
        return $this->noteService->update($customerId, $id, $request->validated());
    }

    public function destroy(int $customerId, int $id)
    {
        return $this->noteService->destroy($customerId, $id);
    }
}
