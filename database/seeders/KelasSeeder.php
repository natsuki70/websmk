<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas = [
            ['nama_kelas' => 'Kelas 10', 'wali_kelas' => 'Bpk. Ahmad'],
            ['nama_kelas' => 'Kelas 11', 'wali_kelas' => 'Ibu Siti'],
            ['nama_kelas' => 'Kelas 12', 'wali_kelas' => 'Bpk. Budi'],
        ];

        foreach ($kelas as $k) {
            Kelas::create($k);
        }
    }
}
