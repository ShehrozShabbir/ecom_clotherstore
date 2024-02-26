<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->date('order_date');
            $table->string('customer_name');
            $table->string('customer_address');
            $table->string('contact_number');
            $table->text('order_notes')->nullable();
            $table->string('payment_type');
            $table->string('payment_status');
            $table->string('order_status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
