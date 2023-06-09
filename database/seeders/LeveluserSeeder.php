<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Leveluser;

class LeveluserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Leveluser::factory()->create([
        'nama_level' => 'Staff Hubin',
        'keterangan' => 'Hubungan Industri'
      ]);

      Leveluser::factory()->create([
        'nama_level' => 'Kepala Program',
        'keterangan' => 'Kepala Program'
      ]);

      Leveluser::factory()->create([
        'nama_level' => 'Wali Kelas',
        'keterangan' => 'Wali Kelas'
      ]);

      Leveluser::factory()->create([
        'nama_level' => 'Pembimbing Sekolah',
        'keterangan' => 'Pembimbing Sekolah'
      ]);

      Leveluser::factory()->create([
        'nama_level' => 'Pembimbing Perusahaan',
        'keterangan' => 'Pembimbing Perusahaan'
      ]);

      Leveluser::factory()->create([
        'nama_level' => 'Siswa',
        'keterangan' => 'Peserta Didik'
      ]);
    }
}