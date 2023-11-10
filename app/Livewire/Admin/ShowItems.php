<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination; //paginacion sin recargar pagina
class ShowItems extends Component
{
    use WithPagination;
    public $search;
    public $model;
    public $subItems = "";
    public $titleModal;
    public $modelName;
    public $fields;
    public $editItem = 'vaciar';

    public $cantidadRegistros = '5';
    public $openModal = false;
    protected $listeners = ['render'=>'render'];

    public function render()
    {
        $modelClass = ($this->model == "Role") ? "Spatie\Permission\Models\Role" : app("App\Models\\" . $this->model);
        $items =  $modelClass::where('name', 'LIKE', '%' . $this->search . '%')->paginate($this->cantidadRegistros);
    
        return view('livewire.admin.show-items', compact('items'));
    }
    public function CargarItems(){
        // $this->readyToLoad = true;
    }
    //reiniciar paginacion si se cambia la variable search
    public function updatingSearch(){
        $this->resetPage();
    }
    //functions modal no relativo
    public function editItemData($data){

        $this->editItem =$data;
        $this->openModal = true;
    }
    public function limpiarModal(){
        $this->editItem = 'vaciar';
        $this->openModal = true;
    }

    public function destroyItem($item)
    {
      
    }

     //functions modal si RELATIVO
     public function OpenModal(){
        
     }
}