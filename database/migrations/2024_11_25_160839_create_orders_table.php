<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('customer_id');
            $table->decimal('order_amount', 8, 2);
            $table->enum('order_status', ['pending', 'shipped', 'completed', 'cancelled', 'declined']);
            $table->date('order_date');
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->integer('discount_percentage')->nullable()->default(0);
            $table->decimal('total_discount', 8, 2)->nullable()->default(0);
            $table->integer('vat_percentage')->nullable()->default(0);
            $table->decimal('total_vat', 8, 2)->nullable()->default(0);
            $table->decimal('grand_total', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
