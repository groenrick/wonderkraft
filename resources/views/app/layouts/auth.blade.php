{{-- resources/views/app/layouts/auth.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title', 'Authentication')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body>
<div id="app">
    @yield('content')
</div>

@stack('scripts')
</body>
</html>
