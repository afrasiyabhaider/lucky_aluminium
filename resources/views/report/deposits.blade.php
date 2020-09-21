@extends('layouts.app')
@section('title', __( 'report.deposits' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang( 'report.deposits' )
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="print_section"><h2>{{session()->get('business.name')}} - @lang( 'report.deposits' )</h2></div>
    
    <div class="row no-print">
         {{-- <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-addon bg-light-blue"><i class="fa fa-map-marker"></i></span>
                        <select class="form-control select2" id="">
                            @foreach($business_locations as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endcomponent
        </div> --}}
        {{-- <div class="col-md-2 col-xs-6">
            <div class="form-group pull-right">
                <div class="input-group">
                  <button type="button" class="btn btn-primary" id="profit_loss_date_filter">
                    <span>
                      <i class="fa fa-calendar"></i> {{ __('messages.filter_by_date') }}
                    </span>
                    <i class="fa fa-caret-down"></i>
                  </button>
                </div>
            </div>
        </div> --}}
    </div>
    {{-- <div class="row">
        @include('report/partials/profit_loss_details')
    </div> --}}

    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-primary'])
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="deposits_withdraws_report">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Amount</th>
                            <th>Ref No</th>
                            <th>Payment Method</th>
                            <th>Others</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $transaction)
                            <tr>
                                <td>{{ date('d-M-Y H:i', strtotime($transaction->transaction_date)) }}</td>
                                <td>{{ ucwords($transaction->contact->name) }}</td>
                                <td>{{ ucfirst($transaction->type) }}</td>
                                <td>{{ $transaction->location->name }}</td>
                                <td>{{ number_format($transaction->final_total, 2) }}</td>
                                <td>{{ $transaction->ref_no }}</td>
                                <td>{{ 'Cash' }}</td>
                                <td>{{ $transaction->additional_notes }}</td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot>
                        <tr class="bg-gray font-17 footer-total text-center">
                            <td><strong>@lang('sale.total'):</strong></td>
                            <td><span class="display_currency" id="footer_total_purchase" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_purchase_return" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_sell" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_sell_return" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_opening_bal_due" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_due" data-currency_symbol ="true"></span></td>
                        </tr>
                    </tfoot> --}}
                </table>
              <span class="no-print">{{ $data->links() }}</span> 

            </div>
            <button class="btn btn-primary pull-right no-print" onclick="window.print()"> <i class="fa fa-print"></i> Print</button>
             
            @endcomponent
        </div>
    </div>
</section>
@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection