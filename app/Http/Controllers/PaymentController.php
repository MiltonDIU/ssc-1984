<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventUser;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;
class PaymentController extends Controller
{
    public function eventPayment(Request $request){

        $eventData = $request->all();
        $eventData['trans_id'] = rand(100,999).'-'."ssc84-".strtotime(now());
        $eventData['status'] = 0;
        $eventData['created_at'] = Carbon::now('Asia/Dhaka');
        $eventData['updated_at'] = Carbon::now('Asia/Dhaka');
       $payment = Payment::create($eventData);
//return $payment->id;

        $postUrl = "https://api.1card.com.bd/ssc1984-bangladesh/pay";
        $ch = curl_init();
        $header = array("Accept:application/json");
        $data = array(
            'user_id'=> $payment->user_id,
            'reff_id'=>$payment->trans_id,
            'amount'=> $payment->amount,
            'cus_name'=> auth()->user()->name??"CustomerName",
            'cus_email'=> auth()->user()->email??"CustomerEmail@gmail.com",
            'cus_address'=> auth()->user()->residence->area??"CustomerAddress",
            'cus_city'=> auth()->user()->residence->city->name??"CustomerCity",
            'cus_state'=> auth()->user()->residence->state->name??"CustomerState",
            'cus_postcode'=> "1205",
            'cus_country'=> auth()->user()->residence->country->name??"CustomerCountry",
            'cus_phone'=> auth()->user()->mobile??"01704960656",
            'currency_code'=> $payment->currency,
            'success'=> route('success-payment'),
            'redirect'=> route('payment-history')
        );
        curl_setopt($ch, CURLOPT_URL, $postUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// response of the POST request
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl Faild: ' . curl_error($ch));
        }
        curl_close($ch);
//echo json_decode($result,true);
        echo $result;
    }


    public function paymentHistory()
    {
//        $payments = Payment::where('user_id',auth()->id())->orderBy('id','desc')->get();
        $eventUsers = EventUser::where('user_id',auth()->id())->orderBy('id','desc')->get();
        return view('member.payment-status',compact('eventUsers'));
    }


    public function listOfPayment($id,$title){
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $event = Event::find($id);
        return view('admin.events.payments', compact('event'));
    }

}
