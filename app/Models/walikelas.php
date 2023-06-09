<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walikelas extends Model
{
    use HasFactory;
    protected $table = 'wali_kelas';
    protected $primaryKey = 'id_walas';
    protected $softDelete = false;
    public $timestamps = false;
    protected $fillable = ['nip_guru','id_akun','nama_walas'];

    public function prakerin()
    {
        return $this->belongsTo(Prakerin::class, 'id_walas', 'id_walas');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_walas', 'id_walas');
    }
}