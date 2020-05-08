<?php

namespace App\Http\Controllers\Api\Delivery;

use App\Events\Ordered;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiOrderUpdateRequest;
use App\Http\Requests\Customer\ApiOrderCreateRequest;
use App\Models\DeliveryProfile;
use App\Models\Earning;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\PushNotificationHelper;


class OrderController extends Controller
{
    /**
     * Get orders by store_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAvailableOrder(Request $request)
    {
        $order = Order::where('delivery_profile_id', Auth::user()->deliveryProfile->id)
            ->whereIn('delivery_status', ['pending', 'allotted', 'started'])
            ->whereNotIn('status', ['rejected'])
            ->first();
        if($order) {
            return response()->json($order);
        }
        return response()->json(['message' => 'No Ordered assigned'], 404);
    }

    public function updateDeliveryStatus(Order $order, Request $request) {
        if(!in_array($request->delivery_status, ['pending', 'allotted', 'started', 'cancelled', 'complete'])) {
            return response()->json(['error' => 'Invalid delivery status'], 400);
        }
        $order->delivery_status = $request->delivery_status;

        $order->save();

        event(new Ordered($order));

        return response()->json($order);
    }
    
    public function updateAcceptedStatus(Order $order, Request $request) {
        
        if(in_array($request->is_accepted, ["true"])){
            $order->is_accepted = true;
            $order->assigned_at = DB::raw('CURRENT_TIMESTAMP');
            $order->save();
        }else{
            if (!($order->is_accepted)){
                $order->is_accepted = false;
                $order->save();
                $order->ReAllotDeliveryPerson($order);
            }
        }

        return response()->json($order);
    }
}
