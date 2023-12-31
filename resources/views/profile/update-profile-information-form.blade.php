
<x-form-section submit="updateProfileInformation">
   

    <x-slot name="description">
        {{ __('Actualice la información del perfil y la dirección de correo electrónico de su cuenta.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-md-6 col-sm-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />
    
                <x-label for="photo" value="{{ __('Photo') }}" />
    
                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    @if(strpos(Auth::user()->profile_photo_path, 'http') === 0)
                    <img src="{{ $this->user->profile_photo_path }}" alt="{{ $this->user->name }}" class="rounded-full img-fluid">
                @else
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full img-fluid">
                @endif
                </div>
    
                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full img-fluid"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>
    
                <button class="btn btn-secondary mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </button>
    
                @if ($this->user->profile_photo_path)
                    <button class="btn btn-secondary mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </button>
                @endif
    
                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif
    
        <!-- Name -->
        <div class="col-md-6 col-sm-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 form-control" wire:model="state.name" required autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>
    
        <!-- Email -->
        <div class="col-md-6 col-sm-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 form-control" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />
    
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}
    
                    <button type="button" class="btn btn-link underline text-sm text-gray-600 hover:text-gray-900 rounded-md" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>
    
                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-success">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>
    
    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('guan') }}
        </x-button>
    </x-slot>
</x-form-section>
