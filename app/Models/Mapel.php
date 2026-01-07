<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mapel',
        'kode_mapel',
        'guru_pengampu',
        'kelas_id',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function kuis()
    {
        return $this->hasMany(Kuis::class);
    }

    public function pertemuans()
    {
        return $this->hasMany(Pertemuan::class)->orderBy('pertemuan_ke');
    }
}
