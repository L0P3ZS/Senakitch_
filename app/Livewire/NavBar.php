<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Recipe;
use Livewire\Component;

class NavBar extends Component
{
    public $search;
    public function render()
    {
        $items = Comment::where('description', 'LIKE', '%' . $this->search . '%')
            // ->orWhereHasMorph('searchable', [Menu::class, Product::class,Recipe::class], function ($query) {
            //     $query->where('name', 'LIKE', '%' . $this->search . '%');
            //         // ->orWhere('content', 'LIKE', '%' . $this->search . '%');
            // })
            ->paginate(2);

        return view('livewire.nav-bar',compact('items'));
    }
}
