<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            {{-- <x-authentication-card-logo /> --}}
        </x-slot>

        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div  class="Login-box">
                <img class="avatar" src="favicons/Kitch2.png" alt="Logo de Fazt">
                <h1>Crear Cuenta</h1>
                {{-- <x-validation-errors class="mb-4" /> --}}
                <div class="input-control">
                    <section> 
                      @error('name')
                        <small class="small">{{$message}}</small>
                      @enderror
                    </section> 
                    <x-label for="name" value="{{ __('Nombre') }}" />
                    <x-input id="name" placeholder="Nombre" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div  class="input-control">
                    @error('email')
                    <small class="small">{{$message}}</small>
                    @enderror
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" placeholder="Email"  class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <div class="mt-4 input-control">
                    @error('password')
                    <small class="small">{{$message}}</small>
                    @enderror
                    <x-label for="password" value="{{ __('Contraseña') }}" />
                    <x-input id="password" placeholder="minimo 8 caracteres"  class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4 input-control" >
                    @error('password_confirmation')
                    <small class="small">{{ $message }}</small>
                @enderror
                    <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                    <x-input id="password_confirmation" placeholder="confirmar contraseña" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    
                    <x-button class="ml-4">
                        {{ __('Registrar') }}
                    </x-button>
                    
                    <a class="a" href="{{ route('login') }}">
                        {{ __('ya tienes una cuenta?') }}
                    </a>
                </div>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
