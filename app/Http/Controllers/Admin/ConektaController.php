<?php

namespace App\Http\Controllers\Admin;
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

    public function deleteCard(Request $request)
    {
        return $this->conekta->deleteCard($token_id);
    }

    public function subscribe($id)
    {
        return $this->conekta->subscribe($id);
    }

    public function del()
    {
        return $this->conekta->del();
    }

    public function generateReference(Request $request)
    {
        return $this->conekta->generateReference($request);
    }

    public function generatePay(Request $request)
    {
        return $this->conekta->generatePay($request);
    }

    public function addCard(Request $request)
    {
        return $this->conekta->addCard($request);
    }

    public function cards($id)
    {
        return $this->conekta->cards($id);
    }

    public function createClient($id)
    {
        return $this->conekta->createClient($id);
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
