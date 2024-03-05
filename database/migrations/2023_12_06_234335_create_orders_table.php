<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('invoice_id');
            $table->double('sub_total');
            $table->double('discount');
            $table->double('total');
            $table->string('payment_status');
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_phone');
            $table->string('coupon')->nullable();
            $table->string('order_status');
            $table->string('region')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
