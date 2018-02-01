<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cahnge4SuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->dropColumn('contact');
        });
        Schema::table('suppliers', function (Blueprint $table) {
            $table->string('category')->nullable()->after('qr_id');
            $table->string('contact')->nullable()->after('qr_id');
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
