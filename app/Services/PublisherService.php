<?php

namespace App\Services;

use App\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublisherService extends BaseService
{

    private $publisher;

    public function __construct(Publisher $publisher)
    {
        $this->publisher = $publisher;
        parent::__construct($publisher);
    }

    public function getAllData(Request $request)
    {
        $search = null;
        $orderBy = null;
        $order = null;


        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('search')) $search = $request->query('search');
        if ($request->has('order')) $order = $request->query('order');

        return  $this->setScope('search', $search)->setValue(['id', 'name', 'address', 'city', 'country'])
            ->orderBy($orderBy, $order)->getAllDatas();
    }

    public function addData(Request $request)
    {
        try {
            $this->publisher->create($request->all());
        } catch (\Exception $e) {
            return 'Failed';
        }
        return "Success";
    }

    public function updateData(Request $request, $publisherId)
    {
        try {
            $publisher = $this->publisher->findOrFail($publisherId);

            $publisher->update($request->all());
        } catch (\Throwable $th) {
            return 'Failed';
        }
        return "Success";
    }

    public function getData($publisherId)
    {
        try {
            return $this->publisher->findOrFail($publisherId);
        } catch (\Throwable $th) {
            return "Can't Find Data";
        }
    }

    public function deleteData($publisherId)
    {
        try {
            $this->publisher->destroy($publisherId);
        } catch (\Throwable $th) {
            return "Fail";
        }
        return "Success";
    }
}
