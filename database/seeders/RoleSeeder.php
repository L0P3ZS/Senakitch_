<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $AdminRol = Role::create(['name'=>'Admin']);
    $AprendizRol = Role::create(['name'=>'Aprendiz']);
    $UsuarioRol = Role::create(['name'=>'Usuario']);

       Permission::create(['name'=>'admin.home'])->syncRoles([$AdminRol,$AprendizRol]);
        //recipes
       Permission::create(['name'=>'admin.recipes.index'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.recipes.store'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.recipes.update'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.recipes.destroy'])->syncRoles([$AdminRol,$AprendizRol]);
        //products
       Permission::create(['name'=>'admin.products.index'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.products.store'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.products.update'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.products.destroy'])->syncRoles([$AdminRol,$AprendizRol]);
        //comments
       Permission::create(['name'=>'admin.comments.index'])->syncRoles($AdminRol);
       Permission::create(['name'=>'admin.comments.store'])->syncRoles($AdminRol);
       Permission::create(['name'=>'admin.comments.update'])->syncRoles($AdminRol);
       Permission::create(['name'=>'admin.comments.destroy'])->syncRoles($AdminRol);
        //users
       Permission::create(['name'=>'admin.users.index'])->syncRoles($AdminRol);
       Permission::create(['name'=>'admin.users.store'])->syncRoles($AdminRol);
       Permission::create(['name'=>'admin.users.update'])->syncRoles($AdminRol);
       Permission::create(['name'=>'admin.users.destroy'])->syncRoles($AdminRol);
        //menus
       Permission::create(['name'=>'admin.menus.index'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.menus.store'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.menus.update'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.menus.destroy'])->syncRoles([$AdminRol,$AprendizRol]);
        //categories
       Permission::create(['name'=>'admin.categories.index'])->syncRoles($AdminRol);
       Permission::create(['name'=>'admin.categories.store'])->syncRoles([$AdminRol]);
       Permission::create(['name'=>'admin.categories.update'])->syncRoles([$AdminRol]);
       Permission::create(['name'=>'admin.categories.destroy'])->syncRoles([$AdminRol]);

       Permission::create(['name'=>'admin.roles.index'])->syncRoles([$AdminRol]);
       Permission::create(['name'=>'admin.dashboard.index'])->syncRoles([$AdminRol]);
    } 
}

