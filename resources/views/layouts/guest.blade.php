<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('/img/senakitch.ico') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/estilos.css">
	    <link rel="stylesheet" href="css/font-awesome.css">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
      
        <!-- Scripts -->
        @vite(['resources/js/app.js']) 

        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    </head>
    <body>
        {{ $slot }}
        @livewireScripts
    </body>
</html>

<script>
    function ContraseñaVisibilidad() {
        let passwordInput = document.getElementById("password");
        let toggleButton = document.querySelector(".visibilidad-password");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleButton.innerHTML = '<i class="far fa-eye-slash"></i>';
        } else {
            passwordInput.type = "password";
            toggleButton.innerHTML = '<i class="far fa-eye"></i>';
        }
    }
</script>
