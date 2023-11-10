<x-layouts.admin>
    <x-slot name="title">Dashboard</x-slot>
    {{-- @livewire('crud', ['fields' => [
      ["name" => "description", "type" => "textarea"],
  ], 'items' => $comments, 'titleModal' => "Comentario", 'modelName' => "comments"])
     --}}

    @livewire('admin.admin-dashboard')
</x-layouts.admin>