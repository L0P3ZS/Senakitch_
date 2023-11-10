<x-layouts.admin >
    <x-slot name="title">Lista de Menus</x-slot>
    {{-- @livewire('crud', ['fields' => [
      ["name" => "name", "type" => "text"],
      ["name" => "image_path", "type" => "file"],
      ["name" => "price", "type" => "number"],
    //   ["name" => "shipping_cost", "type" => "number"],
  ], 'items' => $menus, 'titleModal' => "Menu", 'modelName' => "menus"])
     --}}
    {{-- @livewire('admin.show-items', ['fields' => [
      ["name" => "name", "type" => "text"],
      ["name" => "image_path", "type" => "file"],
      ["name" => "price", "type" => "number"],
    //   ["name" => "shipping_cost", "type" => "number"],
  ], 'model' => 'Menu', 'titleModal' => "Menu", 'modelName' => "menus"])
     --}}
     @livewire('admin.show-menus')  
</x-layouts.admin>