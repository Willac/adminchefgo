<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\ApiRatingCreateRequest;
use App\Models\DeliveryRating;
use App\Models\DeliveryProfile;
use Illuminate\Support\Facades\Auth;

class DeliveryRatingController extends Controller
{
    public function index(DeliveryProfile $delivery_profile)
    {
        return response()->json(DeliveryRating::where('delivery_profile_id', $delivery_profile->id)->paginate(config('constants.paginate_per_page')));
    }

    public function store(ApiRatingCreateRequest $request, DeliveryProfile $delivery_profile)
    {
        $rating = DeliveryRating::where('order_id', $request->order_id)->count();

        if ($rating === 0){
            $rating = new DeliveryRating();
            $rating->fill($request->all());
            $rating->delivery_profile_id = $delivery_profile->id;
            $rating->user_id = Auth::user()->id;
            $rating->save();
            //return response()->json($rating);
        }
        
        return response()->json($rating);
        
    }

    public function show()
    {
        $ratings = DeliveryRating::where('user_id', Auth::user()->id)->paginate(config('constants.paginate_per_page'));
        return response()->json($ratings);
    }
}
