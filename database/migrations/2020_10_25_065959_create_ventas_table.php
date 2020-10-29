<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained();
            $table->foreignId('vendedor_id')->constrained('users');
            $table->foreignId('producto_id')->constrained();
            $table->string('direccion', 200);
            $table->foreignId('distrito_id')
                ->constrained();
            $table->dateTime('fecha_compra')->useCurrent();
            $table->boolean('solicita_entrega')->default(false);
            $table->boolean('solicita_armado')->default(false);
            $table->boolean('hay_error_venta')->default(false);
            $table->boolean('es_anulada')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
