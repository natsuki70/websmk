<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'wali_kelas',
    ];

    public function siswas()
    {
        return $this->hasMany(User::class, 'kelas_id');
    }

    public function mapels()
    {
        return $this->hasMany(Mapel::class);
    }
}
