@extends('admin.layouts.admin')

@section('amount', 'Create' )

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open(['route'=>['admin.emoneys.store'],'method' => 'post','class'=>'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) }}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount" >
                    Monto
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="amount" type="number" class="form-control col-md-7 col-xs-12 @if($errors->has('amount')) parsley-error @endif"
                           name="amount" required>
                    <input type="hidden" id="active" name="active" value="1"/>
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="voucher" >
                    Voucher
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="voucher" type="number" class="form-control col-md-7 col-xs-12 @if($errors->has('amount')) parsley-error @endif"
                           name="voucher" >
                    <input type="hidden" id="active" name="active" value="1"/>
                    @if($errors->has('voucher'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('voucher') as $error)
                                <li class="parsley-required">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_id" >
                    Cliente
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select required id="user_id" name="user_id" class="select2" style="width: 100%" autocomplete="off" >
                        <option value="">Select</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->fullname() }}</option>
                        @endforeach
                    </select>
                    
                    @if($errors->has('user_id'))
                        <ul class="parsley-errors-list filled">
                            @foreach($errors->get('user_id') as $error)
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
