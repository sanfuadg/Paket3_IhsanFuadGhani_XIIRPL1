<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'NeskarFix' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eef4ff',
                            100: '#dbe8ff',
                            500: '#2563eb',
                            600: '#1d4ed8',
                            700: '#1e40af'
                        }
                    }
                }
            }
        };
    </script>
    <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
    <script defer src="{{ asset('assets/app.js') }}"></script>
</head>
<body>
    @isset($navigation)
        {{ $navigation }}
    @endisset

    <main class="py-8">
        <div class="container-app">
            @if(session('success'))
                <div data-flash class="flash flash-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div data-flash class="flash flash-error">{{ session('error') }}</div>
            @endif

            {{ $slot }}
        </div>
    </main>
</body>
</html>