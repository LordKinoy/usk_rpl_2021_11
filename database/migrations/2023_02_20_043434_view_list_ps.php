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
        CREATE OR REPLACE VIEW view_list_ps AS

        SELECT 
            pembimbing_sekolah.id_ps, 
            guru.id_guru, 
            guru.nip_guru, 
            guru.nama_guru AS nama_ps

        FROM pembimbing_sekolah

        INNER JOIN guru ON pembimbing_sekolah.id_guru = guru.id_guru;
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
        Schema::dropIfExists('view_list_ps');
    }
};