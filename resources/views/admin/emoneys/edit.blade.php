@extends('admin.layouts.admin')

@section('title', 'Edit "' . $emoney->user->fullname() . '"' )

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open(['route'=>['admin.emoneys.update',$emoney->id],'method' => 'put','class'=>'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) }}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount" >
                    Monto
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input value="{{$emoney->amount}}" id="amount" type="number" class="form-control col-md-7 col-xs-12 @if($errors->has('amount')) parsley-error @endif"
                           name="amount" required>
                    @if($errors->has('amount'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('amount') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary" href="{{ URL::previous() }}"> Cancelar</a>
                    <button type="submit" class="btn btn-success"> Guardar</button>
                </div>
            </div>


            {{ Form::close() }}
        </div>
    </div>


    @section('styles')
    @parent
    {{ Html::style(mix('assets/admin/css/users/edit.css')) }}
@endsection

@section('scripts')
    @parent
    {{ Html::script(mix('assets/admin/js/users/edit.js')) }}
@endsection

@endsection