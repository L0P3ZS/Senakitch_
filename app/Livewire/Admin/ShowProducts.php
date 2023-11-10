<?php

namespace App\Livewire\Admin;

use App\Exports\ProductExport;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
class ShowProducts extends Component
{
    use WithPagination;
    use WithFileUploads; 
    public $search;
    public $openModal = false;
    public $name, $price,$description,$image,$identificador,$productId;
    public $titleModal = "Crear Producto", $btnModal = "Crear";
    public $alert;
    public $rules = [
        'name'=> 'required',
        'image'=> 'required|image|mimes:png,jpg|max:2048',
        'description'=> 'required',
        'price' =>'numeric|required',
        // 'category' => 'required',
    ];
    private $resetVariables = ['openModal','name','image','price','description','btnModal','titleModal'];
    public function mount(){
        $this->identificador = rand(); //le asigna un numero al azar o random
    }
    public function render()
    {
        if (auth()->user()->hasRole('Admin')) {
            $products = Product::where('name', 'LIKE', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate(5);
        }
        elseif (auth()->user()->hasRole('Aprendiz')) {
            $products = Product::where('user_id', auth()->user()->id)
                          ->where(function ($query) {
                              $query->where('name', 'LIKE', '%' . $this->search . '%');
                          })
                          ->orderBy('id', 'desc')
                          ->paginate(5);
        }
        return view('livewire.admin.show-products', compact('products'));
    }
    public function abrirModal(){
        $this->reset($this->resetVariables);
        $this->identificador = rand(); //le asigna un numero al azar o random (se hace para que input file cambie y no ponga el anterior)
        $this->openModal = true;
    }

    public function createOrUpdate(){
        $product = [
            'name'=>$this->name,
            'image'=>"",
            'description'=>$this->description,
            'price'=>$this->price,
            'user_id'=>""
        ];
        if($this->btnModal=="Crear"){ 
            $this->validate();
            $image = $this->image->store('products'); // Cargar la imagen al crear
            $product['image'] = $image;
            $product['user_id'] =Auth::user()->id;
            Product::create($product);
            $this->reset($this->resetVariables);
            $this->identificador = rand(); //le asigna un numero al azar o random (se hace para que input file cambie y no ponga el anterior)
            $this->alert = ['type'=>'success','message'=>'no se q poner'];
        }
        elseif($this->btnModal=="Actualizar") { 
            $productEdit = Product::find($this->productId);
            if($productEdit) {
             // Verificar si se proporcionó una nueva imagen
                if (is_string($this->image)) {
                    $image = $productEdit->image; // Mantener la imagen existente
                } else {
                    Storage::disk('public')->delete($productEdit->image); // Eliminar la imagen antigua
                    $image = $this->image->store('products'); // Almacenar la nueva imagen
                }
                $product['user_id'] = $productEdit->user_id;
                $product['image'] = $image; // Actualizar el valor de la imagen en el arreglo $recipe
                $productEdit->update($product);
                $this->reset($this->resetVariables);
                $this->identificador = rand(); 
            }
        }
    }

    public function destroyProduct(Product $product) {
        //eliminar imagen
        if($product->image){Storage::disk('public')->delete($product->image);}
        $product->delete();
        $this->resetPage();
        $this->alert = ['type'=>'info','message'=>'no se delete'];
    }
    public function modalEdit(Product $product){
        $this->productId = $product->id;
        $this->description =$product->description;
        $this->name =$product->name;
        $this->price =$product->price;
        $this->image =$product->image;
    
         $this->titleModal = "Editar Producto";
        $this->btnModal = "Actualizar";
         $this->openModal= true;
    }
    //reiniciar paginacion si se cambia la variable search
    public function updatingSearch(){
        $this->resetPage();
    }


    public function exportar(){
        $productsExport = new ProductExport;
        return $productsExport->download('products.xlsx');
    }
}
