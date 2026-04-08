<x-layouts.app :title="'NeskarFix - Form Aspirasi'">
    <x-slot:navigation>
        @include('partials.student-nav')
    </x-slot:navigation>

    <div class="mx-auto max-w-3xl">
        <div class="card overflow-hidden">
            <div class="border-b border-[var(--color-app-line)] bg-slate-50 px-8 py-6">
                <h1 class="text-3xl font-bold text-slate-900">Form Aspirasi Siswa</h1>
                <p class="mt-2 text-sm text-slate-500">Sampaikan pengaduan sarana sekolah secara cepat, rapi, dan terstruktur.</p>
            </div>
            <div class="p-8">
                <form action="{{ route('siswa.aspirasi.store') }}" method="POST" data-validate="simple" class="space-y-6">
                    @csrf
                    <div data-inline-alert class="hidden rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700"></div>

                    <div>
                        <label for="nis" class="mb-2 block text-sm font-semibold text-slate-700">NIS</label>
                        <input id="nis" name="nis" value="{{ old('nis') }}" data-required="true" placeholder="Masukkan NIS">
                        @error('nis') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="id_kategori" class="mb-2 block text-sm font-semibold text-slate-700">Kategori</label>
                        <select id="id_kategori" name="id_kategori" data-required="true">
                            <option value="">Pilih kategori</option>
                            @foreach($kategoriList as $kategori)
                                <option value="{{ $kategori->id_kategori }}" @selected(old('id_kategori') == $kategori->id_kategori)>
                                    {{ $kategori->ket_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="lokasi" class="mb-2 block text-sm font-semibold text-slate-700">Lokasi</label>
                        <input id="lokasi" name="lokasi" value="{{ old('lokasi') }}" data-required="true" placeholder="Contoh: Ruang Kelas XII RPL 1">
                        @error('lokasi') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="ket" class="mb-2 block text-sm font-semibold text-slate-700">Keterangan</label>
                        <textarea id="ket" name="ket" rows="6" data-required="true" placeholder="Jelaskan pengaduan atau kerusakan yang terjadi">{{ old('ket') }}</textarea>
                        @error('ket') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="btn-primary w-full py-4 text-base font-semibold">Kirim Aspirasi</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
