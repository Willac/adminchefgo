<div>El usuario <b>{{$order->user->fullname()}}</b> a solicitado una nueva factura, favor de enviar al correo electrónico {{$request->email}}.
Fecha de la solicitud {{$date}}</div>

<p><h3><b>Datos de facturacion del cliente</b></h3></p>

    <table>
        <thead>
            <tr>
                <th>RFC</th><th>{{$request->rfc}}</th>
            </tr>
        </thead>
        <tbody>
   
            <tr>
                <td>Nombre o razon social</td><td>{{$request->socialName}}</td>
            </tr>
            <tr>
                <td>Teléfono</td><td>{{$request->phone}}</td>
            </tr>
            <tr>
                <td>Correo electrónico</td><td>{{$request->email}}</td>
            </tr>
            <tr>
                <td>Calle</td><td>{{$request->street}}</td>
            </tr>
            <tr>
                <td>No Ext</td><td>{{$request->noExt}}</td>
            </tr>
            <tr>
                <td>No Int</td><td>{{$request->NoInt}}</td>
            </tr>
            <tr>
                <td>Colonia</td><td>{{$request->neigborgHood}}</td>
            </tr>
            <tr>
                <td>Código postal</td><td>{{$request->zipNo}}</td>
            </tr>
            <tr>
                <td>Ciudad</td><td>{{$request->city}}</td>
            </tr>
            <tr>
                <td>Estado</td><td>{{$request->state}}</td>
            </tr>
            <tr>
                <td>País</td><td>{{$request->country}}</td>
            </tr>
        </tbody>
    <table>




<p><h3><b>Detalle de la orden</b></h3></p>

<p>No. de orden #{{$order->id}}.</p>

<p>Listado de artículos<p>

<table>
    <thead>
        <tr>
            <th>Artículo</th><th>Cantidad</th><th>Total</th>
        </tr>
    </thead>
    <tbody>
            @foreach($order->orderitems as $items) 
            <tr>
                <td>{{$items->menuitem->title}}</td><td>{{$items->quantity}}</td><td style="text-align: right;">${{number_format($items->total, 2)}}</td>
            </tr>
            @endforeach
           <tr>
            <td></td><td>Sub total</td><td style="text-align: right;">${{number_format($order->total, 2)}}</td>
           </tr>
           <tr>
            <td></td><td>% taxes</td><td style="text-align: right;">${{number_format($order->taxes, 2)}}</td>
           </tr>
           <tr>
            <td></td><td>Costos de envío</td><td style="text-align: right;">${{number_format($order->delivery_fee, 2)}}</td>
           </tr>
           <tr>
            <td></td><td><b>Total<b></td><td  style="text-align: right;"><b>${{number_format($order->taxes + $order->delivery_fee+$order->total, 2)}}</b></td>
           </tr>
    </tbody>
<table>


