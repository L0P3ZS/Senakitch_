
<x-layouts.admin >
  {{-- <x-admin.admin-modal
   id="myModal" title="Gestion de Producto" 
   :fields='[
    ["name" => "name", "type" => "text"],
    ["name" => "image", "type" => "file"],
    ["name" => "description", "type" => "textarea"],
    ["name" => "price", "type" => "number"],
  ]'
   modelName="products">
  
  </x-admin.admin-modal> --}}
    <x-slot name="title">Lista de Productos</x-slot>
    {{-- @livewire('crud', ['fields' => [
      ["name" => "name", "type" => "text"],
      ["name" => "image", "type" => "file"],
      ["name" => "description", "type" => "textarea"],
      ["name" => "price", "type" => "number"],
  ], 'items' => $products, 'titleModal' => "Producto", 'modelName' => "products"]) --}}

{{-- component reactivo --}}
{{-- @livewire('admin.show-items', ['fields' => [
  ["name" => "name", "type" => "text"],
  ["name" => "image", "type" => "file"],
  ["name" => "description", "type" => "textarea"],
  ["name" => "price", "type" => "number"],
],  'titleModal' => "Producto",'model'=>'Product','modelName' => "products"]) --}}
    @livewire('admin.show-products')  
 
   
</x-layouts.admin>
