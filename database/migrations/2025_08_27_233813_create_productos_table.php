<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marca_id')->constrained('marcas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('modelo_id')->constrained('modelos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('talla_id')->constrained('tallas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('color_id')->constrained('colores')->onDelete('cascade')->onUpdate('cascade');
            $table->string('codigo_producto')->unique();
            $table->string('descripcion');
            $table->decimal('precio_venta',8,2)->nullable();
            $table->integer('stock_actual')->default(0);
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
