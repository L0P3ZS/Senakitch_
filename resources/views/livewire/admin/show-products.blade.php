<div>
    @if ($alert != null)
    <script>
        (function() {
            toastr.error('mensaje');
        })();
    </script>
    @endif 
   
    <div class="card">
        <div class="card-header">
            <x-button wire:click="exportar()" class="btn btn-success">Exportar</x-button>
            {{-- <x-button class="btn btn-info">Importar</x-button> --}}
        </div>
        <div class="px-6 py-4 flex items-center">
            <x-input type="text" class="flex-1 mr-4" wire:model.live="search" placeholder="Buscar"/>
            <x-danger-button wire:click="abrirModal()">Crear Receta</x-danger-button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($products->isEmpty())
                <div class="px-6 py-4">
                    @if ($this->search)
                    No Existe el Producto
                    @else
                            Usted no tiene Productos creados actualmente <b> pero puedes crear uno ahora.</b>
                        @endif
                    </div>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                <th scope="col"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Imagen</th>
                                <th scope="col"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
                                <th scope="col"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Precio</th>
                                <th colspan="2"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($products as $product)
                                <tr >
                                    <td class="px-6 py-6">{{$product->name}}</td>
                                    <td class="px-6 py-6" >
                                        @if ($product['image'] )
                                          <img src="{{ asset('storage/' . $product->image) }}"  class="h-13 w-16 object-cover  imagen" width="60">
                                        @endif
                                    </td>
                                    <td class="px-6 py-6">{{$product->description}}</td>
                                    <td class="px-6 py-6">{{"$ " . $product->price . " COP"}}</td>
                    
                                    <td class="px-6 py-6 flex items-center">
                                        <button class="ml-2 font-bold text-white py-2 px-4 rounded cursor-pointer " style="background-color: #16a34a;" wire:click="modalEdit({{$product}})" >  
                                            <i class="fas fa-pencil-alt"></i>
                                        </button> 
                                        <button onclick="alert('error')" wire:click="destroyProduct({{$product}})" class="ml-2 font-bold text-white py-2 px-4 rounded cursor-pointer" style="background-color:#ef4444">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {{-- si tiene al menos dos paginas se mostrata si no se oculta --}}
                        @if ($products->hasPages())
                           <div class="px-6 py-3">
                               {{$products->links()}}
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
            @if ($image)
                @if ($btnModal === "Actualizar" )
                    <img class="mb-4 img-thumbnail imagen mx-auto" src="{{asset('storage/' . $image)}}" alt="img" width="100px">
                @endif
                @if ($image && is_object($image))
                    <img class="mb-4 img-thumbnail imagen mx-auto" src="{{$image->temporaryUrl()}}" alt="" width="100px"> 
                @endif
            @endif
            <x-label value="Imagen del Producto"></x-label>
            <input type="file" wire:model="image" id="{{$identificador}}">
            <x-input-error for='image'></x-input-error>
        </div>
        <div class="mb-4">
            <x-label value="Nombre del Producto"></x-label>
            <x-input class="w-full" type="text"
            wire:model="name"></x-input>
            <x-input-error for='name'></x-input-error>
        </div>
       
        <div class="mb-4">
            <x-label value="Descripción del Producto"></x-label>
            <textarea name="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" id="" rows="2" wire:model="description"></textarea>
            <x-input-error for='description'></x-input-error>
        </div>
        <div class="mb-4">
            <x-label value="Precio del Producto"></x-label>
            <x-input class="w-full" type="number" 
            wire:model="price"></x-input>
            <x-input-error for='price'></x-input-error>
        </div>
  

    </x-slot>
    <x-slot name="footer">
        <x-secondary-button  wire:click="$set('openModal', false)">Cancelar</x-secondary-button>
        <x-danger-button onclick="alert('success')" class="disabled:opacity-25" wire:loading.attr="disabled" wire:click="createOrUpdate()"  wire:target=" createOrUpdate,image">{{$btnModal}}</x-danger-button>
    </x-slot>
</x-dialog-modal>

<script>
  function alert(type) {
    switch (type) {
        case 'success':
            toastr.success('El producto fue Guardado con éxito');
            break;
        case 'error':
            toastr.error('El producto fue eliminado con éxito');
            break;
        default:
            break;
    }
}
</script>
   
























</div>
