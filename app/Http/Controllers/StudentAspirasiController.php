<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentAspirasiController extends Controller
{
    private function ensureDefaultKategori(): void
    {
        if (Kategori::count() > 0) {
            return;
        }

        foreach ([
            'Kebersihan',
            'Kerusakan Fasilitas',
            'Keamanan',
            'Kelistrikan',
            'Air & Sanitasi',
            'Lainnya',
        ] as $item) {
            Kategori::firstOrCreate(['ket_kategori' => $item]);
        }
    }

    public function create(): View
    {
        $this->ensureDefaultKategori();

        return view('siswa.form', [
            'kategoriList' => Kategori::orderBy('ket_kategori')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->ensureDefaultKategori();

        $validated = $request->validate([
            'nis' => ['required', 'string', 'max:30'],
            'id_kategori' => ['required', 'exists:kategori,id_kategori'],
            'lokasi' => ['required', 'string', 'max:255'],
            'ket' => ['required', 'string', 'max:1000'],
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'id_kategori.required' => 'Kategori wajib dipilih.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'ket.required' => 'Keterangan wajib diisi.',
        ]);

        Siswa::firstOrCreate([
            'nis' => $validated['nis'],
        ], [
            'kelas' => '-',
        ]);

        $input = InputAspirasi::create($validated);

        Aspirasi::create([
            'id_aspirasi' => $input->id_pelaporan,
            'status' => 'Menunggu',
            'id_kategori' => $input->id_kategori,
            'admin_username' => null,
            'feedback' => null,
        ]);

        return redirect()
            ->route('siswa.form')
            ->with('success', 'Aspirasi berhasil dikirim.');
    }

    public function hasil(Request $request): View
    {
        $this->ensureDefaultKategori();

        $nis = $request->query('nis');
        $results = collect();

        if ($nis) {
            $results = InputAspirasi::with(['kategori', 'aspirasi.admin'])
                ->where('nis', $nis)
                ->latest()
                ->get();
        }

        return view('siswa.hasil', [
            'nis' => $nis,
            'results' => $results,
        ]);
    }
}
