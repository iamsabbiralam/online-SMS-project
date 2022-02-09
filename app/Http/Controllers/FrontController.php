<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\User;
use App\Models\Service;
use App\Models\PriceOperation;
use App\Helpers\Helper;
use App\Models\UserHistory;
use App\Models\OnlineCount;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    //
    public function index() {

        $countries = Country::where('status', 'active')->get();

        $service = Service::where('status', 'active')->get();

        return view('welcome', ['countries' => $countries, 'services' => $service]);
    }

    public function confirm_number(Request $req) {

        $sendApi = [
            'metod' => 'get_service_price',
            'country' => $req->country,
            'service' => $req->service
        ]; 
        $priceData = Helper::apiData($sendApi);
        $selectedPrice = PriceOperation::latest()->first('price_value')->price_value;
        $country = Country::where('code', $req->country)->get();
        $service = Service::where('code', $req->service)->get();

        $data = [$selectedPrice, $priceData, $country, $service];
        return Response::json($data);
    } 

    public function country_code($code) {
        
        $serviceCodes = [];
        $online = [];

        $country = Country::where('code', $code)->first()->id;
        $services = Service::select('id','code')->where('status', 'active')->get();
        
        foreach ($services as $service) {
            $serviceCodes[]= $service['code'];
            $onlineCount = OnlineCount::where('country_id', $country)->where('service_id', $service->id)->first();
            if($onlineCount != ""){
                $online[] = $onlineCount->count;
            }
            else{
                $online[] = "0";
            }
          
        }

        $country = $code;
        /*$sendApi = [
            'metod' => 'get_service_price',
            'country' => $country,
            'service' => $serviceCodes
        ]; 
        $priceData = Helper::apiData($sendApi);*/
        $selectedPrice = PriceOperation::latest()->first('price_value')->price_value;

        $data = [$selectedPrice, $services, $online];
        /*
        inside of $selectedPrice look like 
        $selectedPrice = "20";

        inside of $priceData look like 
        $priceData = [{"response":"1","country":"RU","service":"opt28","price":"0.20"},
                    {"response":"1","country":"RU","service":"opt97","price":"0.30"},
                    {"response":"1","country":"RU","service":"opt22","price":"0.10"},
                    {"response":"1","country":"RU","service":"opt86","price":"1.00"}]
        */
        return Response::json($data);

        // $code = "ru"
        // return json_encode($code);
    }

    public function service_code(Request $req) {

        $country = $req->countrycode;
        $service = $req->servicecode;

        $sendApi = [
            'metod' => 'get_number',
            'country' => $country,
            'service' => $service
        ]; 
        $getNumber = Helper::getNumber($sendApi);
        $service = Service::where('code', $service)->first();

        $data = [$service, $getNumber];
        /*
        inside of $getNumber
        $getNumber = [{"response":"1","number":"9619203948","id":81053473,
            "again":0,"text":null,"extra":"","karma":42.08000000000003,
            "pass":null,"sms":null,"balanceOnPhone":0,"service":null,
            "country":null,"CountryCode":"+7","branchId":0,"callForwarding":false,
            "goipSlotId":-1,"lifeSpan":600}]
         */
        return Response::json($data);
        //return json_encode($req);
    }

    public function cancel_number(Request $req) {

        $id = $req->id;
        $country= $req->country;
        $service = $req->service;

        $sendApi = [
            'metod' => 'denial',
            'id' => $id,
            'country' => $country,
            'service' => $service
        ]; 

        $cancelNumber = Helper::cancelNumber($sendApi);
        
        /*
        inside of $getSms
        [{"response":"1","number":"9697479153","id":81778837,"again":0,"text":null,"extra":"",
            "karma":41.585000000000036,"pass":null,"sms":null,"balanceOnPhone":0,"service":null,
            "country":null,"CountryCode":null,"branchId":0,"callForwarding":false,"goipSlotId":0,
            "lifeSpan":586}]
            cancel hole response 1 hobe 
         */
        
        return Response::json($cancelNumber);
    }

    public function get_sms(Request $req) {

        $id = $req->id;
        $country = $req->countrycode;
        $service = $req->servicecode;

        $sendApi = [
            'metod' => 'get_sms',
            'id' => $id,
            'country' => $country,
            'service' => $service
        ]; 
        $getSms = Helper::getSms($sendApi);
        $history = Service::where('code', $service)->first();
        if($getSms[0]["response"] == 1){
            $uh = new UserHistory;
            $uh->user_id = Auth::user()->id;
            $uh->service = $history->service;
            $uh->phone_number = $req->number;
            $uh->cost = $req->cost;
            $uh->description = "Purchase a virtual number ".$req->c_code." ".$req->number.", SMS: ".$getSms[0]["sms"].", Service: ".$service->service.", ".$history->service.", API";
            $uh->save();
        }
        
        /*
        inside of $getSms
        [{"response":"2","number":null,"id":81764629,"text":null,"extra":"0",
            "karma":42.57500000000003,"pass":"","sms":null,"balanceOnPhone":0}]
            sms asle response 1 hobe and test asbe 
         */
        
        return Response::json($getSms);
    }


    public function ban(Request $req) {

        $id = $req->id;
        $service = $req->service;

        $sendApi = [
            'metod' => 'ban',
            'id' => $id,
            'service' => $service
        ]; 
        $banNumber = Helper::ban($sendApi);

        /*
        inside of $banNumber
        [{"response":"1","number":"9619078234","id":81762937,"again":0,"text":null,"extra":"",
            "karma":43.23500000000003,"pass":null,"sms":null,"balanceOnPhone":0,"service":null,
            "country":null,"CountryCode":null,"branchId":0,"callForwarding":false,"goipSlotId":0,
            "lifeSpan":487}]
         */
        return Response::json($banNumber);
    }

    public function update_balance(Request $req) {

        $id = Auth::user()->id;

        $user = User::where('id', $id)->update(['balance' => $req->balance]);

        return json_encode($req->balance);  
    }

    public function terms() {

        return view('footer.terms');
    }

    public function privacy() {

        return view('footer.privacy');
    }

    public function about() {

        return view('footer.about');
    }
}
