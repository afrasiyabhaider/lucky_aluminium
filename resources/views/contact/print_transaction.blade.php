@extends('layouts.app')
@section('title', 'Transaction')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Transaction
    </h1>
</section>

<section class="content">

    <div class="box box-solid">
        <div class="box-header print_section">
            <h3 class="box-title">{{session()->get('business.name')}}</span></h3>
        </div>
        <div class="box-body">
            <table class="table table-border-center no-border table-pl-12">
                <thead>
                    <tr class="bg-gray">
                        <th colspan="2">Transaction</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>Business</b></td>
                        <td>{{ $transaction->business->name  }}</td>
                    </tr>
                    <tr>
                        <td><b>Location</b></td>
                        <td>{{ $transaction->location->name  }}</td>
                    </tr>
                    <tr>
                        <td><b>Transaction Type</b></td>
                        <td>{{ ucwords($transaction->type)  }}</td>
                    </tr>
                    <tr>
                        <td><b>Contact</b></td>
                        <td>{{ $transaction->contact->name  }}</td>
                    </tr>
                    <tr>
                        <td><b>Invoice No.</b></td>
                        <td>{{ $transaction->ref_no  }}</td>
                    </tr>
                    <tr>
                        <td><b>Payment Type</b></td>
                        <td>{{ "Cash"  }}</td>
                    </tr>
                    <tr>
                        <td><b>Amount</b></td>
                        <td>{{ number_format($transaction->final_total, 2)  }}</td>
                    </tr>
                    <tr>
                        <td><b>Transaction Date</b></td>
                        <td>{{ date('d-M-Y H:i', strtotime($transaction->transaction_date))  }}</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <button type="button" class="btn btn-primary no-print pull-right"onclick="window.print()">
          <i class="fa fa-print"></i> @lang('messages.print')</button>
        </div>
    </div>
    

</section>

@endsection