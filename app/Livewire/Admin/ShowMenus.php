<?php

namespace App\Livewire\Admin;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
class ShowMenus extends Component
{
    use WithPagination;
    use WithFileUploads; 
    public $search;
    public $openModal = false;
    public $name, $image_path,$price, $identificador,$menuId;
    public $titleModal = "Crear Menu", $btnModal = "Crear";
    public $rules = [
        'name'=> 'required',
        'image_path'=> 'required|image|mimes:png,jpg|max:2048',
        'price' =>'numeric|required',
        // 'category' => 'required',
    ];

    private $resetVariables = ['openModal','name','image_path','price','btnModal','titleModal'];

    public function mount(){
        $this->identificador = rand(); //le asigna un numero al azar o random
    }

    public function render()
    {
        if (auth()->user()->hasRole('Admin')) {
            $menus = Menu::where('name', 'LIKE', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate(5);
        } elseif (auth()->user()->hasRole('Aprendiz')) {
            $menus = Menu::where('user_id', auth()->user()->id)->orderBy('id', 'desc')
                          ->where(function ($query) {
                              $query->where('name', 'LIKE', '%' . $this->search . '%');
                          })
                          ->paginate(5);
        }
        return view('livewire.admin.show-menus',compact('menus'));
    }
    public function abrirModal(){
        $this->reset($this->resetVariables);
        $this->identificador = rand(); //le asigna un numero al azar o random (se hace para que input file cambie y no ponga el anterior)
        $this->openModal = true;
    }

    public function createOrUpdate(){
        $menu = [
            'name'=>$this->name,
            'image_path'=>"",
            'price'=>$this->price,
            'user_id'=> ""
        ];
        if($this->btnModal=="Crear"){ 
            $this->validate();
            $image_path = $this->image_path->store('Menus'); // Cargar la imagen al crear
            $menu['image_path'] = $image_path;
            $menu['user_id'] =Auth::user()->id;
            Menu::create($menu);
            $this->reset($this->resetVariables);
            $this->identificador = rand(); //le asigna un numero al azar o random (se hace para que input file cambie y no ponga el anterior)
        }
        elseif ($this->btnModal == "Actualizar") { 
            $menuEdit = Menu::find($this->menuId); 
            if ($menuEdit) {
                // Verificar si se proporcionó una nueva imagen
                if (is_string($this->image_path)) {
                    $image_path = $menuEdit->image_path; // Mantener la imagen existente
                } else {
                    Storage::disk('public')->delete($menuEdit->image_path); // Eliminar la imagen antigua
                    $image_path = $this->image_path->store('Menus'); // Almacenar la nueva imagen
                }
                $menu['user_id'] = $menuEdit->user_id;
                $menu['image_path'] = $image_path; // Actualizar el valor de la imagen en el arreglo $menu
                $menuEdit->update($menu);
                $this->reset($this->resetVariables);
                $this->identificador = rand(); 
            }
        }
    }

    


    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    public function destroyMenu(Menu $menu) {
        //eliminar imagen
        if($menu->image_path){Storage::disk('public')->delete($menu->image_path);}
        $menu->delete();
        $this->resetPage();
      
    }
    public function modalEdit(Menu $menu){
        $this->menuId = $menu->id;
        $this->name =$menu->name;
        $this->price =$menu->price;
        $this->image_path =$menu->image_path;
        $this->titleModal = "Editar Menu";
        $this->btnModal = "Actualizar";
        $this->openModal= true;
    }
      //reiniciar paginacion si se cambia la variable search
    public function updatingSearch(){
        $this->resetPage();
    }

    public function exportar(){
    //     $menusExport = new MenuExport;
    //     return $menusExport->download('menus.xlsx');
     }
}
