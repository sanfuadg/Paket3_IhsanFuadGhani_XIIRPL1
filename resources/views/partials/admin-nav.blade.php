<header class="border-b border-[var(--color-app-line)] bg-white">
    <div class="container-app flex items-center justify-between py-4">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-extrabold tracking-tight text-brand-600">NeskarFix</a>
            <span class="ml-2 text-sm text-slate-500">Admin</span>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.aspirasi.detail') ? 'nav-link-active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.histori') }}" class="nav-link {{ request()->routeIs('admin.histori') ? 'nav-link-active' : '' }}">Histori</a>
            <form action="{{ route('admin.logout') }}" method="POST" data-logout-form>
                @csrf
                <button type="submit" class="btn-secondary">Keluar</button>
            </form>
        </div>
    </div>
</header>
