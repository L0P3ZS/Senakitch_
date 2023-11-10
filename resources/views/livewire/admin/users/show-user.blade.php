<div>
 @vite(['resources/css/app.css', 'resources/js/app.js'])
 @livewireStyles
 <div class="card">
    <div class="px-6 py-4 flex items-center">
        <div class="flex items-center">
            <span>mostrar</span>
            <select wire:model.live="cantidadRegistros"   class="mx-2  border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                <option value="10">5</option>
                <option value="10">10</option>
            </select>
            <span>entradas</span>
        </div>
        <x-input type="text" class="flex-1 mx-4" wire:model.live="search" placeholder="Buscar"/>
        <x-danger-button wire:click="abrirModal()">Crear Usuario</x-danger-button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if ($users->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" wire:click="order('description')" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Avatar</th>
                            <th scope="col" wire:click="order('name')" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th scope="col" wire:click="order('email')" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gmail</th>
                            <th scope="col" wire:click="order('description')" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                            <th colspan="2"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($users as $user)
                            <tr >
                                <td class="px-6 py-6" >
                                    @if ($user['profile_photo_path'] == null)
                                        <img src="{{$user->profile_photo_url}}" alt="" class="h-13 w-16 object-cover imagen" width="60">
                                    @elseif(strpos($user->profile_photo_path, 'http') === 0)
                                            <img src="{{$user->profile_photo_path}}" class=" h-13 w-16 object-cover imagen"width="60">
                                    @elseif (file_exists(public_path('storage/' . $user->profile_photo_path)))
                                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}"  class="h-13 w-16 object-cover  imagen" width="60">
                                    @endif
                                </td>
                                <td class="px-6 py-6">{{$user->name}}</td>
                                <td class="px-6 py-6">{{$user->email}}</td>
                                <td class="px-6 py-6">
                                    @foreach ($user["roles"] as $rol) 
                                       {{$rol->name}}
                                    @endforeach
                                </td>
                                
                                <td class="px-6 py-6 flex items-center">
                                    <button class="ml-2 font-bold text-white py-2 px-4 rounded cursor-pointer " style="background-color: #16a34a;" wire:click="modalEdit({{$user}})" >  
                                        <i class="fas fa-pencil-alt"></i>
                                    </button> 
                                    <button onclick="alert('error')" wire:click="destroyUser({{$user}})" class="ml-2 font-bold text-white py-2 px-4 rounded cursor-pointer"  style="background-color:#ef4444">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                 {{-- si tiene al menos dos paginas se mostrata si no se oculta --}}
                 @if ($users->hasPages())
                 <div class="px-6 py-3">
                     {{$users->links()}}
                 </div>
             @endif
            @else
            <div class="px-6 py-4">
                No Existe el  Usuario
            </div>
            @endif
        </div>
    </div>
 </div>

    {{-- MODAL --}}
    <x-dialog-modal class="" wire:model="openModal">
        <x-slot name="title">
            {{$titleModal}} 
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                @if ( $btnModal === "Crear")
                <x-label value="Avatar"></x-label>
                {{-- @if ($btnModal==="Actualizar")
                    <div class="text-center">
                        <img src="{{$profile_photo_path}}" alt="img" class="img-thumbnail imagen mx-auto" width="100">
                    </div>
                @endif --}}
                <x-input class="w-full" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm " type="file" wire:model="profile_photo_path"></x-input>
                <x-input-error for='profile_photo_path'></x-input-error>

                <x-label value="Nombre"></x-label>
                <x-input class="w-full" type="text" wire:model="name"></x-input>
                <x-input-error for='name'></x-input-error>
                
                <x-label value="Email"></x-label>
                <x-input class="w-full" type="email" wire:model="email"></x-input>
                
                <x-input-error for='email'></x-input-error>
                    <x-label value="Contraseña"></x-label>
                    <x-input class="w-full" type="password" wire:model="password"></x-input>
                    <x-input-error for='password'></x-input-error>  
                @endif

                <x-label value="Rol"></x-label>
                <select class="form-control" name="rol" wire:model="rol">
                    @foreach ($roles as $rolOption)
                        <option value="{{ $rolOption->name }}" {{ $rolOption->name == $rol ? 'selected' : '' }}>
                            {{ $rolOption->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error for='rol'></x-input-error>
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-secondary-button  wire:click="$set('openModal', false)">Cancelar</x-secondary-button>
            <x-danger-button onclick="alert('success')" wire:loading.remove wire:click="createOrUpdate()">{{$btnModal}}</x-danger-button>
            <span  wire:loading wire:target="createOrUpdate()">cargando ...</span>
        </x-slot>
    </x-dialog-modal>

    <script>
        function alert(type) {
          switch (type) {
              case 'success':
                  toastr.success('El Usuario fue Guardada con éxito');
                  break;
              case 'error':
                  toastr.error('El Usuario fue eliminada con éxito');
                  break;
              default:
                  break;
          }
      }
      </script>
</div>
