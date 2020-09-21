<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentVoucher extends Model
{
    public function voucher_data()
    {
        return $this->hasMany(PaymentVoucherData::class,'payment_voucher_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
