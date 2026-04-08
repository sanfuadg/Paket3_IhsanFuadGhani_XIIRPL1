<x-layouts.app :title="'NeskarFix - Dashboard Admin'">
    <x-slot:navigation>
        @include('partials.admin-nav')
    </x-slot:navigation>

    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Dashboard Aspirasi</h1>
            <p class="mt-1 text-sm text-slate-500">Kelola aspirasi siswa berdasarkan tanggal, bulan, siswa, dan kategori.</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="stat-card">
                <p class="text-sm font-medium text-slate-500">Total Aspirasi</p>
                <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ $stats['total'] }}</p>
            </div>
            <div class="stat-card">
                <p class="text-sm font-medium text-slate-500">Menunggu</p>
                <p class="mt-2 text-3xl font-extrabold text-amber-600">{{ $stats['menunggu'] }}</p>
            </div>
            <div class="stat-card">
                <p class="text-sm font-medium text-slate-500">Proses</p>
                <p class="mt-2 text-3xl font-extrabold text-blue-600">{{ $stats['proses'] }}</p>
            </div>
            <div class="stat-card">
                <p class="text-sm font-medium text-slate-500">Selesai</p>
                <p class="mt-2 text-3xl font-extrabold text-emerald-600">{{ $stats['selesai'] }}</p>
            </div>
        </div>

        <div class="card p-6">
            <h2 class="text-lg font-semibold text-slate-900">Filter Data</h2>
            <form method="GET" action="{{ route('admin.dashboard') }}" class="mt-4 grid gap-4 md:grid-cols-2 xl:grid-cols-5">
                <div>
                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ $filters['tanggal'] ?? '' }}">
                </div>
                <div>
                    <label for="bulan">Bulan</label>
                    <input type="month" id="bulan" name="bulan" value="{{ $filters['bulan'] ?? '' }}">
                </div>
                <div>
                    <label for="nis">Siswa (NIS)</label>
                    <input id="nis" name="nis" value="{{ $filters['nis'] ?? '' }}" placeholder="Cari NIS">
                </div>
                <div>
                    <label for="id_kategori">Kategori</label>
                    <select id="id_kategori" name="id_kategori">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoriList as $kategori)
                            <option value="{{ $kategori->id_kategori }}" @selected(($filters['id_kategori'] ?? '') == $kategori->id_kategori)>{{ $kategori->ket_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end gap-3">
                    <button class="btn-primary flex-1">Terapkan</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn-secondary">Reset</a>
                </div>
            </form>
        </div>

        <div class="table-shell">
            <div class="table-wrap">
                <table class="table-basic min-w-full">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>NIS</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aspirasiList as $item)
                            @php $status = optional($item->aspirasi)->status ?? 'Menunggu'; @endphp
                            <tr>
                                <td>{{ $item->created_at?->format('d/m/Y') }}</td>
                                <td class="font-semibold">{{ $item->nis }}</td>
                                <td>{{ $item->kategori?->ket_kategori }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td>
                                    <span class="badge {{ $status === 'Menunggu' ? 'badge-menunggu' : ($status === 'Proses' ? 'badge-proses' : 'badge-selesai') }}">{{ $status }}</span>
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('admin.aspirasi.detail', $item->id_pelaporan) }}" class="btn-secondary">Detail / Proses</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-10 text-center text-slate-500">Belum ada data aspirasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-[var(--color-app-line)] px-4 py-3">
                {{ $aspirasiList->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
