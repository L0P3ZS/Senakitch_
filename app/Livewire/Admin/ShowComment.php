<?php

namespace App\Livewire\Admin;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
class ShowComment extends Component
{
    use WithPagination;
    public $search;
    public $direction = "desc";
    // protected $paginationTheme = "bootstrap";

    public $openModal = false;
    public $titleModal = "Crear Comentario";
    public $btnModal = "Crear";
    public $description, $rating,$commentId;
    public $rules = ['description'=>'required','rating'=>'required'];

    public function render()
    {
      //->orderBy($this->ordenar,$this->direction)
        $comments = Comment::where('description', 'LIKE', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate(5);
        return view('livewire.admin.show-comments',compact('comments'));
    }
    public function destroyComment(Comment $comment){
        $comment->delete();
        $this->resetPage();
    }
    public function createOrUpdate(){
        $this->validate();
        $comment = ['description'=>$this->description,'rating'=>$this->rating,'user_id'=>Auth::user()->id]; 
        if($this->btnModal=="Crear"){ 
            Comment::create($comment); 
            $this->reset(['openModal','description','rating']); 
        }else{ 
            Comment::findOrFail($this->commentId)->update($comment);
            $this->reset(['openModal','description','rating','commentId']);  
        }
    }

    public function abrirModal(){
        $this->reset(['openModal','description','rating']);
        $this->openModal = true;
    }
    public function modalEdit(Comment $comment){
        $this->commentId = $comment->id;
        $this->description =$comment->description;
        $this->rating =$comment->rating;
    
         $this->titleModal = "Editar Comentario";
        $this->btnModal = "Actualizar";
         $this->openModal= true;
    }
    //reiniciar paginacion si se cambia la variable search
    public function updatingSearch(){
        $this->resetPage();
    }
  
}
