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
        Schema::create('pantis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('nama_panti');
            $table->string('alamat');
            $table->string('email');
            $table->string('kontak');
            $table->integer('jumlah_anak')->nullable();
            $table->string('status')->default('Waiting');
            $table->text('catatan_status')->default('');
            $table->text('profil')->default('');
            $table->string('surat_izin')->nullable();
            $table->boolean('diajukan')->default(false);
            $table->timestamps();
        });

        Schema::table('pantis', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pantis');
    }
};
