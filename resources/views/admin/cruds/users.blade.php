
<x-layouts.admin >
  <x-slot name="title">Lista de usuarios</x-slot>

{{-- 
   @livewire('crud', ['fields' => [
     ["name" => "profile_photo_path", "type" => "file"],
    ["name" => "name", "type" => "text"],
    ["name" => "email", "type" => "email"],
    // ["name" => "roles", "type" => "text"]
], 
 'items' => $users,
 'titleModal' => "Usuario",
 'modelName' => "users"]
 )   --}}
{{-- {{json_encode($users)}}
 @livewire('admin.show-items', ['fields' => [
     ["name" => "profile_photo_path", "type" => "file"],
    ["name" => "name", "type" => "text"],
    ["name" => "email", "type" => "email"],
],  'titleModal' => "Usuario",'model'=>'User','modelName' => "users"]) --}}
@livewire('admin.users.show-user')

</x-layouts.admin>
