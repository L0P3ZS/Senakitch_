<div>
    <div class="card">
        <div class="card-header">
            <x-button wire:click="exportar()" class="btn btn-success">Exportar</x-button>
            {{-- <x-button class="btn btn-info">Importar</x-button> --}}
        </div>
        <div class="px-6 py-4 flex items-center">
            <x-input type="text" class="flex-1 mr-4" wire:model.live="search" placeholder="Buscar"/>
            <x-danger-button wire:click="abrirModal()">Crear Menu</x-danger-button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($menus->isEmpty())
                    <div class="px-6 py-4">
                        @if ($this->search)
                            No Existe el Menu
                        @else
                            Usted no tiene menús creados actualmente <b> pero puedes crear uno ahora.</b>
                        @endif
                    </div>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                <th scope="col"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Imagen</th>
                                <th scope="col"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Precio</th>
                                <th colspan="2"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($menus as $menu)
                                <tr >
                                    <td class="px-6 py-6">{{$menu->name}}</td>
                                    <td class="px-6 py-6" >
                                        @if ($menu['image_path'] )
                                             {{-- si no tien / usa images si no storage --}}
                                                @if (strpos($menu->image_path, '/') === false)
                                                    <img src="/images/{{ $menu->image_path }}" alt="" class="h-13 w-16 object-cover  imagen" width="60">
                                                @else
                                                    <img src="{{ asset('storage/' . $menu->image_path) }}" alt="" class="h-13 w-16 object-cover  imagen" width="60">
                                                @endif
                                           
                                        @endif
                                    </td>
                                    <td class="px-6 py-6">{{"$ " . $menu->price . " COP"}}</td>
                    
                                    <td class="px-6 py-6 flex items-center">
                                        <button class="ml-2 font-bold text-white py-2 px-4 rounded cursor-pointer " style="background-color: #16a34a;" wire:click="modalEdit({{$menu}})" >  
                                            <i class="fas fa-pencil-alt"></i>
                                        </button> 
                                        <button onclick="alert('error')" wire:click="destroyMenu({{$menu}})" class="ml-2 font-bold text-white py-2 px-4 rounded cursor-pointer" style="background-color:#ef4444">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- si tiene al menos dos paginas se mostrata si no se oculta --}}
                    @if ($menus->hasPages())
                        <div class="px-6 py-3">
                            {{$menus->links()}}
                        </div>
                    @endif
                @endif
            </div>
        </div>
     </div>
    
{{-- Modal --}}
<x-dialog-modal wire:model="openModal">
    <x-slot name="title">
        {{$titleModal}}
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            @if ($image_path)
                @if ($btnModal === "Actualizar" )
                     {{-- si no tien / usa images si no storage --}}
                    @if (strpos($menu->image_path, '/') === false)
                        <img class="mb-4 img-thumbnail imagen mx-auto" src="/images/{{ $menu->image_path }}" alt="img" width="100px">
                    @else
                        <img class="mb-4 img-thumbnail imagen mx-auto" src="{{asset('storage/' . $image_path)}}" alt="img" width="100px">
                    @endif
                @endif
                @if ($image_path && is_object($image_path))
                    <img class="mb-4 img-thumbnail imagen mx-auto" src="{{$image_path->temporaryUrl()}}" alt="" width="100px"> 
                @endif
            @endif
            <x-label value="Imagen del Menu"></x-label>
            <input type="file" wire:model="image_path" id="{{$identificador}}">
            <x-input-error for='image_path'></x-input-error>
        </div>
        <div class="mb-4">
            <x-label value="Nombre del  Menu"></x-label>
            <x-input class="w-full" type="text"
            wire:model="name"></x-input>
            <x-input-error for='name'></x-input-error>
        </div>
       
     
        <div class="mb-4">
            <x-label value="Precio del Menu"></x-label>
            <x-input class="w-full" type="number" 
            wire:model="price"></x-input>
            <x-input-error for='price'></x-input-error>
        </div>
  

    </x-slot>
    <x-slot name="footer">
        <x-secondary-button  wire:click="$set('openModal', false)">Cancelar</x-secondary-button>
        <x-danger-button onclick="alert('success')" class="disabled:opacity-25" wire:loading.attr="disabled" wire:click="createOrUpdate()"  wire:target=" createOrUpdate,image_path">{{$btnModal}}</x-danger-button>
    </x-slot>
</x-dialog-modal>
    
<script>
    function alert(type) {
      switch (type) {
          case 'success':
              toastr.success('El Menu fue Guardado con éxito');
              break;
          case 'error':
              toastr.error('El Menu fue eliminado con éxito');
              break;
          default:
              break;
      }
  }
  </script>
    
</div>
