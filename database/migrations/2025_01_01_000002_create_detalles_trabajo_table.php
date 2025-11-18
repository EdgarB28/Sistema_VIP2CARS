<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesTrabajoTable extends Migration
{
    public function up()
    {
        Schema::create('detalles_trabajo', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('orden_id');
            $table->text('descripcion');
            $table->decimal('precio', 10, 2)->default(0);

            $table->timestamps();

            $table->foreign('orden_id')->references('id')->on('ordenes_servicio')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalles_trabajo');
    }
}
