<div>La orden tuvo que ser cancelada y el monto de la misma ha sido  transferido a la membresia del cliente.

Fecha de cancelacion {{$date}}</div>


<p><h3><b>Detalle de la orden</b></h3></p>

<p>No. de orden #{{$order->id}}.</p>


<table>
    <thead>
        <tr>
        <td></td><td><b>Total<b></td><td  style="text-align: right;"><b>${{number_format($order->taxes + $order->delivery_fee+$order->total, 2)}}</b></td>
        </tr>
    </thead>
<table>


