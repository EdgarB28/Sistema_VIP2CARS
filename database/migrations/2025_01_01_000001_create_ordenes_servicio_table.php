<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesServicioTable extends Migration
{
    public function up()
    {
        Schema::create('ordenes_servicio', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->integer('id_cliente');
            $table->integer('id_vehiculo');

            // Información de la orden
            $table->text('descripcion')->nullable();
            $table->enum('estado', ['Pendiente', 'En Proceso', 'Finalizado', 'Entregado'])->default('Pendiente');

            // Fechas
            $table->dateTime('fecha_ingreso')->default(now());
            $table->dateTime('fecha_salida')->nullable();

            // Totales
            $table->decimal('total_mano_obra', 10, 2)->default(0);
            $table->decimal('total_repuestos', 10, 2)->default(0);

            // total calculado, no editable
            $table->decimal('total', 10, 2)->storedAs('total_mano_obra + total_repuestos');

            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');
            $table->foreign('id_vehiculo')->references('id_vehiculo')->on('vehiculos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordenes_servicio');
    }
}
