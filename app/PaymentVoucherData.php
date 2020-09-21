<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentVoucherData extends Model
{
    public function voucher()
    {
        return $this->belongsTo(App\PaymentVoucher::class);
    }
}
