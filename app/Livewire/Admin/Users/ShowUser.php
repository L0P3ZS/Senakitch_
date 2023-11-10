<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination; //paginacion sin recargar pagina
use Spatie\Permission\Models\Role;

class ShowUser extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search;
    public $openModal = false;
    public $titleModal = "Crear Usuario";
    public $btnModal = "Crear";

    public $name,$email,$password,$rol,$profile_photo_path,$userId;
    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'rol' => 'required',
        'profile_photo_path' => 'required|mimes:png,jpg'
        ];
    public function render()
    {
        $users =  User::where('name', 'LIKE', '%' . $this->search . '%')->orderBy('id', 'desc')->orWhere('email', 'LIKE', '%' . $this->search . '%')->with('roles:name')->paginate(5);
        $roles = Role::all();
        return view('livewire.admin.users.show-user',compact('users','roles'));
    }

    public function createOrUpdate(){
        if($this->btnModal=="Crear"){ 
            $this->validate();
            $this->profile_photo_path = $this->profile_photo_path->store('profile-photos');
            $this->password= Hash::make($this->password);
                $user = User::create(['name'=>$this->name,'email'=>$this->email,'password'=>$this->password,'profile_photo_path'=>$this->profile_photo_path]);
                $rol = Role::where('name', $this->rol)->first(); // Obtener el rol por nombre
                if ($rol) {
                    $user->roles()->attach($rol->id); // Asociar el ID del rol al usuario
                    $this->reset(['openModal','name','email','password','rol','profile_photo_path','userId','btnModal','titleModal']); 
                }
        }
        elseif($this->btnModal=="Actualizar") { 
            $user = User::findOrFail($this->userId); // Obtener el usuario existente por su ID
            $rol = Role::where('name', $this->rol)->first(); // Obtener el rol por nombre
            $user->roles()->sync([$rol->id]); // Actualizar los roles del usuario
            $this->reset(['openModal', 'name', 'email', 'password', 'rol', 'profile_photo_path', 'userId', 'btnModal', 'titleModal']);
        }
    }
    public function destroyUser(User $user){
        //eliminar imagen
        if($user->profile_photo_path){
            Storage::disk('public')->delete($user->profile_photo_path);
        }
        $user->delete();
            $this->resetPage();
    }

    public function modalEdit(User $user){
        $this->userId = $user->id;
        $this->name=$user->name;
        $this->email=$user->email;
        $this->password=$user->password;
        $this->profile_photo_path = $user->profile_photo_url;
        foreach ($user["roles"] as $rol) {
            $this->rol =$rol->name;
        }
        $this->titleModal = "Editar a" . " " . $user->name;
        $this->btnModal = "Actualizar";
        $this->openModal= true;
    }
    public function abrirModal(){
        $this->reset(['openModal','name','email','password','rol','profile_photo_path','btnModal','titleModal']);
        $this->openModal = true;
    }
    //reiniciar paginacion si se cambia la variable search
    public function updatingSearch(){
        $this->resetPage();
    }
  

}
