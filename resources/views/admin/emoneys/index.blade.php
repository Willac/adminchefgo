@extends('admin.layouts.admin')

@section('title')
    Monedero electrónico &nbsp;
    <a class="btn btn-primary" href="{{ route('admin.emoneys.create') }}">
        <i class="fa fa-plus-circle"></i>
    Nuevo</a>
@endsection

@section('content')
    <div class="row">

        <table class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>Cliente</th>
                <th>Monto</th>
                <th>Voucher</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($emoneys as $emoney)
                <tr>
                    <td>{{ $emoney->user->fullname() }}</td>
                    <td>$ {{ $emoney->amount/100 }}</td>
                    <td>{{ $emoney->voucher }}</td>
                    <td>@if($emoney->active)
                        <i class='fa fa-check'></i>
                        @else
                        <i class='fa fa-times'>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-xs btn-success" href="{{ route('admin.emoneys.edit', [$emoney->id]) }}" data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <!-- <a class="btn btn-xs btn-primary" href="{{ route('admin.emoneys.show', [$emoney->id]) }}" data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-eye"></i>
                        </a>-->
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
            {{ $emoneys->links() }}
        </div>
    </div>
@endsection