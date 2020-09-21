<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `payment_voucher_datas` CHANGE `amount` `amount` DECIMAL(65,2) NOT NULL;");
        DB::statement("ALTER TABLE `payment_vouchers` CHANGE `total_amount` `total_amount` DECIMAL(65,2) NOT NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
