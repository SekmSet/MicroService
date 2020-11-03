<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function destroy($id): int
    {
        return $this->model->destroy($id);
    }

    /**
     * @return Collection|Model[]
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @param $id
     * @return Model
     */
    public function findOrFail($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    // ? Model : retourne null ou un model
    public function findBy($field, $value) {
        return $this->model->find($value, $field);
    }
}