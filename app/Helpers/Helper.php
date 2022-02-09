<?php

namespace App\Helpers;
use App\Models\ApiOperation;
use Illuminate\Support\Facades\Http;

class Helper 
    {
        
        public static function apiData ($sendApi)
        {   
            $receiveData = [];
            $selectedApi = ApiOperation::latest()->first('api_value');

            $data= HTTP::GET('http://smspva.com/priemnik.php?metod='.$sendApi['metod'].'&country='.$sendApi['country'].'&service='.$sendApi['service'].'&apikey='.$selectedApi['api_value'].'');
            $receiveData[] = $data->json();
            return $receiveData;
        }

        public static function getNumber ($sendApi)
        {
            
            $receiveData = [];
            $selectedApi = ApiOperation::latest()->first('api_value');
            $data = HTTP::GET('http://smspva.com/priemnik.php?metod='.$sendApi['metod'].'&country='.$sendApi['country'].'&service='.$sendApi['service'].'&apikey='.$selectedApi['api_value'].'');
            $receiveData[] = $data->json();

            return $receiveData;
        }

        public static function ban ($sendApi)
        {   
            $receiveData = [];
            $selectedApi = ApiOperation::latest()->first('api_value');
            $data = HTTP::GET('http://smspva.com/priemnik.php?metod='.$sendApi['metod'].'&service='.$sendApi['service'].'&apikey='.$selectedApi['api_value'].'&id='.$sendApi['id'].'');
            $receiveData[] = $data->json();

            return $receiveData;
        }

        public static function getSms ($sendApi)
        {   
            $receiveData = [];
            $selectedApi = ApiOperation::latest()->first('api_value');
            $data = HTTP::GET('http://smspva.com/priemnik.php?metod='.$sendApi['metod'].'&country='.$sendApi['country'].'&service='.$sendApi['service'].'&id='.$sendApi['id'].'&apikey='.$selectedApi['api_value'].'');
            $receiveData[] = $data->json();

            return $receiveData;
        }

        public static function cancelNumber ($sendApi)
        {   
            $receiveData = [];
            $selectedApi = ApiOperation::latest()->first('api_value');
            $data = HTTP::GET('http://smspva.com/priemnik.php?metod='.$sendApi['metod'].'&country='.$sendApi['country'].'&service='.$sendApi['service'].'&id='.$sendApi['id'].'&apikey='.$selectedApi['api_value'].'');
            $receiveData[] = $data->json();

            return $receiveData;
        }

        public static function getCountries ()
        {
            $receiveData = [];
            $data = HTTP::GET('https://smspva.com/api/rent.php?method=getcountries');
            $receiveData[] = $data->json();

            return $receiveData;
        }

        public static function getServices ($country)
        {
            $receiveData = [];
            $data = HTTP::GET('https://smspva.com/api/rent.php?method=getdata&country='.$country.'');
            $receiveData[] = $data->json();
            return $receiveData;
        }

        public static function rentNumber ($sendApi)
        {
            $receiveData = [];
            $selectedApi = ApiOperation::latest()->first('api_value');
            $data = HTTP::GET('https://smspva.com/api/rent.php?method='.$sendApi['method'].'&apikey='.$selectedApi['api_value'].'&dtype='.$sendApi['dtype'].'&dcount='.$sendApi['dcount'].'&country='.$sendApi['country'].'&service='.$sendApi['service'].'');
            $receiveData[] = $data->json();
            return $receiveData;
        }

        public static function rentNumberOrders ()
        {
            $receiveData = [];
            $selectedApi = ApiOperation::latest()->first('api_value');
            $data = HTTP::GET('https://smspva.com/api/rent.php?method=orders&apikey='.$selectedApi['api_value'].'');
            $receiveData[] = $data->json();
            return $receiveData;
        }

        public static function rentNumberSms ($id)
        {
            $receiveData = [];
            $selectedApi = ApiOperation::latest()->first('api_value');
            $data = HTTP::GET('https://smspva.com/api/rent.php?method=sms&id='.$id.'&apikey='.$selectedApi['api_value'].'');
            $receiveData[] = $data->json();
            return $receiveData;
        }

        public static function prolongation ($sendApi)
        {
            $receiveData = [];
            $selectedApi = ApiOperation::latest()->first('api_value');
            $data = HTTP::GET('https://smspva.com/api/rent.php?id='.$sendApi['id'].'&dcount='.$sendApi['dcount'].'&dtype='.$sendApi['dtype'].'&method='.$sendApi['method'].'&apikey='.$selectedApi['api_value'].'');
            $receiveData[] = $data->json();
            return $receiveData;
        }

        public static function activating ($id)
        {
            $receiveData = [];
            $selectedApi = ApiOperation::latest()->first('api_value');
            $data = HTTP::GET('https://smspva.com/api/rent.php?method=activate&id='.$id.'&apikey='.$selectedApi['api_value'].'');
            $receiveData[] = $data->json();
            return $receiveData;
        }

        public static function removing ($id)
        {   
            $receiveData = [];
            $selectedApi = ApiOperation::latest()->first('api_value');
            $data = HTTP::GET('https://smspva.com/api/rent.php?method=delete&id='.$id.'&apikey='.$selectedApi['api_value'].'');
            $receiveData[] = $data->json();
            return $receiveData;
        }
    }