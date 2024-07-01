<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->enum('type', ['employee', 'supllier', 'costumer']);
            $table->integer('identifier');
            $table->unsignedBigInteger('address_id');
            $table->enum('people_type', ['cpf', 'cnpj']);
            $table->string('cellphone');
            $table->boolean('active');
            $table->date('born_date');
            $table->timestamps();

            $table->foreign('address_id')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
};
