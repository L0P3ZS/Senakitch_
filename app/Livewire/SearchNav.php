<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use App\Models\Recipe;
use App\Models\Product;
use App\Models\Menu;

class SearchNav extends Component
{
    public $search;

    public function render()
    {
        if(!$this->search == null){
            $recipeResults = Recipe::where('name', 'LIKE', '%' . $this->search . '%')->get();
            $productResults = Product::where('name', 'LIKE', '%' . $this->search . '%')->get();
            $menuResults = Menu::where('name', 'LIKE', '%' . $this->search . '%')->get();
            $items = [
                'Recipes' => $recipeResults,
                'Products' => $productResults,
                'Menus' => $menuResults,
            ];
        }else{
            $items = [];
        }

        return view('livewire.search-nav', compact('items'));
    }
}
