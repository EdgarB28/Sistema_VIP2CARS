<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesRepuestosTable extends Migration
{
    public function up()
    {
        Schema::create('detalles_repuestos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('orden_id');
            $table->string('repuesto');
            $table->integer('cantidad')->default(1);
            $table->decimal('precio_unit', 10, 2)->default(0);

            // campo calculado
            $table->decimal('precio_total', 10, 2)->storedAs('cantidad * precio_unit');

            $table->timestamps();

            $table->foreign('orden_id')->references('id')->on('ordenes_servicio')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalles_repuestos');
    }
}
