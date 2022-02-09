<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Victorybiz\LaravelCryptoPaymentGateway\LaravelCryptoPaymentGateway;

class PaymentController extends Controller
{

    public function index() {

        return view('payment.index');
    }

    /**
     * Cryptobox callback.
     */
    public function callback(Request $request)
    {   
      return LaravelCryptoPaymentGateway::callback();
    }

    public static function ipn($cryptoPaymentModel, $payment_details, $box_status)
    {            
        if ($cryptoPaymentModel) {  
            /*
            // ADD YOUR CODE HERE
            // ------------------
            // For example, you have a model `UserOrder`, you can create new Bitcoin payment record to this model
            $userOrder = UserOrder::where('payment_id', $cryptoPaymentModel->paymentID)->first();
            if (!$userOrder) 
            {
                UserOrder::create([
                    'user_id'    => $payment_details["user"],
                    'amountusd'  => floatval($payment_details["amountusd"]),
                ]);
            }
            // ------------------

            // Received second IPN notification (optional) - Bitcoin payment confirmed (6+ transaction confirmations)
            if ($userOrder && $box_status == "cryptobox_updated")
            {
                $userOrder->txconfirmed = $payment_details["confirmed"];
                $userOrder->save();
            }
            // ------------------
            */

            // Onetime action when payment confirmed (6+ transaction confirmations)
            if (!$cryptoPaymentModel->processed && $payment_details["confirmed"])
            {
                // Add your custom logic here to give value to the user.
        
                // ------------------
                // set the status of the payment to processed
                // $cryptoPaymentModel->setStatusAsProcessed();

                // ------------------
                // Add logic to send notification of confirmed/processed payment to the user if any

                $user = $payment_details["user"];
                $amount =  floatval($payment_details["amountusd"]);

                $us = User::find($user);
                $bal = $amount + $us->balance;
                $us->balance = $bal;
                $us->save();

                $uh = new UserHistory;
                $uh->user_id = Auth::user()->id;
                $uh->cost = $amount;
                $uh->description = "Paid by Bitcoin";
                $uh->save();
            
        }
        return true;
        }
    }
    public function create() {

        return view('payment.create');
    }

    public function coinbase() {

        return view('payment.coinbase');
    }
}