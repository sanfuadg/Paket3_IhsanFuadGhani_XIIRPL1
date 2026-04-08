<x-layouts.app :title="'NeskarFix - Hasil Aspirasi'">
    <x-slot:navigation>
        @include('partials.student-nav')
    </x-slot:navigation>

    <div class="mx-auto max-w-6xl space-y-6">
        <div class="card p-8">
            <h1 class="text-2xl font-bold text-slate-900">Hasil Aspirasi</h1>
            <p class="mt-1 text-sm text-slate-500">Masukkan NIS untuk melihat status, feedback, dan histori aspirasi.</p>

            <form action="{{ route('siswa.hasil') }}" method="GET" class="mt-5 flex flex-col gap-3 sm:flex-row">
                <input name="nis" value="{{ $nis }}" placeholder="Masukkan NIS untuk melihat aspirasi" class="flex-1">
                <button class="btn-primary sm:min-w-36">Cari</button>
            </form>
        </div>

        @if($nis && $results->isEmpty())
            <div class="card p-10 text-center text-slate-500">Tidak ada aspirasi ditemukan untuk NIS tersebut.</div>
        @endif

        @if($results->isNotEmpty())
            <div class="table-shell">
                <div class="table-wrap">
                    <table class="table-basic min-w-full">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Progres</th>
                                <th>Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $item)
                                @php
                                    $status = optional($item->aspirasi)->status ?? 'Menunggu';
                                    $feedback = optional($item->aspirasi)->feedback;
                                    $progress = ['Menunggu' => 10, 'Proses' => 55, 'Selesai' => 100][$status] ?? 0;
                                @endphp
                                <tr>
                                    <td>{{ $item->created_at?->format('d/m/Y') }}</td>
                                    <td>{{ $item->kategori?->ket_kategori }}</td>
                                    <td>{{ $item->lokasi }}</td>
                                    <td>
                                        <span class="badge {{ $status === 'Menunggu' ? 'badge-menunggu' : ($status === 'Proses' ? 'badge-proses' : 'badge-selesai') }}">{{ $status }}</span>
                                    </td>
                                    <td>
                                        <div class="h-2 min-w-24 overflow-hidden rounded-full bg-slate-100">
                                            <div class="h-full rounded-full bg-brand-500" style="width: {{ $progress }}%"></div>
                                        </div>
                                    </td>
                                    <td class="max-w-xs text-slate-500">{{ $feedback ?: '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
