<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_pantis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_panti');
            $table->string('foto');
            $table->timestamps();
        });

        Schema::table('foto_pantis', function (Blueprint $table) {
            $table->foreign('id_panti')->references('id')->on('pantis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foto_pantis');
    }
};
?>
