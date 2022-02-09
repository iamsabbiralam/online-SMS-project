<?php

namespace App\Http\Controllers;

use App\Models\ApiOperation;
use App\Models\PriceOperation;
use App\Models\adminOperation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $operations = adminOperation::all();

        return view('admin.admin-operation-list', [
            'operations' => $operations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $operations = adminOperation::all();
        return view('admin.admin-operation-add', [
            'operations' => $operations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            "operation_name" => "required|unique:admin_operations",
            "operation_value" => "required",

        ]);

        $input= $request->all();

        adminOperation::create($input);
        
        session()->flash('message', 'Admin Operation Add Successfully.');

        return redirect()->route('admin.operation-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\adminOperation  $adminOperation
     * @return \Illuminate\Http\Response
     */
    public function show(adminOperation $adminOperation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\adminOperation  $adminOperation
     * @return \Illuminate\Http\Response
     */
    public function edit(adminOperation $adminOperation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\adminOperation  $adminOperation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, adminOperation $adminOperation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\adminOperation  $adminOperation
     * @return \Illuminate\Http\Response
     */
    public function destroy(adminOperation $adminOperation, $id)
    {
        //
        $adminOperation = adminOperation::find($id);
        $adminOperation->delete();
        session()->flash('message', 'Operation Deleted Successfully.');
        return redirect()->route('admin.operation-list');
    }

    public function operationView ()
    {
        $apiQry = [];
        $priceQry = [];

        $operationDatas = adminOperation::all();

        foreach($operationDatas as $operationData)
        {   
            $optName= $operationData['operation_name'];
            $dataPrefix = explode('_', $optName);
        
            if($dataPrefix[0] === 'api')
            {
                $apiQry[] = $operationData;
            }
            elseif($dataPrefix[0] === 'price')
            {
                $priceQry[] = $operationData;
            }
        }

        $selectedApi = ApiOperation::latest()->first('api_name');
        $selectedPrice = PriceOperation::latest()->first('price_name');

        return view('admin.admin-operationView', [
            'apiQry' => $apiQry,
            'priceQry' => $priceQry,
            'selectedApi' => $selectedApi,
            'selectedPrice' => $selectedPrice,
        ]);

    }

    public function operationApiStore (Request $request)
    {   
        $input = [];
        $request->validate([
            "operation_name" => "required"
        ]);
        $apiData = adminOperation::select('operation_name','operation_value')->where('operation_name', $request->operation_name)->get();
        
        $input['api_name'] = $apiData[0]['operation_name'];
        $input['api_value'] = $apiData[0]['operation_value'];

        ApiOperation::create($input);

        session()->flash('message', 'API Change Successfully.');

        return redirect()->route('admin.operationView');
    }

    public function operationPriceStore (Request $request)
    {
        $input = [];
        $request->validate([
            "operation_name" => "required"
        ]);
        $priceData = adminOperation::select('operation_name','operation_value')->where('operation_name', $request->operation_name)->get();
        
        $input['price_name'] = $priceData[0]['operation_name'];
        $input['price_value'] = $priceData[0]['operation_value'];

        PriceOperation::create($input);

        session()->flash('message', 'Price Change Successfully.');

        return redirect()->route('admin.operationView');
    }
}
