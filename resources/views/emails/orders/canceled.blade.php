<div>La orden tuvo que ser cancelada por la cocina el costo de la misma ha sido transferido al monto de tu membresia.

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


