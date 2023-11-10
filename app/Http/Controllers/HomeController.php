<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Recipe;

class HomeController extends Controller
{

    public function index(){
        $recipes = Recipe::take(3)->get();
        $products = Product::take(5)->get();
        $menus = Menu::take(6)->get();
        $comments =Comment::take(3)->get();
        return view('home.index',compact('recipes','products','menus','comments'));
    }

    public function menu(){
        return view('home.menu');
    }

    public function opiniones(){
        return view('home.opiniones');
    }

    public function productos(){

     $productos =Product::all();
     return view('home.product',compact('productos'));

    }

   //Recestas
     public function recetas(){
         $recetas = Recipe::all();
         return view('home.recetas',compact('recetas'));
     }
     public function ver(Recipe $recetas)
     {
         // $recetas = Recetas::findOrfail($id);
        
        return view('home.verRecetas',compact('recetas'));
     }


    // Nosotros
    public function nosotros(){
        return view('home.nosotros');
    }
    
    //Formulario para susbir recetas
    public function formulario()
    {
        return view('home.subirRecetas');
    }

    //Perfil de usuario
    public function prueba(){
        return view('home.prueba');
    }

    public function crud(){
        return view('home.crud');
    }

    public function init(){
        return view('auth.login');
    }
}






