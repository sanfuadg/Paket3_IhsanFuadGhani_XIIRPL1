<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['nis' => '12345', 'kelas' => 'XII RPL 1'],
            ['nis' => '12346', 'kelas' => 'XII RPL 1'],
            ['nis' => '12347', 'kelas' => 'XII RPL 2'],
        ];

        foreach ($items as $item) {
            Siswa::updateOrCreate(['nis' => $item['nis']], $item);
        }
    }
}
