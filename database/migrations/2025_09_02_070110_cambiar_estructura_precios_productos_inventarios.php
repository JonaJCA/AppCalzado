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
        Schema::table('productos', function (Blueprint $table) {
            $table->decimal('precio_compra', 10, 2)->after('descripcion');
            $table->dropColumn('precio_venta');
        });

        Schema::table('inventarios', function (Blueprint $table) {
            $table->decimal('precio_venta', 10, 2)->after('cantidad');
            $table->dropColumn('precio_compra');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->decimal('precio_venta', 10, 2)->after('descripcion');
            $table->dropColumn('precio_compra');
        });
        
        Schema::table('inventarios', function (Blueprint $table) {
            $table->decimal('precio_compra', 10, 2)->after('producto_id');
            $table->dropColumn('precio_venta');
        });
    }
};
