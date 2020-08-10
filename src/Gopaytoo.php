<?php

namespace Smallworldfs\Gopaytoo;

use Smallworldfs\Gopaytoo\Libraries\MerchantApiResponse;
use Smallworldfs\Gopaytoo\Libraries\PaytooAccountType;
use Smallworldfs\Gopaytoo\Libraries\PaytooCreditCardType;
use Smallworldfs\Gopaytoo\Libraries\PaytooDocumentType;
use Smallworldfs\Gopaytoo\Libraries\PaytooPaymentRequestType;
use Smallworldfs\Gopaytoo\Libraries\PaytooRequestDocumentType;
use Smallworldfs\Gopaytoo\Libraries\PaytooRequestSearchCriterias;
use Smallworldfs\Gopaytoo\Libraries\PaytooRequestType;
use Smallworldfs\Gopaytoo\Libraries\PaytooTransactionType;

use Config;
use Log;
use SoapClient;

class Gopaytoo
{
    var $soap        ;
    var $merchant_id  = null;
    var $api_password = null;

    public function __construct()
    {
        ini_set('soap.wsdl_cache_enabled', 0);

        $options = Config::get('gopaytoo.options');
        $options['classmap'] = array(
                                    "Smallworldfs\Gopaytoo\Libraries\PaytooAccountType"            =>"PaytooAccountType", 
                                    "Smallworldfs\Gopaytoo\Libraries\PaytooCreditCardType"         =>"PaytooCreditCardType",
                                    "Smallworldfs\Gopaytoo\Libraries\MerchantApiResponse"          => "MerchantApiResponse", 
                                    "Smallworldfs\Gopaytoo\Libraries\PaytooAccountType"            => "PaytooAccountType", 
                                    "Smallworldfs\Gopaytoo\Libraries\PaytooCreditCardType"         => "PaytooCreditCardType", 
                                    "Smallworldfs\Gopaytoo\Libraries\PaytooDocumentType"           => "PaytooDocumentType", 
                                    "Smallworldfs\Gopaytoo\Libraries\PaytooPaymentRequestType"     => "PaytooPaymentRequestType", 
                                    "Smallworldfs\Gopaytoo\Libraries\PaytooRequestDocumentType"    => "PaytooRequestDocumentType", 
                                    "Smallworldfs\Gopaytoo\Libraries\PaytooRequestSearchCriterias" => "PaytooRequestSearchCriterias", 
                                    "Smallworldfs\Gopaytoo\Libraries\PaytooRequestType"            => "PaytooRequestType", 
                                    "Smallworldfs\Gopaytoo\Libraries\PaytooTransactionType"        => "PaytooTransactionType"
                                );

        $this->soap = new SoapClient(Config::get('gopaytoo.ws_url'), $options);

        $this->merchant_id= Config::get('gopaytoo.merchant_id');
        $this->api_password= Config::get('gopaytoo.api_password');
    }

    public function auth($merchant_id, $api_password, $sub_account_id = null){
        return $this->soap->auth($merchant_id, $api_password, $sub_account_id);
    }
    public function logout(){
        return $this->soap->logout();
    }

    public function AchSingleTransaction($PaytooBankAccount, $PaytooAccount, $amount, $currency, $ref_id, $description = null, $addinfo = null, $documents = null){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->AchSingleTransaction($PaytooBankAccount, $PaytooAccount, $amount, $currency, $ref_id, $description, $addinfo, $documents);

            $this->soap->logout();
            return $response;
        }
        
        return $response;

    } 

    public function ConfirmTransaction($request_id, $OTP ){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->ConfirmTransaction($request_id, $OTP);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function CreditCardPreAuth($PaytooCreditCard, $PaytooAccount, $amount, $currency, $ref_id, $description = null, $addinfo = null, $documents = null){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->CreditCardPreAuth($PaytooCreditCard, $PaytooAccount, $amount, $currency, $ref_id, $description, $addinfo, $documents);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function CreditCardRecurringTransaction($PaytooCreditCard, $PaytooAccount, $initial_amount, $amount, $currency, $periodicity, $cycles, $start_date, $ref_id, $description = null, $addinfo = null, $documents = null){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->CreditCardRecurringTransaction($PaytooCreditCard, $PaytooAccount, $initial_amount, $amount, $currency, $periodicity, $cycles, $start_date, $ref_id, $description, $addinfo, $documents);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    }

    public function CreditCardSingleTransaction($CreditCard, $Customer, $amount, $currency, $ref_id, $description = null, $addinfo = null, $documents =  null){
        // Authentification
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->CreditCardSingleTransaction ($CreditCard, $Customer, $amount, $currency, $ref_id, $description);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    }

    public function EcheckRecurringTransaction($PaytooBankAccount, $PaytooAccount, $initial_amount, $amount, $currency, $periodicity, $cycles,$start_date, $ref_id, $description = null, $addinfo = null, $documents = null){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->EcheckRecurringTransaction($PaytooBankAccount, $PaytooAccount, $initial_amount, $amount, $currency, $periodicity, $cycles,$start_date, $ref_id, $description, $addinfo, $documents);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function EcheckSingleTransaction($PaytooBankAccount, $PaytooAccount, $amount, $currency, $ref_id, $description = null, $addinfo = null, $documents = null){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->EcheckSingleTransaction($PaytooBankAccount, $PaytooAccount, $amount, $currency, $ref_id, $description, $addinfo, $documents);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function GetStatus($request_id = null, $tr_id = null){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->GetStatus($request_id, $tr_id);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function GetRequests($search_criterias = null){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->GetRequests($search_criterias);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function MicroPayment($amount, $currency, $country_or_ip = null, $ref_id, $description = null){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->MicroPayment($amount, $currency, $country_or_ip, $ref_id, $description);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function PreAuth($from,  $security_code, $amount, $currency, $ref_id, $description = null, $addinfo = null, $documents = null){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->PreAuth($from,  $security_code, $amount, $currency, $ref_id, $description, $addinfo, $documents);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    }

    public function Redeem($voucher){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->Redeem($voucher);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function Refund($request_id = null, $tr_id = null, $amount =  null, $reason = null){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->Refund($request_id, $tr_id, $amount, $reason);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    }

    public function RequestPayTooPIN($currency, $cellphone,  $security_code, $firstname = null, $lastname = null, $email = null){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->RequestPayTooPIN($currency, $cellphone,  $security_code, $firstname, $lastname, $email);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function RequestWireTransfer($PaytooAccount, $amount, $currency, $country, $ref_id, $description = null, $addinfo = null, $documents = null){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->RequestWireTransfer($PaytooAccount, $amount, $currency, $country, $ref_id, $description, $addinfo, $documents);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function Settlement($request_id, $amount = null){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->Settlement($request_id, $amount);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function ValidatePayTooPIN($cellphone, $pin){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->ValidatePayTooPIN($cellphone, $pin);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function Void($request_id){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->Void($request_id);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function WalletSingleTransaction($from, $amount, $currency, $ref_id, $description = null, $addinfo = null, $documents = null){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->WalletSingleTransaction($from, $amount, $currency, $ref_id, $description, $addinfo, $documents);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function WalletRecurringTransaction($from, $initial_amount, $amount, $currency, $periodicity, $cycles, $start_date, $ref_id, $description = null, $addinfo = null, $documents = null){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->WalletRecurringTransaction($from, $initial_amount, $amount, $currency, $periodicity, $cycles, $start_date, $ref_id, $description, $addinfo, $documents);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function IsPaytooAccount($account_id){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->IsPaytooAccount($account_id);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function AddDocuments($request_id = null, $tr_id = null, $documents){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->AddDocuments($request_id, $tr_id, $documents);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function RemoveDocument($request_id = null, $tr_id = null, $file_id){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->RemoveDocument($request_id, $tr_id, $file_id);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function CreatePaymentRequest($PaytooPaymentRequest, $PaytooAccount = null, $documents = null){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->CreatePaymentRequest($PaytooPaymentRequest, $PaytooAccount, $documents);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    } 

    public function GetPaymentRequest ($id = null, $return_docs = false, $return_requests = false){
        $response = $this->soap->auth($this->merchant_id, $this->api_password);
        if($response->status=='OK') {

            $response = $this->soap->GetPaymentRequest ($id, $return_docs, $return_requests);

            $this->soap->logout();
            return $response;
        }
        
        return $response;
    }


    /**
     * Friendly welcome
     *
     * @param$phrase Phrase to return
     *
     * @returnReturns the phrase passed in
     */
    public function echoPhrase($phrase)
    {
        return $phrase;
    }
}
