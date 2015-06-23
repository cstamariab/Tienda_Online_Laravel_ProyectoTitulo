<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Productos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productos',function($table){

			$table->increments('id');
			
			$table->string('nombre',100);
			$table->string('descripcion',100);
			$table->integer('stock');
			$table->integer('precio');
			//$table->integer('categoria_id')->unsigned();
			//$table->foreign('categoria_id')->references('id')->on('categoria');

			$table->timestamps();
			$table->engine = 'InnoDB';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('productos');
	}

}
