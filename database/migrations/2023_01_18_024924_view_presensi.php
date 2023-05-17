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
        CREATE OR REPLACE VIEW view_presensi AS
        SELECT 
                siswa.nis, 
                siswa.nama_siswa, 
                presensi_siswa.nik_pp,
                pembimbing_perusahaan.nama_pp,
                presensi_siswa.tgl_kehadiran, 
                presensi_siswa.jam_masuk,
                presensi_siswa.jam_keluar,
                presensi_siswa.keterangan,
                presensi_siswa.kegiatan,
                presensi_siswa.status_hadir,
                presensi_siswa.id_presensi,
                presensi_siswa.foto_selfie,
                view_prakerin.id_ps,
                view_prakerin.nama_ps

        FROM presensi_siswa
        
        INNER JOIN siswa ON presensi_siswa.nis = siswa.nis
        INNER JOIN pembimbing_perusahaan ON presensi_siswa.nik_pp = pembimbing_perusahaan.nik_pp
        INNER JOIN view_prakerin ON presensi_siswa.nis = view_prakerin.nis

    ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_presensi');
    }
};