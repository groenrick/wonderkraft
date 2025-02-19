{{-- resources/views/app/layouts/auth.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('wonderkraft-favicon-cropped.svg') }}">
    <title>@yield('title', 'Authentication') - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body class="min-h-screen bg-gray-50">
<div id="app" class="min-h-screen">
    @yield('content')
</div>

@stack('scripts')
</body>
</html>
