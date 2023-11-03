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
        Schema::create('financial_releases', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('description');
            $table->date('financial_date');
            $table->enum('origin', ['cash_entry', 'cash_out']);
            $table->enum('status', ['paid', 'pending']);
            $table->string('recipient');
            $table->float('value');
            $table->unsignedBigInteger('people_id');
            $table->timestamps();

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
        Schema::dropIfExists('financial_releases');
    }
};
