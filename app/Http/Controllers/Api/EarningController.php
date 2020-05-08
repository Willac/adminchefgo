<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\ApiRatingCreateRequest;
use App\Models\Earning;
use App\Models\Rating;
use App\Models\Setting;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class EarningController extends Controller
{
    public function index()
    {
        $lastEarningDate = null;
        $earnings = Earning::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(config('constants.paginate_per_page'));
        $totalEarning = Earning::where('user_id', Auth::user()->id)->where('paid', false)->sum('amount');
        if (Earning::where('user_id', Auth::user()->id)->exists()) {
            $lastEarningDate = Earning::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->first()->created_at->toDateString();
        }

        return response()->json(
            [
                'total_earnings' => $totalEarning,
                'earnings' => $earnings,
                'last_earning_date' => $lastEarningDate,
            ]
        );
    }

    /**
     * Display the store of current logged in user
     *
     * @param Earning $earning
     * @return \Illuminate\Http\Response
     */
    public function show(Earning $earning)
    {
        return response()->json($earning);
    }
}
