<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            {{-- <x-authentication-card-logo /> --}}
        </x-slot>        

        
        
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div  class="Login-box">
                <img class="avatar" src="favicons/Kitch2.png" alt="Logo de Fazt">
                <h1>SENAKITCH</h1>
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600" style="color: #22c55e">
                        {{ session('status') }}
                    </div>
                @endif
                <x-validation-errors class="mb-4" />
                <small class="text-olvide-password"><div class="mb-4 text-sm text-gray-600">
                    {{ __('¿Olvidaste tu contraseña? No hay problema. Simplemente indícanos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña que te permitirá elegir una nueva') }}
                </div></small>
                <div class="block">
                    <x-label for="email" value="{{ __('Correo electronico') }}" />
                    <x-input id="email"  placeholder="correo electronico" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button>
                        {{ __('Enviar') }}
                    </x-button>
                </div>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
