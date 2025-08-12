<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="w-full">
    <nav class="flex justify-center bg-gray-200 p-2">
        <div class="max-w-7xl w-full mx-auto flex flex-col sm:flex-row items-center justify-between gap-3">
            <h2 class="text-2xl">
                Elovate
            </h2>
            <ul class="flex flex-row justify-around">
                <li>
                    <a wire:navigate class=" hover:text-blue-700 text-blue-400 font-bold py-2 px-4 rounded"
                       href="/">Home</a>
                </li>
                <li>
                    <a wire:navigate class=" hover:text-blue-700 text-blue-400 font-bold py-2 px-4 rounded"
                       href="/products">Producten</a>
                </li>
            </ul>
        </div>
    </nav>
    <main class="max-w-7xl mx-auto">
        {{ $slot }}
    </main>
</div>
</body>
</html>
