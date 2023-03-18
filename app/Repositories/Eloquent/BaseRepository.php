<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\BaseRepositoryContract;

class BaseRepository implements BaseRepositoryContract
{
    private Model $model;

    public function all(): ?Collection
    {
        return $this->model->all();
    }

     public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function firstWhere($column, $value): ?Model
    {
        return $this->model->where($column, $value)->first();
    }

    public function getWhere($column, $value): ?Collection
    {
        return $this->model->where($column, $value)->get();
    }

    public function store(array $data): ?Model
    {
        foreach ($data as $field => $value)
        {
            $this->model->{$field} = $value;
        }
        $this->model->save();

        return $this->model;
    }

    public function update(int $id, array $data): ?Model
    {
        $model = $this->model->find($id);
        $model->update($data);
        return $model->fresh();
    }

    public function deleteById($id): ?bool
    {
        $this->model = $this->model->find($id);
        return $this->model->delete($id);
    }

    public function delete(): ?bool
    {
        return $this->model->delete();
    }

       public function getModel(): Model
    {
        return $this->model;
    }

    public function setModel(Model $model): void
    {
        $this->model= $model;
    }

  
}