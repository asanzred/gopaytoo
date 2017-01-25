<?php

namespace Asanzred\Gopaytoo\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use Log;
use Paytoo;
use Config;
use SoapClient;
use Asanzred\Gopaytoo\Libraries\MerchantApiResponse;
use Asanzred\Gopaytoo\Libraries\PaytooAccountType;
use Asanzred\Gopaytoo\Libraries\PaytooCreditCardType;
use Asanzred\Gopaytoo\Libraries\PaytooDocumentType;
use Asanzred\Gopaytoo\Libraries\PaytooPaymentRequestType;
use Asanzred\Gopaytoo\Libraries\PaytooRequestDocumentType;
use Asanzred\Gopaytoo\Libraries\PaytooRequestSearchCriterias;
use Asanzred\Gopaytoo\Libraries\PaytooRequestType;
use Asanzred\Gopaytoo\Libraries\PaytooTransactionType;


/********************************************

THIS CONTROLLER IS ONLY FOR FLOW TESTING 
AND TUTORIAL PURPOSES.

FEEL FREE TO MOVE CODE TO YOUR OWN CONTROLLER
AND ROUTES TO MAKE YOUR SPECIFIC STUFF.

*********************************************/

class PaytooController extends Controller
{
    public function test()
    {
        $a = new PaytooAccountType();
        $b = new PaytooCreditCardType();

        //ini_set('soap.wsdl_cache_enabled', 0);


        $CreditCard= new PaytooCreditCardType ();
        $CreditCard->cc_type = "VISA";
        // mandatory
        $CreditCard->cc_holder_name = "DEMO USER";
        // mandatory
        $CreditCard->cc_number = "4444333322221111";
        // mandatory
        $CreditCard->cc_cvv = "123";
        // mandatory
        $CreditCard->cc_month = "12";
        // mandatory
        $CreditCard->cc_year = "14";
        // mandatory
        $Customer= new PaytooAccountType ();
        $Customer->email = "demo@paytoo.com ";
        // mandatory
        $Customer->firstname = "Demo";
        // mandatory
        $Customer->lastname = "User";
        // mandatory
        $Customer->address = "200 SW 1st Avenue";
        $Customer->city = "Fort Lauderdale";
        $Customer->zipcode = "33301";
        $Customer->state = "FL";
        $Customer->country = "US";
        $amount= 16.00;
        // mandatory
        $currency= 'USD';
        // mandatory
        echo "Processing Credit Card Sale<br>";
        $ref_id= rand(1000, 9999);
        // mandatory
        $description= "Order #".$ref_id." with Paytoo Merchant";
        $addinfo= "";

        

        $response = Paytoo::CreditCardSingleTransaction($CreditCard, $Customer, $amount, $currency, $ref_id, $description);

        if($response && $response->status == 'OK') {

            \Log::error("Transaction has been processed");

            \Log::error("Request ID: ". $response->request_id);

            \Log::error("Tr. ID: ". $response->tr_id);

            return print_r($response,true);

        }else{
            \Log::error($response->status . " -". $response->msg);
        }
        
    }
}