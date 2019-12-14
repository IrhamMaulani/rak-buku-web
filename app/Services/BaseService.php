<?php

namespace App\Services;

use Illuminate\Support\Facades\Schema;




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

    public function orderBy($orderBy, $order)
    {

        if ($order === null) $order = 'asc';

        if ($orderBy === null) $orderBy = 'created_at';

        $this->model = $this->model->orderBy($orderBy, $order);
        return $this;
    }

    public function getAllDatas()
    {
        return $this->model->get();
    }

    public function getFirst(){
        return $this->model->first();
    }



    public function setValue($value)
    {
        $this->model = $this->model->select($value);
        return $this;
    }

    public function setCondition($condition, $operator = "=" , $value){
        
        $this->model = $this->model->where($condition,$operator, $value);
        return $this;
    }

    public function setScope($scope, $value)
    {
        $this->model = $this->model->$scope($value);
        return $this;
    }
}
