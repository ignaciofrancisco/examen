<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('stock_actual')->default(0)->change();
            $table->integer('stock_minimo')->default(1)->change();
            $table->integer('stock_bajo')->default(1)->change();
            $table->integer('stock_alto')->default(10)->change();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('stock_actual')->change();
            $table->integer('stock_minimo')->change();
            $table->integer('stock_bajo')->change();
            $table->integer('stock_alto')->change();
        });
    }
};
