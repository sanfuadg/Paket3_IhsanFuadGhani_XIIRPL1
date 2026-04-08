<x-layouts.app :title="'NeskarFix - Login Admin'">
    <div class="flex min-h-[80vh] items-center justify-center">
        <div class="w-full max-w-lg">
            <div class="card overflow-hidden">
                <div class="border-b border-[var(--color-app-line)] bg-slate-50 px-8 py-7 text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-brand-50 text-2xl font-bold text-brand-600">N</div>
                    <h1 class="text-3xl font-bold text-slate-900">Login Admin</h1>
                    <p class="mt-2 text-sm text-slate-500">Masuk untuk mengelola aspirasi siswa.</p>
                </div>
                <div class="p-8">
                    <form action="{{ route('admin.login.attempt') }}" method="POST" data-validate="simple" class="space-y-6">
                        @csrf

                        <div>
                            <label for="username" class="mb-2 block text-sm font-semibold text-slate-700">Username</label>
                            <input id="username" name="username" value="{{ old('username') }}" data-required="true" placeholder="Masukkan username admin">
                            @error('username') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                            <input id="password" name="password" type="password" data-required="true" placeholder="Masukkan password admin">
                            @error('password') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="btn-primary w-full py-4 text-base font-semibold">Login</button>
                    </form>
                    <p class="mt-5 text-center text-sm text-slate-500">Kembali ke <a href="{{ route('siswa.form') }}" class="font-semibold text-brand-600">Form Aspirasi</a></p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
