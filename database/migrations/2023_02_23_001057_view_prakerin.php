<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::unprepared("
        CREATE OR REPLACE VIEW view_prakerin AS

        SELECT 
            prakerin.id_prakerin, 
            prakerin.nis, 
            view_list_siswa.nama_siswa, 
            prakerin.nik_pp, 
            pembimbing_perusahaan.nama_pp, 
            prakerin.id_ps, 
            view_list_ps.nama_ps, 
            prakerin.id_kaprog,
            view_list_kaprog.nama_kaprog, 
            prakerin.id_perusahaan,
            view_list_perusahaan.nama_perusahaan,
            view_list_siswa.tahun,
            prakerin.status

        FROM prakerin
        
        LEFT JOIN view_list_ps ON prakerin.id_ps = view_list_ps.id_ps
        LEFT JOIN pembimbing_perusahaan ON prakerin.nik_pp = pembimbing_perusahaan.nik_pp
        LEFT JOIN view_list_kaprog ON prakerin.id_kaprog = view_list_kaprog.id_kaprog
        LEFT JOIN view_list_perusahaan ON prakerin.id_perusahaan = view_list_perusahaan.id_perusahaan
        LEFT JOIN view_list_siswa ON prakerin.nis = view_list_siswa.nis;
        
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('view_prakerin');
    }
};