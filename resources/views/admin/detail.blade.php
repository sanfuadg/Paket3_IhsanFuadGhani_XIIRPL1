<x-layouts.app :title="'NeskarFix - Detail Aspirasi'">
    <x-slot:navigation>
        @include('partials.admin-nav')
    </x-slot:navigation>

    <div class="mx-auto max-w-3xl space-y-6">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-semibold text-brand-600 hover:text-brand-700">&larr; Kembali ke Dashboard</a>

        <div class="card overflow-hidden">
            <div class="border-b border-[var(--color-app-line)] bg-slate-50 px-6 py-5">
                <h1 class="text-xl font-bold text-slate-900">Detail Aspirasi</h1>
                <p class="mt-1 text-sm text-slate-500">Tinjau data pengaduan sebelum memperbarui status dan feedback.</p>
            </div>
            <div class="grid gap-4 p-6 md:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">NIS</p>
                    <p class="mt-1 text-base font-semibold text-slate-900">{{ $item->nis }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Kategori</p>
                    <p class="mt-1 text-base font-semibold text-slate-900">{{ $item->kategori?->ket_kategori }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Lokasi</p>
                    <p class="mt-1 text-base font-semibold text-slate-900">{{ $item->lokasi }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Tanggal</p>
                    <p class="mt-1 text-base font-semibold text-slate-900">{{ $item->created_at?->format('d/m/Y H:i') }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Keterangan</p>
                    <div class="mt-2 rounded-2xl bg-slate-50 p-4 text-sm leading-7 text-slate-700">{{ $item->ket }}</div>
                </div>
            </div>
        </div>

        <div class="card overflow-hidden">
            <div class="border-b border-[var(--color-app-line)] bg-slate-50 px-6 py-5">
                <h2 class="text-xl font-bold text-slate-900">Proses Aspirasi</h2>
                <p class="mt-1 text-sm text-slate-500">Perbarui status penyelesaian dan berikan feedback kepada siswa.</p>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.aspirasi.update', $item->id_pelaporan) }}" method="POST" data-validate="simple" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <div data-inline-alert class="hidden rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700"></div>

                    <div>
                        <label for="status">Status</label>
                        <select id="status" name="status" data-required="true">
                            @php $currentStatus = optional($item->aspirasi)->status ?? 'Menunggu'; @endphp
                            @foreach(['Menunggu', 'Proses', 'Selesai'] as $status)
                                <option value="{{ $status }}" @selected(old('status', $currentStatus) === $status)>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="feedback">Feedback</label>
                        <textarea id="feedback" name="feedback" rows="5" placeholder="Tulis umpan balik untuk siswa">{{ old('feedback', optional($item->aspirasi)->feedback) }}</textarea>
                    </div>

                    <button type="submit" class="btn-primary w-full">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
