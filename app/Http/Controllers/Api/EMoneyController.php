<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiStoreUpdateRequest;
use App\Models\EMoney;
use Illuminate\Http\Request;

class EMoneyController extends Controller
{
    /**
     * Display the store of current logged in user
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(EMoney::all());
    }

    public function show(EMoney $emoney)
    {
        return response()->json(EMoney::find($emoney));
    }


    public function getAmount(){
        return Emoney::getAmount();        
    }
    
    public function updateAmount(Request $request){
        return  Emoney::updateAmount($request);        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $user->fill($request->only(['fcm_registration_id']));
        $user->save();

        return response()->json($user);
    }
}
