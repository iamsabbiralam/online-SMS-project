<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\PriceOperation;
use App\Models\RentNumber;
use App\Models\User;
use App\Models\Service;
use App\Models\UserHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class RentNumberController extends Controller
{
    public function Countries ()
    {
        
        $countries = Helper::getCountries();

        $country1 = $countries[0]['data'][0]['code'];

        $services = Helper::getServices($country1);

        $addprice = PriceOperation::latest()->first('price_value')->price_value;

        return view('user.rent-number',['countries' => $countries[0]['data'], 'services' => $services[0]['data'], 'con' => $country1, 'addprice' => $addprice]);
        /*
        inside of $countries
        [{"status":1,"data":[{"name":"Russian Federation","code":"RU"},
        {"name":"Ukraine","code":"UA"},{"name":"Estonia","code":"EE"},
        {"name":"United Kingdom","code":"UK"},{"name":"Sweden","code":"SE"},
        {"name":"Spain","code":"ES"},{"name":"Portugal","code":"PT"},
        {"name":"Netherlands","code":"NL"},{"name":"Lithuania","code":"LT"},
        {"name":"Latvia","code":"LV"},{"name":"Ireland","code":"IE"},
        {"name":"France","code":"FR"},{"name":"United States","code":"US"}]}]

        status 1 mane hocce data asche and status 0 mane data ase ni 
         */
        

    }

    public function get_service ($code)
    {
        $country = $code;

        $services = Helper::getServices($country);
        $selectedPrice = PriceOperation::latest()->first('price_value')->price_value;

        $data = [$selectedPrice, $services];

        return Response::json($data);
    }

    public function rent_number (Request $req)
    {
        $country = $req->country;
        $dcount = $req->dcount;
        $dtype = $req->dtype;
        $service = $req->service;
        if ($dtype == 'week'){
            $cost = $req->cost/($dcount*7);
        }
        else{
            $cost = $req->cost/($dcount*30);
        }

        $sendApi = [
            'method' => 'create',
            'dcount' => $dcount,
            'dtype' => $dtype,
            'country' => $country,
            'service' => $service
        ];

        $rentNumber = Helper::rentNumber($sendApi);
        $history = Service::where('code', $service)->first();

        if($rentNumber[0]['status'] == 1) {
            $rent = new RentNumber;
            $rent->user_id = Auth::user()->id;
            $rent->status = $rentNumber[0]['status'];
            $rent->phone_number = $rentNumber[0]['data']['pnumber'];
            $rent->number_id = $rentNumber[0]['data']['id'];
            $rent->c_code = $rentNumber[0]['data']['ccode'];
            $rent->service = $rentNumber[0]['data']['service'];
            $rent->is_active = 0;
            $rent->day_price = $cost;
            $rent->expire_at = $rentNumber[0]['data']['until'];
            $rent->save();

            $id = Auth::user()->id;
            $user = User::where('id', $id)->update(['balance' => $req->cost]);

            $uh = new UserHistory;
            $uh->user_id = Auth::user()->id;
            $uh->service = $history->service;
            $uh->phone_number = $rentNumber[0]['data']['pnumber'];
            $uh->cost = $req->cost;
            $uh->description = "A number rental ". $rentNumber[0]['data']['pnumber']." on ".$dcount." ".$dtype.", Service(s): $history->service";
            $uh->save();
        }

        return Response::json($rentNumber);
    }

    public function my_number () {

        $numbers = RentNumber::all();

        return view('user.my-number',['numbers' => $numbers]);
    }

    public function rent_number_activation ($id)
    {
        $activeStatus = Helper::activating($id);

        if($activeStatus[0]['status'] == 1){
           
            $RentNumber = RentNumber::where('number_id', $id)->first(); 
        }

        $data = [$activeStatus, $RentNumber];

        return Response::json($data);
    }

    public function rent_number_sms ($id)
    {
        $sms = Helper::rentNumberSms($id);
        $number = RentNumber::where('number_id', $id)->first()->phone_number;

        $data = [$sms, $number];
        return Response::json($data);
    }

    public function loadprolongmodal ($id)
    {
        $number = RentNumber::where('number_id', $id)->first();
        $services = Service::where('code', $number->service)->first();
        $timestamp2 = strtotime($number->created_at. '+ 136 days');
        $created = date('d M Y H:i A', $timestamp2);

        $data = [$services, $number, $created];

        return json_encode($data); 
    }

    public function rent_number_prolongation (Request $request, $id)
    {
        $day = "";
        $dcount = $request->dcount;
        $dtype = $request->dtype;

        $expire = RentNumber::where('number_id', $request->id)->first();
        if ($dtype == 'week'){
            $cost = $dcount*7*$expire->day_price;
        }
        else{
            $cost = $dcount*30*$expire->day_price;
        }
        if($cost < Auth::user()->balance) {
            $sendApi = [
                'method' => 'prolong',
                'dcount' => $dcount,
                'dtype' => $dtype,
                'id' => $id
            ];
            $prolong = Helper::prolongation($sendApi);
            if($prolong[0]['status'] == 1){
                if ($dtype == 'week'){
                    $day = $dcount*7;
                }
                else{
                    $day = $dcount*30;
                }
                $oldDate   = date($expire->expire_at);
                $date1 = strtotime('+'.$day.' day', $oldDate);
                $rent = RentNumber::where('number_id', $request->id)->update(['expire_at' => $date1, 'is_active' => 1]);
                $day = [date('d M Y H:i A', $date1), $expire->expire_at];
            }
        }
        return Response::json($day);
    }

    public function rent_number_remove ($id)
    {
        $removeNumber = Helper::removing($id);
        if($removeNumber[0]['status'] == 1){
            $rentNumber = RentNumber::where('number_id', $id)->first();
            $uh = new UserHistory;
            $uh->user_id = Auth::user()->id;
            $uh->phone_number = $rentNumber->phone_number;
            $uh->cost = 0.00;
            $uh->description = "Deleting rented number ".$rentNumber->phone_number."";
            $uh->save();
            $RentNumber = RentNumber::where('number_id', $id)->delete();
        }

        return Response::json($id);
    }
}
