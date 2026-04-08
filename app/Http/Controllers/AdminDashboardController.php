<?php

namespace App\Http\Controllers;

use App\Models\InputAspirasi;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function dashboard(Request $request): View
    {
        $query = InputAspirasi::with(['kategori', 'aspirasi.admin'])
            ->latest();

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', substr($request->bulan, 5, 2))
                  ->whereYear('created_at', substr($request->bulan, 0, 4));
        }

        if ($request->filled('nis')) {
            $query->where('nis', 'like', '%'.$request->nis.'%');
        }

        if ($request->filled('id_kategori')) {
            $query->where('id_kategori', $request->id_kategori);
        }

        $aspirasiList = $query->paginate(10)->withQueryString();

        $all = InputAspirasi::with('aspirasi')->get();
        $stats = [
            'total' => $all->count(),
            'menunggu' => $all->filter(fn ($item) => optional($item->aspirasi)->status === 'Menunggu')->count(),
            'proses' => $all->filter(fn ($item) => optional($item->aspirasi)->status === 'Proses')->count(),
            'selesai' => $all->filter(fn ($item) => optional($item->aspirasi)->status === 'Selesai')->count(),
        ];

        return view('admin.dashboard', [
            'aspirasiList' => $aspirasiList,
            'kategoriList' => Kategori::orderBy('ket_kategori')->get(),
            'stats' => $stats,
            'filters' => $request->only(['tanggal', 'bulan', 'nis', 'id_kategori']),
        ]);
    }

    public function detail(InputAspirasi $inputAspirasi): View
    {
        $inputAspirasi->load(['kategori', 'aspirasi.admin']);

        return view('admin.detail', [
            'item' => $inputAspirasi,
        ]);
    }

    public function update(Request $request, InputAspirasi $inputAspirasi): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:Menunggu,Proses,Selesai'],
            'feedback' => ['nullable', 'string', 'max:1000'],
        ]);

        $inputAspirasi->aspirasi()->updateOrCreate(
            ['id_aspirasi' => $inputAspirasi->id_pelaporan],
            [
                'status' => $validated['status'],
                'id_kategori' => $inputAspirasi->id_kategori,
                'admin_username' => $request->session()->get('admin_username'),
                'feedback' => $validated['feedback'] ?? null,
            ]
        );

        return redirect()->route('admin.dashboard')->with('success', 'Data berhasil diperbarui.');
    }

    public function histori(): View
    {
        $items = InputAspirasi::with(['kategori', 'aspirasi.admin'])
            ->latest()
            ->get();

        return view('admin.histori', [
            'items' => $items,
        ]);
    }
}
