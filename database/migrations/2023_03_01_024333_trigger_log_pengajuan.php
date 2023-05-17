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
        CREATE OR REPLACE TRIGGER trigger_log_pengajuan
        
        AFTER UPDATE ON pengajuan
        
        FOR EACH ROW
        
        BEGIN
        
        INSERT INTO log_pengajuan

        VALUES (,'UPDATE',OLD.id_pengajuan,OLD.nis,now());

        END;
        
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
    }
};