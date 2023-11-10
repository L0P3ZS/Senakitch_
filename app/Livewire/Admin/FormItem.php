<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class FormItem extends Component
{
    public $openModal = false, $fields,
    $modelName = "products";
    public $editItem = "vaciar"; 
    public $titleModal = "Item";
    
    public function store(){
        $this->validate();
        Comment::create(['description'=>$this->description,'rating'=>$this->ranting,'user_id'=>Auth::user()->id]);
        $this->reset(['open','description','ranting']);
        // emitir
        $this->dispatch('render')->to(ShowComment::class);

    }
    public function render()
    {
        return view('livewire.admin.form-item');
    }
}
