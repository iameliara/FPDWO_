<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konfigurasi', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('code', 128);
            $table->text('value');

            $table->string('created_by', 128)->nullable();
            $table->string('updated_by', 128)->nullable();
            $table->string('deleted_by', 128)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique('code');
        });

        Schema::create('departemen', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nama', 128);

            $table->string('created_by', 128)->nullable();
            $table->string('updated_by', 128)->nullable();
            $table->string('deleted_by', 128)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pegawai', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->char('nik', 16);
            $table->char('no_induk', 8);
            $table->string('nama', 128);
            $table->string('alamat', 256);
            $table->char('jenis_kelamin', 1);
            $table->integer('id_departemen');

            $table->string('created_by', 128)->nullable();
            $table->string('updated_by', 128)->nullable();
            $table->string('deleted_by', 128)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique('nik');
            $table->unique('no_induk');
        });

        Schema::create('konfigurasi_cuti', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('tahun');
            $table->integer('jml_cuti_maksimum');
            $table->integer('jml_cuti_bersama');

            $table->string('created_by', 128)->nullable();
            $table->string('updated_by', 128)->nullable();
            $table->string('deleted_by', 128)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique('tahun');
        });

        Schema::create('jenis_cuti', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nama', 128);

            $table->string('created_by', 128)->nullable();
            $table->string('updated_by', 128)->nullable();
            $table->string('deleted_by', 128)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('riwayat_cuti', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_pegawai');
            $table->integer('id_jenis_cuti');
            $table->string('status_cuti', 16);
            $table->text('path_bukti_pengajuan');
            $table->date('tgl_awal_cuti');
            $table->date('tgl_akhir_cuti');

            $table->string('created_by', 128)->nullable();
            $table->string('updated_by', 128)->nullable();
            $table->string('deleted_by', 128)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('pegawai', function (Blueprint $table) {
            $table->foreign('id_departemen')->references('id')->on('departemen');
        });

        Schema::table('riwayat_cuti', function (Blueprint $table) {
            $table->foreign('id_pegawai')->references('id')->on('pegawai');
            $table->foreign('id_jenis_cuti')->references('id')->on('jenis_cuti');
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
            $table->dropForeign(['id_departemen']);
        });

        Schema::table('riwayat_cuti', function (Blueprint $table) {
            $table->dropForeign(['id_pegawai', 'id_jenis_cuti']);
        });

        Schema::drop('konfigurasi');
        Schema::drop('departemen');
        Schema::drop('pegawai');
        Schema::drop('konfigurasi_cuti');
        Schema::drop('jenis_cuti');
        Schema::drop('riwayat_cuti');
    }
}
