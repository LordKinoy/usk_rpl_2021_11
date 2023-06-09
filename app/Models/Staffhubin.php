<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staffhubin extends Model
{
    use HasFactory;
    protected $table = 'staff_hubin';
    protected $primaryKey = 'id_staff';
    protected $softDelete = false;
    public $timestamps = false;
    protected $fillable = ['nip_guru','id_akun','nama_staff'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru','id_guru');
    }

    public function akun()
    {
        return $this->belongsTo(User::class, 'id_akun','id');
    }
}