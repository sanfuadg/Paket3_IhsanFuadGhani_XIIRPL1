<x-layouts.app :title="'NeskarFix - Histori Aspirasi'">
    <x-slot:navigation>
        @include('partials.admin-nav')
    </x-slot:navigation>

    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Histori Aspirasi</h1>
            <p class="mt-1 text-sm text-slate-500">Seluruh riwayat aspirasi beserta status dan feedback terbaru.</p>
        </div>

        <div class="table-shell">
            <div class="table-wrap">
                <table class="table-basic min-w-full">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>NIS</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                            @php $status = optional($item->aspirasi)->status ?? 'Menunggu'; @endphp
                            <tr>
                                <td>{{ $item->created_at?->format('d/m/Y') }}</td>
                                <td class="font-semibold">{{ $item->nis }}</td>
                                <td>{{ $item->kategori?->ket_kategori }}</td>
                                <td>
                                    <span class="badge {{ $status === 'Menunggu' ? 'badge-menunggu' : ($status === 'Proses' ? 'badge-proses' : 'badge-selesai') }}">{{ $status }}</span>
                                </td>
                                <td class="max-w-md text-slate-500">{{ optional($item->aspirasi)->feedback ?: '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-10 text-center text-slate-500">Belum ada histori aspirasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
