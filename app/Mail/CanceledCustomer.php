<?php

namespace App\Mail;

use App\Models\Auth\User\User;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class CanceledCustomer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    public $order;

    /**
     * Create a new message instance.
     *
     * @param Authenticatable $user
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        #return $this->subject('Welcome to ' . config('app.name'))->markdown('emails.auth.welcome');

        return $this->subject("Orden cancelada ".($this->order->id))->view('emails.orders.canceled_customer')->with([
            'order' => $this->order,
            'date' => Carbon::now()
          ]);
    }
}
