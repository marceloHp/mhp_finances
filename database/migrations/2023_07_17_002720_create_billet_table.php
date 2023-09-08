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
        Schema::create('billets', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('people_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['pending', 'partial_pending', 'paid', 'canceled']);
            $table->dateTime('release_date');
            $table->dateTime('paid_date');
            $table->float('total_value');
            $table->float('pending_value');
            $table->integer('installments');
            $table->float('paid_value')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('people_id')->references('id')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billets');
    }
};
