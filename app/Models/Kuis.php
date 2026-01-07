<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;

    protected $table = 'kuis';

    protected $fillable = [
        'judul',
        'mapel_id',
        'pertemuan_id',
        'kelas_id',
        'status',
        'kkm',
        'durasi_menit',
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function soals()
    {
        return $this->hasMany(Soal::class);
    }
}
