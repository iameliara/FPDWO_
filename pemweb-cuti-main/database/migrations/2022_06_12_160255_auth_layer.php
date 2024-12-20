<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AuthLayer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('email', 254);
            $table->char('password', 60);
            $table->string('nama', 128);
        });

        Schema::table('pegawai', function (Blueprint $table) {
            $table->char('password', 60)->after('no_induk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropColumn('password');
        });

        Schema::drop('pegawai');
    }
}
