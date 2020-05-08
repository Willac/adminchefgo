<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Auth\User\User;
use App\Models\Conekta;
use Illuminate\Http\Request;
use Log;
use App\Models\EMoney;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;
class WebHookController extends Controller
{
    public $conekta;
    public function __construct()
    {
       $this->conekta = new Conekta();
    } 
    public function getPaymentWebHook(Request $request)
    {
        if($request->input('type')=='order.pay'){
            $data = $request->input('data');
            if($data){
                $user = User::find()->where(['conekta_id'=>$data['object']['customer_id']]);
                if($user){
                    $order = $this->conekta->getOrder($data['object']['order_id'],$user);
                    Mail::to($user->email)->send(new OrderPlaced($order));
                }
            }
        }
        return response()->json([
            'success' => false,
            'payload' => $request,
            ]);
    }
}