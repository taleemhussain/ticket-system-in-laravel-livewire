<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite('resources/css/app.css')
        
        @livewireStyles
        @livewireScripts
    </head>
    
    <body class="flex justify-center">
        <div class="w-10/12 my-10 flex">
            <div class="w-5/12 rounded border p-2">
                <livewire:tickets />
            </div>
            <div class="w-7/12 mx-2 rounded border p-2">
                <livewire:comments />
            </div>
        </div>
    
    </body>

</html>
