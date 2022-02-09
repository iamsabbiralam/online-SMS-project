<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        
        return view('admin.service-list', [
            'services' => $services,
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
        return view('admin.service-add');
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
            "service" => "required|string|max:50", 
            "code" => "required|string",
            "status" => "required|string",
            "logo" => "required|mimes:jpg,png,jpeg,ico",
        ]);
        $input= $request->all();
        
        if ($request->hasfile('logo'))
        {
            $newImageName = time().'-'.$request->service.'.'.$request->logo->extension();
            $destination_path = 'public/images/services';
            $path = $request->file('logo')->storeAs($destination_path,$newImageName);
            
            $input['logo'] = $newImageName;
        }

        Service::create($input);

        session()->flash('message', 'Service Create Successfully.');

        return redirect()->route('admin.service-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $services = Service::find($id);
        return view('admin.service-edit',['services' => $services]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            "service" => "required",
            "code" => "required",
            "logo" => "nullable",

        ]);

        $input= [];
        if ($request->hasfile('logo'))
        {
            $newImageName = time().'-'.$request->service.'.'.$request->logo->extension();
            $destination_path = 'public/images/services';
            $path = $request->file('logo')->storeAs($destination_path,$newImageName);
            
            unlink('storage/images/services/'.$request->old_logo);
            $input['logo'] = $newImageName;
            $input['service'] = $request->service;
            $input['code'] = $request->code;
        }
        else
        {
            $input['logo'] = $request->old_logo;
            $input['service'] = $request->service;
            $input['code'] = $request->code; 
        }
        Service::where('id',$id)
        ->update($input);
        session()->flash('message', 'Service Update Successfully.');
        return redirect()->route('admin.service-list');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service,$id)
    {
        //
      $services = Service::find($id);
      $services->delete();
      unlink('storage/images/services/'.$services['logo']);

      session()->flash('message', 'Service Deleted Successfully.');
      return redirect()->route('admin.service-list');
    }

    public function status(Request $request,$status, $id)
    {

        $country_status = Service::find($id);
        $country_status->status= $status;
        $country_status->save();

        if ($status == 'deactive'){
            session()->flash('message', 'Service Deactivated Successfully');
        }
        else
        {
            session()->flash('message', 'Service Activated Successfully');
        }

        return redirect()->route('admin.service-list');



    }
}
