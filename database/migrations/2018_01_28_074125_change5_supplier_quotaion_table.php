<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Change5SupplierQuotaionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_quoatation', function (Blueprint $table) {
            $table->dropColumn('comment');
            $table->dropColumn('file');
        });
        Schema::table('supplier_quoatation', function (Blueprint $table) {
            $table->string('file')->nullable()->after('unit_price');
            $table->string('comment')->nullable()->after('unit_price');
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
