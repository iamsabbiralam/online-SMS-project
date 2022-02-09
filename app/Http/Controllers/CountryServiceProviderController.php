<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CountryServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countryServiceProviders = CountryServiceProvider::all();
        
        return view('admin.country-service-provider-list', [
            'countryServiceProviders' => $countryServiceProviders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.country-service-provider-add', [
            'countries' => $countries,
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
            "country_id" => "required",
            "country_service_provider" => "required",

        ]);

        $input= $request->all();

        CountryServiceProvider::create($input);
        
        session()->flash('message', 'Country Service Provider Add Successfully.');

        return redirect()->route('admin.c-s-p-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CountryServiceProvider  $countryServiceProvider
     * @return \Illuminate\Http\Response
     */
    public function show(CountryServiceProvider $countryServiceProvider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CountryServiceProvider  $countryServiceProvider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $edit = CountryServiceProvider::find($id);

        return view('admin.editprovider', [ 'edit' => $edit ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CountryServiceProvider  $countryServiceProvider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, $id)
    {
        //
        $data->validate([
            'country_id' => 'required',
            'country_service_provider' => 'required'
        ]);

        $provider = CountryServiceProvider::find($id);
        $provider->country_id = $data->country_id;
        $provider->country_service_provider = $data->country_service_provider;
        $provider->save();

        session()->flash('message', 'Country Service Provider Updated Successfully.');

        return redirect()->route('admin.c-s-p-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CountryServiceProvider  $countryServiceProvider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $pro = CountryServiceProvider::find($id)->delete();

        session()->flash('message', 'Country Service Provider Deleted Successfully.');

        return redirect()->route('admin.c-s-p-list');
    }
}
