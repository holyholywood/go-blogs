<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function all($search = [], $with = [])
    {
        return $this->model::where($search)->with($with)->get();
    }

    public function report($from, $to, $search = [], $with = [])
    {
        return $this->model::whereBetween('created_at', [$from, $to])->with($with)->get();
    }
    public function allWithout($search = [], $whereNot = [], $with = [])
    {
        return $this->model::where($search)->whereNot('order_status', 'done')->with($with)->get();
    }

    public function find($searchField, $with = [])
    {
        return $this->model->with($with)->where($searchField)->first();
    }

    public function create(array $data, $with = [])
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->model->find($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->find($id);
        $model->delete();
    }
}
