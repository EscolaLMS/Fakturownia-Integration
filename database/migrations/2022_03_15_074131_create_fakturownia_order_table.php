<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakturowniaOrderTable extends Migration
{
    public function up(): void
    {
        Schema::create('fakturownia_orders', function (Blueprint $table) {
            $table->unsignedInteger('fakturownia_id');
            $table->unsignedInteger('order_id');
        });
    }

    public function down(): void
    {
        Schema::drop('fakturownia_orders');
    }
}
