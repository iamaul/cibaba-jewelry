<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('billing_firstname', 100)->nullable();
            $table->string('billing_lastname', 100)->nullable();
            $table->string('billing_country', 70)->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_address_alt', 60)->nullable();
            $table->string('billing_city', 70)->nullable();
            $table->string('billing_postcode', 10)->nullable();
            $table->string('billing_phone', 13)->nullable();
            $table->string('billing_email', 50)->nullable();
            $table->integer('billing_subtotal');
            $table->integer('billing_total');
            $table->string('status')->default('Pending');
            $table->string('snap_token')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
