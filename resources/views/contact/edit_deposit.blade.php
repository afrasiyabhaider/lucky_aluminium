@extends('layouts.app')
@section('title', "Edit Transaction")

@section('content')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css?v='.$asset_v) }}">

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Transaction
        <small>Edit transaction</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
      {!! Form::open(['url' => url('/contacts/transaction/save'), 'method' => 'POST']) !!}
      <div class="col-md-12">
        <div class="form-group">
          <strong>@lang('account.selected_account')</strong>: 
            {{$transaction->contact->name}}
            {!! Form::hidden('transaction_id', $transaction->id) !!}
          </div>
          <div class="form-group">
            {!! Form::label('amount', "Amount" .":*") !!}
            {!! Form::text('amount', $transaction->final_total, ['class' => 'form-control input_number', 'required','placeholder' => 'Amount' ]); !!}
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
      </div>
      {!! Form::close() !!}
      
    </div>
</section>

@endsection