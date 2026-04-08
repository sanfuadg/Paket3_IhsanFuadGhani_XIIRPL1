<header class="border-b border-[var(--color-app-line)] bg-white">
    <div class="container-app flex items-center justify-between py-4">
        <a href="{{ route('siswa.form') }}" class="text-xl font-extrabold tracking-tight text-brand-600">NeskarFix</a>
        <nav class="flex items-center gap-2">
            <a href="{{ route('siswa.form') }}" class="nav-link {{ request()->routeIs('siswa.form') ? 'nav-link-active' : '' }}">Form Aspirasi</a>
            <a href="{{ route('siswa.hasil') }}" class="nav-link {{ request()->routeIs('siswa.hasil') ? 'nav-link-active' : '' }}">Hasil Aspirasi</a>
            <a href="{{ route('admin.login') }}" class="nav-link">Admin</a>
        </nav>
    </div>
</header>
