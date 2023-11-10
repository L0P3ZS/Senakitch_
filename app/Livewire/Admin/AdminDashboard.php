<?php

namespace App\Livewire\Admin;

use App\Models\Comment;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\User;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $userCantidad,$productCantidad,$menuCantidad,$commentCantidad,$recipeCantidad;
    public function mount()
    {
        $this->userCantidad = User::count();
        $this->productCantidad = Product::count();
        $this->commentCantidad = Comment::count();
        $this->recipeCantidad = Recipe::count();
        $this->menuCantidad = Menu::count();
    }
    public function render()
    {

        return view('livewire.admin.admin-dashboard');
    }
}
