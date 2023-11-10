<div>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <div class="card">
        <div class="card-header">
            <x-button class="btn btn-success"><a href="{{route('exportProduct')}}">Exportar</a></x-button>
            <x-button class="btn btn-info">Importar</x-button>
            

        </div>
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
            <x-danger-button wire:click="limpiarModal()">Agregar</x-danger-button>
            {{-- @livewire('admin.form-item',['fields' => $fields]) --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($items))
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                @foreach ($fields as $field)
                                    <th class=" cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{$field['name']}}</th>
                                @endforeach
                                <th colspan="2"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($items as $loopItem)
                            <tr >
                                @foreach ($fields as $field)
                                <td class="px-6 py-6">
                            
                                    @switch($field['type'])
                                        {{-- @case('textarea')
                                            @break  --}}
                                        @case('file')
                                                {{--el primer if esta para todos los items aunque deberia ser limitado solo para los usuarios que no tengan imagen--}}
                                                @if ($loopItem[$field['name']] == null)
                                                    <img src="{{$loopItem->profile_photo_url}}" alt="{{$loopItem[$field['name']] }}" class=" h-13 w-16 object-cover imagen" width="60">
                                                @elseif(strpos($loopItem[$field['name']], 'http') === 0)
                                                        <img src="{{$loopItem[$field['name']]}}" alt="{{$loopItem[$field['name']] }}" class="h-13 w-16 object-cover imagen" width="60">
                                                @elseif (file_exists(public_path('storage/' . $loopItem[$field['name']])))
                                                        <img src="{{ asset('storage/' . $loopItem[$field['name']]) }}" alt="{{ $loopItem[$field['name']] }}" class=" h-13 w-16 object-cover imagen" width="60">
                                                @endif
                                            @break
                                        @case('number')
                                        $ {{ $loopItem[$field['name']] }}
                                            @break
                                        @default
                                        {{ $loopItem[$field['name']] }}
                                    @endswitch
                                </td>
                                @endforeach
                                <td class="px-6 py-6 ext-sm font-medium flex">
                                    <button  wire:click="editItemData({{$loopItem}})" class="font-bold text-white py-2 px-4 rounded cursor-pointer bg-red-600 hover:bg-red-500">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                 
                                    <form action="{{route('admin.' . $modelName . '.destroy',$loopItem)}}" method="post" style="display: inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="ml-2 font-bold text-white py-2 px-4 rounded cursor-pointer bg-red-600 hover:bg-red-500"><i class="fas fa-trash"></i></button>
                                    </form> 
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{-- si tiene al menos dos paginas se mostrata si no se oculta --}}
                    @if ($items->hasPages())
                        <div class="px-6 py-3">
                            {{$items->links()}}
                        </div>
                    @endif
                @else
                    <div class="px-6 py-4">
                        No Existe ese item  en nuestros registros
                    </div>
                @endif
            </div>

        </div>
        <div class="card-footer">
            {{-- {{$users->links()}} --}}
        </div>
    </div>





   {{-- MODAL --}}
   <x-dialog-modal wire:model="openModal">
        <div class="modal-content">
            <x-slot name="title">     
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModal Label">{{ $editItem != 'vaciar' ? 'Actualizar ' . $titleModal : 'Crear ' . $titleModal }}</h5>
                    </div>
            </x-slot>
            <x-slot name="content">
                <div class="modal-body">

                    @if(Auth::check())
                    <form action="{{ $editItem !='vaciar' ? route('admin.' . $modelName . '.update',$editItem['id']) : route('admin.' . $modelName . '.store') }}"  method="POST" enctype="multipart/form-data">

                        @csrf
                        @if ($editItem != 'vaciar')
                            @method('PUT')
                        @endif
                        @foreach($fields as $field)
                        <label for="{{$field['name']}}">{{$field['name']}}</label>
                        <div class="form-group">
                            @switch($field['type'])

                                @case('textarea')
                                    <textarea rows="2" cols="50" class="form-control" placeholder="{{$field['name']}}" name="{{$field['name']}}">{{ $editItem !='vaciar' ? $editItem[$field['name']] : old($field['name'])}}</textarea>
                                    @error($field['name'])
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    @break
                                @case('file')
                                    @if ($editItem !='vaciar')
                                    <div class="text-center">
                                        @if ($editItem[$field['name']] == null)
                                        <img src="{{$loopItem->profile_photo_url}}" alt="img" class="img-thumbnail imagen mx-auto" width="100">
                                        @else
                                        <img src="{{ asset('storage/' . $editItem[$field['name']]) }}" alt="img" class="img-thumbnail imagen mx-auto" width="100">
                                        @endif
                                    </div>
                                    @endif
                                    <input class="form-control" name="{{$field['name']}}" type="file" accept="image/*" value="{{ $editItem !='vaciar' ? $editItem[$field['name']] : old($field['name'])}}">
                                    @break
                                @case('password')
                                    <input class="form-control"type="password" >
                                    @break
                                @case('email')
                                    <input class="form-control" name="{{$field['name']}}" type="email" placeholder="{{$field['name']}}" value="{{ $editItem !='vaciar' ? $editItem[$field['name']] : old($field['name'])}}">
                                    @break
                                @case('select')
                                    @if($subItems != "")
                                    <select class="form-control" name="{{$field['name']}}">
                                            @foreach ($subItems as $subItem)
                                                <option value="{{$subItem}}">{{$subItem}}</option>

                                            @endforeach
                                        </select>
                                    @endif
                                    @break
                                @case('number')
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">$</span>
                                            <input class="form-control" name="{{$field['name']}}" type="number" placeholder="0" min="0" value="{{ $editItem !='vaciar' ? $editItem[$field['name']] : old($field['name'])}}">
                                        </div>
                                    </div>
                                    @break
                                @default

                                    <input  class="form-control" name="{{$field['name']}}" type="text" placeholder="{{$field['name']}}" value="{{ $editItem !='vaciar' ? $editItem[$field['name']] : old($field['name'])}}" >
                                    @error($field['name'])
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                            @endswitch
                        </div>
                        @endforeach

                        <div class="modal-footer">
                            <x-secondary-button  wire:click="$set('openModal', false)">Cancelar</x-secondary-button>
                            <x-danger-button type="submit">{{ $editItem != 'vaciar' ? 'Actualizar' : 'Crear' }}</x-danger-button>
                        </div>
                        <x-slot name="footer"></x-slot>
                    </form>
                    @endif
                </div>
            </x-slot>
        </div>
    </x-dialog-modal>


    

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('deleteItem',ItemId =>{

            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })
        })
    </script>
</div>
