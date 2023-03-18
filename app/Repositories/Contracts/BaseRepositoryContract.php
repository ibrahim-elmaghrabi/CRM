<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface BaseRepositoryContract
{
    public function all(): ?Collection;
    public function find($id): ?Model;
    public function store(array $data): ?Model;
    public function firstWhere($column, $value): ?Model;
    public function getWhere($column, $value): ?Collection;
    public function update(int $id, array $data): ?Model;
    public function deleteById($id): ?bool;
    public function delete(): ?bool;


}