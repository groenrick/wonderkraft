{{-- resources/views/corporate/layouts/main.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('wonderkraft-favicon-cropped.svg') }}">
    <title>@yield('title', config('app.name'))</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
@include('corporate.partials.header')

<main>
    @yield('content')
</main>

@include('corporate.partials.footer')

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    }
</script>
</body>
</html>
