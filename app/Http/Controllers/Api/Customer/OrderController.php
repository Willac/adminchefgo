<?php

namespace App\Http\Controllers\Api\Customer;

use App\Events\Ordered;
use App\Exceptions\CouponException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\ApiOrderCreateRequest;
use App\Models\Coupon;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{

    /**
     * Get orders by user_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $orders = Order::where('user_id', Auth::user()->id);
        if($request->status) {
            $orders = $orders->where('status', $request->status);
        }
        return response()->json($orders->orderBy('created_at', 'desc')->paginate(config('constants.paginate_per_page')));
    }

    /**
     * @param ApiOrderCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function store(ApiOrderCreateRequest $request)
    {
        $order = new Order();
        $orderItems = [];
        $settings = settings_as_dictionary();
        $subtotal = 0;
        $coupon = null;

        // check coupon validity once again
        /*  } catch (CouponException $e) {
                throw ValidationException::withMessages([
                    'coupon' => $e->getMessage()
                ]);
            } catch (Exception $exception) {
                throw ValidationException::withMessages([
                    'coupon' => 'Invalid coupon'
                ]);
            }
        }*/

        // calculate total price for each item and subtotal of complete order
        $items = $request['items'];
        foreach ($items as $item) {
            $menuItem = MenuItem::find($item['menu_item_id']);
            $itemTotal = $item['quantity'] * $menuItem->price;

            $orderItem = new OrderItem();
            $orderItem->menu_item_id = $item['menu_item_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->total = $itemTotal;

            array_push($orderItems, $orderItem);

            $subtotal += $itemTotal;
        }

        // set total, taxes, delivery fee for an order
        $requestFields = $request->all();
        $requestFields['delivery_fee'] = $settings['delivery_fee'];
        $requestFields['taxes'] = $settings['tax_in_percent'];
        $requestFields['subtotal'] = $subtotal;
        $tax = ($subtotal * $settings['tax_in_percent']) / 100;

        // apply coupon
        $requestFields['discount'] = 0; // reset discount to 0, since client may already have set this field
        if($coupon !== null) {
            $discount = 0;
            if($coupon->type == 'fixed') {
                $discount = $coupon->reward;
            }

            if($coupon->type == 'percent') {
                $discount = ($subtotal * $coupon->reward) / 100;
            }

            $requestFields['discount'] = $discount;

            $coupon->users()->attach(Auth::user()->id, [
                'used_at' => Carbon::now(),
            ]);
        }

        $requestFields['total'] = ($subtotal + $tax) - $requestFields['discount'];

        $order->fill($requestFields);
        $order->user_id = Auth::user()->id;
        $order->save();

        // save ordered menu items
        foreach ($orderItems as $orderItem) {
            $orderItem->order_id = $order->id;
            $orderItem->save();
        }

        event(new Ordered(Order::find($order->id)));

        return response()->json(Order::find($order->id));
    }


    
}
