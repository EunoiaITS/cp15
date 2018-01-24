<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Change4PriceApprovalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_quoatation', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('supplier_quoatation', function (Blueprint $table) {
            $table->enum('status',array('requested','approved'))->after('show_price');
        });
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
