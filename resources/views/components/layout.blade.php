<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 11 Tutorial</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar />

    <div class="max-w-6xl mx-auto">
        {{ $slot }}
    </div>
</body>

</html>
