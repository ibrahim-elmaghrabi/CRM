<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->name,
            "status" => ($this->status) ? 'active' : 'not active',
            "cost" => $this->cost,
            "customer" => $this->customer->name,
            "date" => $this->updated_at
        ];
    }
}
