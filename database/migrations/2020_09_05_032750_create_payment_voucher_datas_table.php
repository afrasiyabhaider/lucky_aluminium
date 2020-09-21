<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentVoucherDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_voucher_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('payment_voucher_id');
            $table->string('title');
            $table->decimal('amount',6,2);
            $table->timestamps();

            $table->foreign('payment_voucher_id')->references('id')->on('payment_vouchers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_voucher_datas');
    }
}
