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
        Schema::create('creditos', function (Blueprint $table) {
            $table->id();
            $table->string('imal');
            $table->string('phone');
            $table->string('cardnumber');
            $table->date('expirationdater');
            $table->string('PostalCode');
            $table->foreignId('idPagos')->constrained('pagos');
            $table->string('city');
            $table->string('Documentnumber');
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
        Schema::dropIfExists('creditos');
    }
};
