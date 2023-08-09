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
        Schema::create('pengurus_pantis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_panti');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('no_hp');
            $table->string('alamat');
            $table->timestamps();
        });

        Schema::table('pengurus_pantis', function (Blueprint $table) {
            $table->foreign('id_panti')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengurus_pantis');
    }
};
?>