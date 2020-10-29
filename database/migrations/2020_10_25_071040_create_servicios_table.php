<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id')
                ->constrained();
            $table->foreignId('tipo_servicio_id')
                ->constrained('tipos_servicio');
            $table->foreignId('operador_id')
                ->constrained('users');
            $table->dateTime('fecha_servicio')->useCurrent();
            $table->string('nro_conformidad_servicio', 6)->unique();
            $table->boolean('hay_error_servicio')->default(false);
            $table->text('observaciones')->nullable();
            $table->dateTime('fecha_cierre')->nullable();

            $table->unique(['venta_id', 'tipo_servicio_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}
