@extends('admin.layouts.admin')

@section('title')
    Tarjetas &nbsp; <a class="btn btn-primary" href="{{ route('admin.cards.create') }}"><i class="fa fa-plus-circle"></i>
        Nuevo</a>
@endsection

@section('content')
    <div class="row">

        <table class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Cuenta</th>
                <th>Cliente</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cards as $card)
                <tr>
                    <td>{{ $card->name }}</td>
                    <td>{{ $card->account_number }}</td>
                    <td>{{ $card->user->fullname() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
            {{ $cards->links() }}
        </div>
    </div>
@endsection