{{-- <x-admin.admin-modal
 id="myModal" title="Gestion de Receta" 
 :fields='[
  ["name" => "name", "type" => "text"],
  ["name" => "images", "type" => "file"],
  ["name" => "description", "type" => "textarea"],
  ["name" => "ingredients", "type" => "textarea"],
  ["name" => "preparation", "type" => "textarea"],
]'
 modelName="recipes">

</x-admin.admin-modal>
 --}}


<x-layouts.admin >
    <x-slot name="title">Lista de Recetas</x-slot>
    {{-- @livewire('crud', ['fields' => [
      ["name" => "name", "type" => "text"],
      ["name" => "images", "type" => "file"],
      ["name" => "ingredients", "type" => "textarea"],
      ["name" => "description", "type" => "textarea"],
      ["name" => "preparation", "type" => "textarea"],
      ["name" => "category", "type" => "select"],
    ], 
    'items' => $recipes, 
    'titleModal' => "Receta",
    'modelName' => "recipes",
    // 'subItems'=> $categories,
    ]) --}}
    {{-- @livewire('admin.show-items', ['fields' => [
     ["name" => "name", "type" => "text"],
      ["name" => "images", "type" => "file"],
      ["name" => "ingredients", "type" => "textarea"],
      ["name" => "description", "type" => "textarea"],
      ["name" => "preparation", "type" => "textarea"],
      // ["name" => "category", "type" => "select"],
],  'titleModal' => "Receta",'model'=>'Recipe','modelName' => "recipes"])  --}}

    @livewire('admin.recipe.show-recipes')  
</x-layouts.admin>
