<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditOrdersAndOrderLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('discount_percentage', 8, 2)->nullable()->default(0)->change();
            $table->decimal('vat_percentage')->nullable()->default(0)->change();
        });

        Schema::table('order_lines', function (Blueprint $table) {
            $table->decimal('discount_percentage', 8, 2)->nullable()->default(0);
            $table->decimal('total_discount', 8, 2)->nullable()->default(0);
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
