<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBibliotkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

	public function up()
    {
		Schema::create('usuario', function(Blueprint $table) {
		    $table->increments('id')->unsigned();
		    $table->string('email', 250);
		    $table->string('password', 250);
		    $table->dateTime('date_delete');		
			$table->timestamps();
		});

		Schema::create('autor', function(Blueprint $table) {
		    $table->increments('id')->unsigned();
		    $table->string('nombre', 250);
		    $table->string('apellidos', 250);
		    $table->string('seudonimo', 250);
		    $table->dateTime('date_fallecimiento');
			$table->timestamps();		
		});

		Schema::create('idioma', function(Blueprint $table) {
		    $table->increments('id')->unsigned();
		    $table->string('nombre', 250);
		    $table->string('codigo', 10);
		    $table->timestamps();
		});

		
		Schema::create('plan', function(Blueprint $table) {
		    $table->increments('id')->unsigned();
		    $table->string('nombre', 250);
		    $table->string('descripcion', 250);
		    $table->decimal('precio', 15, 4);
		    $table->timestamps();
		});

		Schema::create('editorial', function(Blueprint $table) {
		    $table->increments('id')->unsigned();
		    $table->string('nombre', 250);
		    $table->timestamps();
		});

		Schema::create('pais', function(Blueprint $table) {
		    $table->increments('id')->unsigned();
		    $table->string('pais_id', 2);
		    $table->string('nombre', 100);
		    $table->timestamps();
		});

		Schema::create('libro', function(Blueprint $table) {
		    $table->increments('id')->unsigned();
		    $table->integer('id_autor')->unsigned();
		    $table->dateTime('date_delete');
			$table->timestamps();

			$table->foreign('id_autor')
				->references('id')
				->on('autor');
		});

		Schema::create('catalogo', function(Blueprint $table) {
		    $table->increments('id')->unsigned();
		    $table->integer('id_idioma')->unsigned();
		    $table->string('nombre', 250);
		    $table->longText('descripcion');
			$table->timestamps();
			
		    $table->foreign('id_idioma')
			    ->references('id')
			    ->on('idioma')
			    ->onDelete('cascade');
		});

		Schema::create('usuario_catalogo', function(Blueprint $table) {
		    $table->increments('id')->unsigned();
		    $table->integer('id_usuario')->unsigned();
		    $table->integer('id_catalogo')->unsigned();
		    $table->timestamps();

		    $table->foreign('id_usuario')
			    ->references('id')
			    ->on('usuario')
			    ->onDelete('cascade');
		});

		Schema::create('libro_detalle', function(Blueprint $table) {
		    $table->increments('id')->unsigned();
		    $table->integer('id_libro')->unsigned();
		    $table->integer('id_idioma')->unsigned();
		    $table->integer('id_editorial')->unsigned();
		    $table->integer('id_catalogo')->unsigned();
		    $table->string('titulo', 250);
		    $table->string('portada', 250);
			$table->integer('o_edicion');
			$table->timestamps();

		    $table->foreign('id_libro')
			    ->references('id')
			    ->on('libro')
			    ->onDelete('cascade');

		    $table->foreign('id_idioma')
			    ->references('id')
			    ->on('idioma')
			    ->onDelete('cascade');

		    $table->foreign('id_editorial')
			    ->references('id')
			    ->on('editorial')
			    ->onDelete('cascade');

		    $table->foreign('id_catalogo')
			    ->references('id')
			    ->on('catalogo')
			    ->onDelete('cascade');	
		});

		Schema::create('libro_archivo', function(Blueprint $table) {
		    $table->increments('id')->unsigned();
		    $table->integer('id_detalle')->unsigned();
		    $table->string('archivo', 250);

		    $table->foreign('id_detalle')
			    ->references('id')
			    ->on('libro_detalle')
			    ->onDelete('cascade');
		
		    $table->timestamps();
		});

		Schema::create('usuario_detalle', function(Blueprint $table) {
		    $table->increments('id')->unsigned();
		    $table->integer('id_usuario')->unsigned();
		    $table->integer('id_plan')->unsigned();
		    $table->integer('id_pais')->unsigned();
		    $table->string('nombre', 250);
		    $table->string('apellidos', 250);

		    $table->foreign('id_usuario')
			    ->references('id')
			    ->on('usuario')
			    ->onDelete('cascade');

		    $table->foreign('id_plan')
			    ->references('id')
			    ->on('plan')
			    ->onDelete('cascade');

		    $table->foreign('id_pais')
			    ->references('id')
			    ->on('pais')
			    ->onDelete('cascade');
		
		    $table->timestamps();
		
		});

		Schema::create('usuario_perfil', function(Blueprint $table) {
		    $table->increments('id')->unsigned();
		    $table->integer('id_usuario')->unsigned();
		    $table->integer('id_idioma')->unsigned();

		    $table->foreign('id_usuario')
			    ->references('id')
			    ->on('usuario')
			    ->onDelete('cascade');

		    $table->foreign('id_idioma')
			    ->references('id')
			    ->on('idioma')
			    ->onDelete('cascade');
		
		    $table->timestamps();
		
		});

		Schema::create('comentario', function(Blueprint $table) {
		    $table->increments('id')->unsigned();
		    $table->integer('id_usuario')->unsigned();
		    $table->integer('id_libro')->unsigned();
		    $table->dateTime('date');
		    $table->longText('comentario');
		    $table->integer('valoracion')->unsigned();

		    $table->foreign('id_usuario')
			    ->references('id')
			    ->on('usuario')
			    ->onDelete('cascade');

		    $table->foreign('id_libro')
			    ->references('id')
			    ->on('libro')
			    ->onDelete('cascade');
		
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
		Schema::drop('pais');
		Schema::drop('comentario');
		Schema::drop('plan');
		Schema::drop('idioma');
		Schema::drop('usuario_perfil');
		Schema::drop('usuario_detalle');
		Schema::drop('libro_detalle');
		Schema::drop('editorial');
		Schema::drop('autor');
		Schema::drop('libro_archivo');
		Schema::drop('usuario_catalogo');
		Schema::drop('catalogo');
		Schema::drop('libro');
		Schema::drop('usuario');

    }
}