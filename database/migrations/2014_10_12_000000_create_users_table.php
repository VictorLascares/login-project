<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre',30);
            $table->string('apellido_paterno',20)->nullable()->default(null);
            $table->string('apellido_materno',20)->nullable()->default(null);
            $table->string('correo',45);
            $table->string('imagen',30)->nullable()->default(null);
            $table->enum('rol',['Supervisor','Encargado','Contador','Cliente'])->default('Cliente');
            $table->tinyInteger('activo')->default('0');
            $table->string('password',100);
            $table->unique(["correo"],'correo_UNIQUE');
            $table->index(["nombre"], 'acendente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

