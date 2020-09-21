<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessLocation;
use App\PaymentVoucher;
use App\PaymentVoucherData;
use App\Utils\BusinessUtil;
use App\Utils\CashRegisterUtil;
use App\Utils\ContactUtil;
use App\Utils\ModuleUtil;
use App\Utils\NotificationUtil;
use App\Utils\ProductUtil;
use App\Utils\TransactionUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PaymentVoucherController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $contactUtil;
    protected $productUtil;
    protected $businessUtil;
    protected $transactionUtil;
    protected $cashRegisterUtil;
    protected $moduleUtil;
    protected $notificationUtil;

    /**
     * Constructor
     *
     * @param ProductUtils $product
     * @return void
     */
    public function __construct(
        ContactUtil $contactUtil,
        ProductUtil $productUtil,
        BusinessUtil $businessUtil,
        TransactionUtil $transactionUtil,
        CashRegisterUtil $cashRegisterUtil,
        ModuleUtil $moduleUtil,
        NotificationUtil $notificationUtil
    ) {
        $this->contactUtil = $contactUtil;
        $this->productUtil = $productUtil;
        $this->businessUtil = $businessUtil;
        $this->transactionUtil = $transactionUtil;
        $this->cashRegisterUtil = $cashRegisterUtil;
        $this->moduleUtil = $moduleUtil;
        $this->notificationUtil = $notificationUtil;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = PaymentVoucher::orderBy('created_at', 'DESC')->get();
            $datatable = DataTables::of($query)
                ->addColumn('action', function ($row) {
                    $html = '<div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle btn-xs" 
                                data-toggle="dropdown" aria-expanded="false">' .
                        __("messages.actions") .
                        '<span class="caret"></span><span class="sr-only">Toggle Dropdown
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">';
                            // data-href="' . route('voucher.printInvoice', [$row->id]) . '"
                            // class="print-invoice"
                    $html .= '<li><a href="#"  id="'.$row->id.'" onclick="printThis(this);"><i class="fa fa-print" aria-hidden="true"></i> ' . __("messages.print") . '</a></li>';

                    $html .= '</ul></div>';

                    return $html;
                })
                ->editColumn('user_id', function ($row) {
                    return $row->user()->first()['first_name'] . ' ' . $row->user()->first()['last_name'];
                })
                ->editColumn('total_amount', function ($row) {
                    $business_id = request()->session()->get('user.business_id');

                    $business_details = $this->businessUtil->getDetails($business_id);
                    return '<span class="display_currency" data-currency_symbol="true">'.number_format($row->total_amount,2,$business_details['decimal_separator'],$business_details['thousand_separator']).'</span>' . ' ' . $business_details['currency_symbol'];
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('d-M-Y H:i A');
                })
                ->rawColumns(['total_amount','action']);
            return $datatable->make('true');
        }

        return view('payment_voucher.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment_voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title.*' => 'required',
            'amount.*' => 'required',
            'ac_number'=> 'required',
            'payee_name'=> 'required',
        ]);
        // dd($request->input());
        try {
            DB::beginTransaction();
            $total_amount = 0.00;
            $title = $request->input('title');
            $amount = $request->input('amount');

            $voucher = new PaymentVoucher();
            $voucher->user_id = Auth::id();
            $voucher->voucher_number = rand(1256, 11226699);
            $voucher->no_of_items = count($title);
            $voucher->payee_name = $request->input('payee_name');
            $voucher->ac_no = $request->input('ac_number');
            $voucher->checked_by = $request->input('checked_by');
            $voucher->save();

            for ($i = 0; $i < count($title); $i++) {
                $voucher_data = new PaymentVoucherData();
                $voucher_data->title = $title[$i];
                $voucher_data->payment_voucher_id = $voucher->id;
                $voucher_data->amount = $amount[$i];
                $voucher_data->save();

                $total_amount += $amount[$i];
            }
            $voucher->total_amount = $total_amount;
            $voucher->save();

            $receipt = $this->receiptContent($voucher);

            $output = [
                'success' => 1,
                'msg' => 'Voucher Added Successfully',
                'receipt' => $receipt
            ];

            DB::commit();

            return ['status' => $output];

            // return redirect('payment_voucher/create')->with('status', $output);
            // return redirect()
            //         ->action('PaymentVoucherController@create')
            //         ->with('status', $output);

        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex->getMessage() . ' in File: ' . $ex->getFile() . ' on Line: ' . $ex->getLine());
        }
    }

    /**
     * Returns the content for the receipt
     *
     */
    private function receiptContent($voucher)
    {
        $output = [
            'is_enabled' => false,
            'print_type' => 'browser',
            'html_content' => null,
            'printer_config' => [],
            'data' => []
        ];

        $business_id = request()->session()->get('user.business_id');

        $business_details = $this->businessUtil->getDetails($business_id);
        $currency_details = [
            'symbol' => $business_details->currency_symbol,
            'thousand_separator' => $business_details->thousand_separator,
            'decimal_separator' => $business_details->decimal_separator,
        ];

        // dd($business_details,$currency_details);

        $output['html_content'] = view('sale_pos.receipts.payment_voucher_slip', compact('voucher', 'business_details', 'currency_details'))->render();

        return $output;
    }
    /**
     * Returns the content for the receipt
     *
     */
    public function print_slip($id)
    {
        if (request()->ajax()) {
            $voucher = PaymentVoucher::find($id);
            $output = [
                'is_enabled' => false,
                'print_type' => 'browser',
                'html_content' => null,
                'printer_config' => [],
                'data' => []
            ];
    
            $business_id = request()->session()->get('user.business_id');
            
            $business_details = $this->businessUtil->getDetails($business_id);
            // dd($business_details);
            $currency_details = [
                'symbol' => $business_details->currency_symbol,
                'thousand_separator' => $business_details->thousand_separator,
                'decimal_separator' => $business_details->decimal_separator,
            ];
    
            // dd($business_details,$currency_details);
    
            $output['html_content'] = view('sale_pos.receipts.payment_voucher_slip', compact('voucher', 'business_details', 'currency_details'))->render();

            $receipt = view('sale_pos.receipts.payment_voucher_slip', compact('voucher', 'business_details', 'currency_details'))->render();
            // $output['html_content'] = view('sale_pos.receipts.payment_voucher_slip', compact('voucher', 'business_details', 'currency_details'))->render();
            
            $output = [
                'success' => 1,
                'receipt' => $receipt,
                'html_content' => $receipt,
            ];
            // return $receipt;
            return $output;
            // return 'hello';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentVoucher  $paymentVoucher
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentVoucher $paymentVoucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentVoucher  $paymentVoucher
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentVoucher $paymentVoucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentVoucher  $paymentVoucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentVoucher $paymentVoucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentVoucher  $paymentVoucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentVoucher $paymentVoucher)
    {
        //
    }
}
