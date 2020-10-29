<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_documento_id')
                ->constrained('tipos_documento_identidad');
            $table->string('nro_documento', 15);
            $table->string('ape_paterno', 80);
            $table->string('ape_materno', 80);
            $table->string('nombres', 100);
            $table->string('direccion', 200);
            $table->foreignId('distrito_id')
                ->constrained();

            $table->unique(['tipo_documento_id', 'nro_documento']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
