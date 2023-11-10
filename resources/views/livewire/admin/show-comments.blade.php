<div>

    <link rel="stylesheet" href="{{ asset('css/shared/opinion.css')}}"> 
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
        <x-danger-button wire:click="abrirModal()">Crear Comentario</x-danger-button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if ($comments->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase text-center">Mensaje</th>
                            <th scope="col"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase text-center">Calificación</th>
                            <th colspan="2"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($comments as $comment)
                        <tr >
                            <td class="px-6 py-6">{{$comment->description}}</td>
                           
                            <td class="px-6 py-6 text-center">
                                @for($i=1; $i<=$comment->rating; $i++)
                                    <label for="star{{$i}}" class="star-label"><i class="fas fa-star"></i></label>
                                @endfor 
                            </td> 
                            <td class="px-6 py-6 flex items-center">
                                <button class="ml-2 font-bold text-white py-2 px-4 rounded cursor-pointer " style="background-color: #16a34a;" wire:click="modalEdit({{$comment}})" >  
                                    <i class="fas fa-pencil-alt"></i>
                                </button> 
                                <button onclick="alert('error')" wire:click="destroyComment({{$comment}})" class="ml-2 font-bold text-white py-2 px-4 rounded cursor-pointer" style="background-color:#ef4444">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                 {{-- si tiene al menos dos paginas se mostrata si no se oculta --}}
                 @if ($comments->hasPages())
                 <div class="px-6 py-3">
                     {{$comments->links()}}
                 </div>
             @endif
            @else
            <div class="px-6 py-4">
                No Existe el  Comentario
            </div>
            @endif
        </div>
    </div>
 </div>

    {{-- MODAL --}}
    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            {{$titleModal}} 
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Comentario"></x-label>
                <textarea name="" class="form-control w-full" id="" rows="6" wire:model.live="description"></textarea>
                <x-input-error for='description'></x-input-error>
                <x-label class="py-3" value="Calificación"></x-label>
                
                <div class=" star-rating">
                    <input type="radio" wire:model="rating" id="star5" name="rating" value="5">
                    <label for="star5"></label>
                    <input type="radio" wire:model="rating" id="star4" name="rating" value="4">
                    <label for="star4"></label>
                    <input type="radio" wire:model="rating" id="star3" name="rating" value="3">
                    <label for="star3"></label>
                    <input type="radio" wire:model="rating" id="star2" name="rating" value="2">
                    <label for="star2"></label>
                    <input type="radio" wire:model="rating" id="star1" name="rating" value="1">
                    <label for="star1"></label>
                </div>
                <x-input-error for='ranting'></x-input-error>

            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button  wire:click="$set('openModal', false)">Cancelar</x-secondary-button>
            <x-danger-button onclick="alert('success')" wire:loading.remove wire:click="createOrUpdate()">{{$btnModal}}</x-danger-button>
            <span wire:loading wire:target="createOrUpdate()">cargando ...</span>
        </x-slot>
    </x-dialog-modal>

    <script>
        function alert(type) {
          switch (type) {
              case 'success':
                  toastr.success('El COmentario fue Guardada con éxito');
                  break;
              case 'error':
                  toastr.error('El Comentario fue eliminada con éxito');
                  break;
              default:
                  break;
          }
      }
      </script>
</div> 


