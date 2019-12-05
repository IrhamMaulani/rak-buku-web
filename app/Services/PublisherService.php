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

        return  $this->setScope('search', $search)->setValue(['id', 'name'])
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
}
