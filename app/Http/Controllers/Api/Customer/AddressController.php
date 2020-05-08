<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\ApiAddressCreateRequest;
use App\Http\Requests\Customer\ApiRatingCreateRequest;
use App\Models\Address;
use App\Models\Rating;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $active_addresses = Address::where('user_id', Auth::user()->id)->where('active', true)->get();
        return response()->json($active_addresses);
    }

    public function store(ApiAddressCreateRequest $request)
    {
        $address = new Address();
        $address->fill($request->all());
        $address->user_id = Auth::user()->id;
        $address->save();

        return response()->json($address);
    }

    public function delete(Address $address){
        $address->active = false;
        $address->save();
        return response()->json($address);
    }

    public function update(ApiAddressCreateRequest $request, Address $address)
    {
        $address->fill($request->all());
        $address->save();

        return response()->json($address);
    }

    public function show(Address $address)
    {
        return response()->json($address);
    }
}
