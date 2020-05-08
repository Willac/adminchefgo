<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Auth\User\User;
use App\Models\Conekta;
use Illuminate\Http\Request;
class ConektaController extends Controller
{
    public $conekta;
    public function __construct()
    {
       $this->conekta = new Conekta();
    } 

    public function subscribe($id)
    {
        return $this->conekta->subscribe($id);
    }

    public function addCard(Request $request)
    {
        return $this->conekta->addCard($request);
    }

    public function cards()
    {
        return $this->conekta->cards();
    }

    public function createClient($id)
    {
        return $this->conekta->createClient($id);
    }

    


    public function generatePay(Request $request)
    {
        return $this->conekta->generatePay($request);
    }

    public function generateReference()
    {
        return $this->conekta->generateReference();
    }

    public function deleteCard($token_id)
    {
        return $this->conekta->deleteCard($token_id);
    }


    public function showClient($id)
    {
        return $this->conekta->showClient($id);
    }

    public function registerAll()
    {
        return $this->conekta->registerAll();
    }

    public function deleteAll()
    {
        return $this->conekta->deleteAll();
    }
}
