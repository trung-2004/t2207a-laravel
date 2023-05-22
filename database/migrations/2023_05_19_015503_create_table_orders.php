<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrders extends Migration
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
            $table->string("firstname");
            $table->string("lastname");
            $table->string("country")->nullable();
            $table->tinyText("address");
                $table->string("city");
            $table->string("state")->nullable();
            $table->integer("postcode")->nullable();
            $table->string("phone", 20);
            $table->string("email");
            $table->string("payment_method", 20);
            $table->boolean("is_paid")->default(false);
            $table->tinyInteger("status")->default(0);
            $table->decimal("total", 14, 2);
            $table->timestamps();
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
