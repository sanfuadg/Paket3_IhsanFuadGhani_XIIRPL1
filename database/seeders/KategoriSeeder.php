<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            'Kebersihan',
            'Kerusakan Fasilitas',
            'Keamanan',
            'Kelistrikan',
            'Air & Sanitasi',
            'Lainnya',
        ];

        foreach ($items as $item) {
            Kategori::firstOrCreate(['ket_kategori' => $item]);
        }
    }
}
