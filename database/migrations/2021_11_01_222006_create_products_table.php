<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->id();
            $table->string('name');
            $table->string('descripcion');
            $table->integer('porcentaje')->default(0);
            $table->decimal('price', 10, 2);
            $table->string('imagen',30)->nullable()->default(null);
            $table->integer('concesionado')->nullable()->default(null);
            $table->string('motivo',100)->nullable()->default(null);
            $table->integer('existencia')->nullable()->default('1');
            $table->integer('pendiente')->nullable()->default('0');
            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        //Schema::dropIfExists('products');
    }
}
