<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BaseService
{
    protected $repository;

    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all($search = [], $relations = [])
    {
        return $this->repository->all($search, $relations);
    }

    public function search($field,  $search, $relations = [])
    {
        return $this->repository->search($field, $search, $relations = []);
    }

    public function report($from, $to, $search = [], $relations = [])
    {

        return $this->repository->report($from, $to, $search, $relations);
    }
    public function allWithout($search = [], $whereNot = [], $relations = [])
    {

        return $this->repository->allWithout($search, $whereNot, $relations);
    }

    public function find($searchField, $with = [])
    {
        $data = $this->repository->find($searchField, $with);

        if (!$data) {
            throw new NotFoundHttpException('Data tidak ditemukan');
        }

        return $data;
    }

    public function FindOrFalse($searchField, $with = [])
    {
        $data = $this->repository->find($searchField, $with);

        if (!$data) {
            return false;
        }

        return $data;
    }

    public function create(array $data, $with = [])
    {
        $newData = $this->repository->create($data, $with);

        return $this->repository->find([$newData->getKeyName() => $newData->getKey()], $with);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        $this->repository->delete($id);
    }
}
