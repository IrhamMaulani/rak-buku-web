<?php

namespace App\Services;

class BaseService
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function setRelationship($relations)
    {
        $this->model = $this->model->with($relations);
        return $this;
    }

    public function getDataPagination($data = 5)
    {
        return $this->model->paginate($data);
    }

    public function sortBy($order)
    {
        if ($order === null) $order = 'asc';

        $this->model = $this->model->orderBy('created_at', $order);
        return $this;
    }

    public function setValue($value)
    {
        $this->model = $this->mode->select($value);
        return $this;
    }

    public function setScope($scope, $value)
    {
        $this->model = $this->model->$scope($value);
        return $this;
    }
}
