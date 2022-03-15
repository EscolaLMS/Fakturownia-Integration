<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakturowniaOrderTable extends Migration
{
    public function up(): void
    {
        Schema::create('fakturownia-orders', function (Blueprint $table) {
            $table->unsignedInteger('fakturownia_id');
            $table->unsignedInteger('order_id');

            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    public function down(): void
    {
        Schema::table('fakturownia-orders', function (Blueprint $table) {
            $table->dropForeign('order_id');
        });

        Schema::drop('fakturownia-orders');
    }
}
