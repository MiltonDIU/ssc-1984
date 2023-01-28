<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventUser;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentApiController extends Controller
{


    public function successPayment(Request $request){

        $reff_id = $request->reff_id;
        if ($reff_id){
            $payment = Payment::where('trans_id',$reff_id)->orderBy('id','desc')->first();
            if($payment->trans_id){
                $event_user = EventUser::where('user_id',$payment->user_id)->where('event_id',$payment->event_id)->first();
                $validation_result = $this->validationCheck($payment->trans_id);
                if ($validation_result['data']['status']){
                    if($validation_result['data']['status']=="VALIDATED"){
                        $payment->payment_response = $validation_result;
                        $payment->status = 1;
                        $payment->save();
                        $event_user->payment_status = '1';
                        $event_user->save();
                    }else{
                        $payment->status = 2;
                        $payment->payment_response = $validation_result;
                        $payment->save();
                        $event_user->payment_status = '2';
                        $event_user->save();
                    }
                }else{
                    $payment->status = 2;
                    $payment->payment_response = $validation_result;
                    $payment->save();
                    $event_user->payment_status = '2';
                    $event_user->save();
                }



            }
        }
    }
    public function paymentCheck(Request $request){

        $payment = Payment::where('trans_id',$request->input('trans_id'))->first();
        $validation_result = $this->paymentRecheck($payment->trans_id);
        $event_user = EventUser::where('user_id',$payment->user_id)->where('event_id',$payment->event_id)->first();

        if ($validation_result['message']=="success"){
            if($validation_result['data']['status']=="VALIDATED"){
                $payment->payment_response = $validation_result;
                $payment->status = 1;
                $payment->save();
                $event_user->payment_status = '1';
                $event_user->save();
                $message = "Valid Transaction and payment update";
            }else{
                $payment->status = 2;
                $payment->payment_response = $validation_result;
                $payment->save();
                $event_user->payment_status = '2';
                $event_user->save();
                $message = "Invalid Transaction";
            }
        }else{
            $payment->status = 2;
            $payment->payment_response = $validation_result;
            $payment->save();
            $event_user->payment_status = '2';
            $event_user->save();
            $message = "Invalid Transaction";
        }
        return redirect(route('admin.payment.listOfPayment',[$payment->event_id,$payment->event->slug]))->with("message",$message);
    }
    function validationCheck($reff_id){
        $verifyUrl = "https://api.1card.com.bd/ssc1984-bangladesh/validationserverapi";
        $crl = curl_init();
        $header = array("Accept:application/json");
        $res_data = array(
            'reff_id'=> $reff_id,
            'token'=> 'ceb263b97edc55698ab6fcf755ebcc1d'
        );
        curl_setopt($crl, CURLOPT_URL, $verifyUrl);
        curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($crl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($crl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($crl, CURLOPT_MAXREDIRS, 2);
        curl_setopt($crl, CURLOPT_POST, 1);
        curl_setopt($crl, CURLOPT_POSTFIELDS, $res_data);
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);
        // response of the POST request
        $result = curl_exec($crl);
//        dd($result);
        if ($result === FALSE) {
            die('Curl Failed: ' . curl_error($crl));
        }
        curl_close($crl);
        $api_result = json_decode($result,true);
//        dd($result);
        if($api_result['message']){
            return $api_result;
        }else{
            return false;
        }
    }
    function paymentRecheck($reff_id){
        $verifyUrl = "https://api.1card.com.bd/ssc1984-bangladesh/recheck";
        $crl = curl_init();
        $header = array("Accept:application/json");
        $res_data = array(
            'reff_id'=> $reff_id,
            'token'=> 'ceb263b97edc55698ab6fcf755ebcc1d'
        );
        curl_setopt($crl, CURLOPT_URL, $verifyUrl);
        curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($crl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($crl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($crl, CURLOPT_MAXREDIRS, 2);
        curl_setopt($crl, CURLOPT_POST, 1);
        curl_setopt($crl, CURLOPT_POSTFIELDS, $res_data);
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);
        // response of the POST request
        $result = curl_exec($crl);
//        dd($result);
        if ($result === FALSE) {
            die('Curl Failed: ' . curl_error($crl));
        }
        curl_close($crl);
        $api_result = json_decode($result,true);
//        dd($result);
        if($api_result['message']){
            return $api_result;
        }else{
            return false;
        }
    }

}
