<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? 'Senakicht' }}</title>
        <link rel="icon" href="{{ asset('favicons/LogoSenakicht.ico') }}">
        <script src="https://sdk.mercadopago.com/js/v2"></script>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Styles --> 
          @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/app/app.css')}}">
        @livewireStyles 
    </head>
    <body >
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <div id="app">
            @include('partials.navbar')
            <main class="py-4">
                 {{ $slot }}
            </main>
            @include('partials.footer')
        </div>

        @stack('modals')
        {{-- scrips --}}
        @livewireScripts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="{{ asset('js/prue.js')}}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
        <script src="{{ asset('js/pago.js') }}"></script>
    </body>
</html>
