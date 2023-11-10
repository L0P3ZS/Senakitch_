<x-layouts.admin >
  {{-- <x-admin.admin-modal
   title="Gestion de Categoria" 
   :fields='[
    ["name" => "name", "type" => "text"],
    ["name" => "type", "type" => "select"],
  ]'
   modelName="categories">
  
  </x-admin.admin-modal>
    <x-slot name="title">Lista de Categorias</x-slot>
    
      <x-admin.admin-table :items="$categories"  :columns="['name', 'type']" modelName="categories"/> --}}
</x-layouts.admin>
