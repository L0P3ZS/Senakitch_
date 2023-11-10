<div>
    <x-danger-button wire:click="$set('openModal', true)">Modal Reactivo</x-danger-button>
    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            <h5 class="modal-title" id="myModal Label">{{ $editItem != 'vaciar' ? 'Actualizar ' . $titleModal : 'Crear' . $titleModal }}</h5>
        </x-slot>
        <x-slot name="content">

            @if(Auth::check())
            <form action="{{ $editItem !='vaciar' ? route('admin.' . $modelName . '.update',$editItem['id']) : route('admin.' . $modelName . '.store') }}"  method="POST" enctype="multipart/form-data">

                @csrf
                @if ($editItem != 'vaciar')
                    @method('PUT')
                @endif
                @foreach($fields as $field)
                    <x-label value="{{$field['name']}}"></x-label>
                    <div class="mb-4">
                        @switch($field['type'])
                            @case('textarea')
                                <textarea  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="" rows="3" ></textarea> 
                                @break
                            @case('file')
                                {{-- @if ($images)
                                    <img class="mb-4 " src="{{$images->temporaryUrl()}}" alt="" width="100px">
                                @endif
                                <input type="file" wire:model="images" id="{{$identificador}}"> --}}
                                @if ($editItem !='vaciar')
                                <div class="text-center">
                                    @if ($editItem[$field['name']] == null)
                                    <img src="{{$loopItem->profile_photo_url}}" alt="img" class="img-thumbnail imagen mx-auto" width="100">
                                    @else
                                    <img src="{{ asset('storage/' . $editItem[$field['name']]) }}" alt="img" class="img-thumbnail imagen mx-auto" width="100">
                                    @endif
                                </div>
                                @endif
                                <input   type="file" accept="image/*" value="{{ $editItem !='vaciar' ? $editItem[$field['name']] : old($field['name'])}}">
                                @break
                            @case('password')
                                <x-input  type="password"  class="w-full" ></x-input>
                                @break
                            @case('email')
                                <x-input type="email" class="w-full"></x-input>
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
                                    <span class="">$</span>
                                    <x-input  class="w-full" type="number" ></x-input>
                                @break
                            @default
                                <x-input   class="w-full" type="text"></x-input>    
                            @endswitch
                            {{-- <x-input-error for='{{$field['name']}}'></x-input-error> --}}
                            @error($field['name'])
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                @endforeach
                <x-slot name="footer"></x-slot>
            </form>
            @endif
            {{-- <div wire:loading wire:target="images" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen Cargando!</strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen se procece.</span>
              </div>
            <div class="mb-4">
                <x-label value="Nombre de Receta"></x-label>
                <x-input type="text" wire:model.live="name"></x-input>
                <x-input-error for='name'></x-input-error>
            </div>
            @if ($images)
                <img class="mb-4 " src="{{$images->temporaryUrl()}}" alt="" width="100px">
            @endif
            <div class="mb-4">
                <x-label value="Imagen de la Receta"></x-label>
                <input type="file" wire:model="images" id="{{$identificador}}">
                <x-input-error for='images'></x-input-error>
            </div>
            <div class="mb-4">
                <x-label value="Descripción de la Receta"></x-label>
                <textarea name="" class="form-control w-full" id="" rows="6" wire:model.live="description"></textarea>
                <x-input-error for='description'></x-input-error>
            </div>
            <div class="mb-4">
                <x-label value="Ingredientes de la Receta"></x-label>
                <textarea name="" class="form-control w-full" id="" rows="6" wire:model.live="ingredients"></textarea>
                <x-input-error for='ingredients'></x-input-error>
            </div>
            <div class="mb-4">
                <x-label value="Preparación de la Receta"></x-label>
                <textarea name="" class="form-control w-full" id="" rows="6" wire:model.live="preparation"></textarea>
                <x-input-error for='preparation'></x-input-error>
            </div> --}}

        </x-slot>
        <x-slot name="footer">
            <x-secondary-button  wire:click="$set('openModal', false)">Cancelar</x-secondary-button>
            <x-danger-button class="disabled:opacity-25" wire:loading.attr="disabled" wire:click="store()"  wire:target="save,images">{{ $editItem != 'vaciar' ? 'Actualizar' : 'Crear' }}</x-danger-button>


        </x-slot>
    </x-dialog-modal>
</div>
