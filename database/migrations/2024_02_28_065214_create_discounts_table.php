<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // In the create_discounts_table migration file
public function up()
{
    Schema::create('discounts', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('product_id');
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        $table->string('title');
        $table->decimal('percentage', 5, 2);
        $table->date('start_date');
        $table->date('end_date');
        $table->boolean('status')->default(true);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('discounts');
}

};
