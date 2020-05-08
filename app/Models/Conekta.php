<?php

namespace App\Models;
use App\Models\Auth\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Models\EMoney;
require_once("../vendor/conekta/conekta-php/lib/Conekta.php");//Librería necesaria


class Conekta extends Model
{
    const CURRENCY = 'MXN'; 
    const CONCEPT = 'Pago Orden/Tarjeta';
    const ERROR_DATA = "No se encontraron datos";
    const OXXO = "oxxo_recurrent";

    const VIP = 465;
    const EXTRA = 60;

    private function getItemDefault($price)
    {   
        return array(
            array(
              'name' => self::CONCEPT,
              'unit_price' => (int) $price,
              'quantity' => 1
            )
        );
    }

    

    private function generateOrder($request,$conektaId)
    {
        try{
            return ['payload'=>\Conekta\Order::create(
              array(
                "line_items" => $this->getItemDefault($request->price), //line_items
                "shipping_lines" => array(
                  array(
                    "amount" => 0,
                     "carrier" => "FEDEX"
                  )
                ), //shipping_lines - physical goods only
                "currency" => "MXN",
                "customer_info" => array(
                  "customer_id" => $conektaId
                ), //customer_info
                "shipping_contact" => array(
                  "address" => array(
                    "street1" => "Calle 123, int 2",
                    "postal_code" => "06100",
                    "country" => "MX"
                  )//address
                ), //shipping_contact - required only for physical goods
               //"metadata" => array("reference" => "12987324097", "more_info" => "lalalalala"),
                "charges" => array(
                    array(
                        "payment_method" => array(
                                "token_id"=>$request->token_id,
                                "type" => "default"
                        ) //payment_method - use customer's default - a card
                          //to charge a card, different from the default,
                          //you can indicate the card's source_id as shown in the Retry Card Section
                    ) //first charge
                ) //charges
              )//order
                        ),'success'=>true];
          } catch (\Conekta\ProcessingError $error){
            return ['success'=>false,'payload'=>$error->getMessage()];
          } catch (\Conekta\ParameterValidationError $error){
            return ['success'=>false,'payload'=>$error->getMessage()];
          } catch (\Conekta\Handler $error){
            return ['success'=>false,'payload'=>$error->getMessage()];
          }
    }

    public function __construct()
    {
        //Hace la conexión al API Rest de CONEKTA
        \Conekta\Conekta::setApiKey(env('CONEKTA', false));
    }    

    public function associationUser($user)
    {   
        $id = $user->id;
        $eMoney = new EMoney();
        //'amount', 'user_id', 'active','voucher'
        $eMoney->amount = 0;
        $eMoney->user_id = $id;
        $eMoney->save();
        $this->createClient($id);
    }


    public function showClient($id)
    {
        $user = User::find($id);
        if($user){
            try{
                return $this->responseJSON($this->findUser($user->conekta_id));
            } catch (\Conekta\Handler $error) {
                return $this->responseJSON($error->getMessage(),false);
            }
        }else
            return $this->errorDefault(self::ERROR_DATA);
    }


    private function findUser($conektaId)
    {
        return \Conekta\Customer::find($conektaId);
    }

    private function errorDefault($payload)
    {
        return $this->responseJSON($payload,false);
    }
    

    public function createClient($id)
    {
       return $this->registerClient([User::find($id)]);
    }

    public function deleteAll()
    {
       return $this->deleteAllClient();
    }

    

    public function addCard($request)
    {        
        try {            
            $user = Auth::user();
            if($user){
                $customer = $this->findUser($user->conekta_id);
                $result = $customer->createPaymentSource(array(
                    'token_id' => $request->token_id,
                    'type'     => 'card'
                  ));
                return $this->responseJSON($result);
            }else
                return $this->errorDefault(self::ERROR_DATA);
        } catch (\Conekta\Handler $error) {
            return $this->responseJSON([],false);
        } 
    }

    public function getPaymentWebHook($request)
    {
        $body = @file_get_contents('php://input');
        $data = json_decode($body);
        http_response_code(200); // Return 200 OK

        if ($data->type == 'order.paid'){
        $msg = "Tu pago ha sido comprobado.";
        }   
    }

    public function generateReference()
    {
        try { 
            $user =  Auth::user();
            if($user){
                $customer = $this->findUser($user->conekta_id);
                $result = "El recurso no se encuentra disponible";
                return $this->responseJSON($this->hasRecurrent($customer));
            }else
                return $this->errorDefault(self::ERROR_DATA);
        } catch (\Conekta\Handler $error) {
            return $this->responseJSON($error,false);
        } 
    }

    private function getRecurrent($customer)
    {
        $result = [];
        foreach($customer->payment_sources as $index=>$payload_source){
                    
            if($payload_source->type==self::OXXO){
                   $result = [
                    'reference'=>$payload_source->reference,
                    'barcode_url'=>$payload_source->barcode_url,
                   ];
            }
        }
        return  $result;
    }

    private function hasRecurrent($customer)
    {
        $hasOxxo = false;
        $result = [];
        foreach($customer->payment_sources as $index=>$payload_source){
                    
            if($payload_source->type==self::OXXO){
                   $result = [
                    'reference'=>$payload_source->reference,
                    'barcode_url'=>$payload_source->barcode_url,
                   ];
                   $hasOxxo =true;
            }
        }
        if(!$hasOxxo){
            $result = $customer->createOfflineRecurrentReference(
                array(
                    'type' => 'oxxo_recurrent'
                    )
            );
            $result = $this->getRecurrent($customer);
        }

        return $result;
    }

    public function deleteCard($token_id)
    {
        try { 
            $user =  Auth::user();
            if($user){
                $customer = $this->findUser($user->conekta_id);
                $result = "El recurso no se encuentra disponible";
                foreach($customer->payment_sources as $index=>$payload_source){
                    
                    if($customer->payment_sources[$index]->id==$token_id){
                        $result = $customer->payment_sources[$index]->delete();   
                    }
                }
                return $this->responseJSON($result);
            }else
                return $this->errorDefault(self::ERROR_DATA);
        } catch (\Conekta\Handler $error) {
        return $this->responseJSON($error,false);
        } 
    }

    public function getOrder($id,$user)
    {
        $this->increaseAmount($user->id);

        return \Conekta\Order::find($id);
    }

    private function increaseAmount($id)
    {
        //Incrementa el total del monto
        $eMoney = EMoney::where('user_id', $id)->first();
        $eMoney->amount = $eMoney->amount + (self::VIP+self::EXTRA);
        $eMoney->save();
    }

    public function generatePay($request)
    {
        try { 
            $user =  Auth::user();
            //$user = User::find($request->id);
            if($user){
                $response = $this->generateOrder($request,$user->conekta_id);
                return $this->responseJSON($response['payload'],$response['success']);
            }else
                return $this->errorDefault(self::ERROR_DATA);
        } catch (\Conekta\Handler $error) {
            return $this->responseJSON($error,false);
        } 
    }
    
    public function cards()
    {
        try {
                 $user =  Auth::user();
                if($user){
                    $client = $this->findUser($user->conekta_id);
                    $result = [];
                    foreach($client->payment_sources as $payment){

                        if($payment->type=="card"){
                        $result[] = [
                            'last4'=>$payment['last4'],
                            'brand'=>$payment['brand'],
                            'id'=>$payment['id'],
                            'name'=>$payment['name'],
                            
                        ];
                        }
                    }
                    return $this->responseJSON($result);
                }else
                    return $this->errorDefault(self::ERROR_DATA);
        } catch (\Conekta\Handler $error) {
            return $this->responseJSON([],false);
        } 
    }

    public function registerAll()
    {
       return $this->registerClient(User::all());
    }

    private function deleteAllClient()
    {
        try {
            foreach(User::all() as $user)
            {
                $client = $this->findUser($user->conekta_id);
                $client->delete();
            }
            return $this->responseJSON($users);
        } catch (\Conekta\Handler $error) {
            return $this->responseJSON($error->getMessage(),false);
        } 
    }

    public function del()
    {
        try {
            foreach(\Conekta\Customer::all() as $customer)
            {
                $response[] = $customer->delete();
            }
            return $this->responseJSON($response);
        } catch (\Conekta\Handler $error) {
            return $this->responseJSON($error->getMessage(),false);
        }
    }

    private function registerClient($users)
    {
        try {
            foreach($users as $user)
            {
                $response = \Conekta\Customer::create(
                    array(
                        'name'=>$user->fullname(),
                        'phone'=>$user->mobile_number,
                        'email'=>$user->email,
                    ));
                $user->conekta_id = $response->id;
                $user->save();
            }
            return $this->responseJSON($users);
        } catch (\Conekta\Handler $error) {
            return $this->responseJSON($error->getMessage(),false);
        }
    }

    private function responseJSON($payload=[],$success=true)
    {
        return response()->json([
            'success' => $success,
            'payload' => $payload,
            ]);
    }
}
