<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    protected $softDelete = false;
    public $timestamps = false;
    protected $fillable = ['nis','jurusan','id_kelas','nama_siswa','tempat_lahir','tanggal_lahir'];

    public function prakerin()
    {
        return $this->belongsTo(Prakerin::class, 'nis', 'nis');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'nis', 'nis');
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'id_akun','id');
    }
}