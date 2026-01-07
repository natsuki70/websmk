<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;

    protected $table = 'pertemuans';

    protected $fillable = [
        'mapel_id',
        'pertemuan_ke',
        'pembahasan',
        'deskripsi',
        'materi',
        'video_url',
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function kuis()
    {
        return $this->hasOne(Kuis::class);
    }
}
