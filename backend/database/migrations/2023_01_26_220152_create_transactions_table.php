<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('description', 255);
            $table->enum('type', ['Credit', 'Debet']);
            $table->bigInteger('amount');
            $table->bigInteger('balance');
            $table->string('customer_id', 50)->index();
            $table->unsignedBigInteger('user_id')->index();
 
            $table->foreign('customer_id')->references('nisn')->on('customers')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
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
};
