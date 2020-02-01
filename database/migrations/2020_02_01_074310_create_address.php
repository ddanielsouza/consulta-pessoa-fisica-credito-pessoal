<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('material_asset_id');
            $table->string('zipCode', 250);
            $table->string('hash_zip_code', 100);
            $table->string('streetAddress', 400);
            $table->string('complement', 400);
            $table->string('neighborhood', 400);
            $table->string('cod_ibge');
            $table->timestamps();
            $table->foreign('material_asset_id')->references('id')->on('material_assets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
