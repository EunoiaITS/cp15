<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Change4SupplierQuotaionTable extends Migration
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
            $table->string('comment')->nullable();
            $table->string('file')->nullable();
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
