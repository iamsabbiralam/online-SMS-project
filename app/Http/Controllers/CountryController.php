<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $countries = Country::all();
        return view('admin.country-list',[
            'countries' => $countries, 
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
        $countries = Country::all();
        return view('admin.country-add');
       
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
            "country" => "required",
            "code" => "required",
            "status" => "required",
            "flag" => "required",

        ]);


        
        $input= $request->all();

        if ($request->hasfile('flag'))
        {
            $newImageName = time().'-'.$request->country.'.'.$request->flag->extension();
            $destination_path = 'public/images/country';
            $path = $request->file('flag')->storeAs($destination_path,$newImageName);
            
            $input['flag'] = $newImageName;
        }
      
        
        Country::create($input);
        
        session()->flash('message', 'Country add Successfully.');

        return redirect()->route('admin.country-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $countries = Country::find($id);
        return view('admin.country-edit',['countries' => $countries]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        $request->validate([
            "country" => "required",
            "code" => "required",
            "flag" => "nullable",

        ]);

        $input= [];
        if ($request->hasfile('flag'))
        {
            $newImageName = time().'-'.$request->country.'.'.$request->flag->extension();
            $destination_path = 'public/images/country';
            $path = $request->file('flag')->storeAs($destination_path,$newImageName);
            
            unlink('storage/images/country/'.$request->old_flag);
            $input['flag'] = $newImageName;
            $input['country'] = $request->country;
            $input['code'] = $request->code;
        }
        else
        {
            $input['flag'] = $request->old_flag;
            $input['country'] = $request->country;
            $input['code'] = $request->code; 
        }
        Country::where('id',$id)
        ->update($input);
        session()->flash('message', 'Country Update Successfully.');
        return redirect()->route('admin.country-list');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country,$id)
    {
        //
        $country = Country::find($id);
        $country->delete();
        unlink('storage/images/country/'.$country['flag']);

        session()->flash('message', 'Country Deleted Successfully.');
        return redirect()->route('admin.country-list');


    }

    public function status(Request $request,$status, $id)
    {

        $country_status = Country::find($id);
        $country_status->status= $status;
        $country_status->save();

        if ($status == 'deactive'){
            session()->flash('message', 'Country Deactivated Successfully');
        }
        else
        {
            session()->flash('message', 'Country Activated Successfully');
        }

        return redirect()->route('admin.country-list');



    }
}
