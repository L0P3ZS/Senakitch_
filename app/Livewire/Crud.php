<?php

namespace App\Livewire;

use Livewire\Component;
use Mockery\Undefined;


class Crud extends Component
{
    public $items;
    public $subItems = "";
    public $titleModal;
    public $modelName;
    public $fields;
    public $editItem = 'vaciar';
    public $open = false;

    public function render()
    {
        return view('livewire.crud');
    }

    public function editItemData($data){

        $this->editItem =$data;
        $this->open = true;
    }
    public function limpiarModal(){
        $this->editItem = 'vaciar';
        $this->open = true;
    }
}
