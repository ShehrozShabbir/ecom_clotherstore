<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('details')->nullable();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('size')->nullable();
            $table->decimal('selling_price', 8, 2);
            $table->decimal('buying_price', 8, 2);
            $table->enum('status', ['available', 'not_available'])->default('available');
            $table->integer('stock_quantity')->default(0);
            $table->enum('product_label', ['on_sale', 'hot', 'feature', 'new'])->default('new');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['details', 'brand_id', 'category_id', 'size', 'selling_price', 'buying_price', 'status', 'stock_quantity', 'product_label']);
        });
    }
}
