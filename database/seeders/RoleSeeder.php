<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $role1 = Role::create(['name' => 'SuperAdmin']);
        $role2 = Role::create(['name' => 'Gerente']);
        $role3 = Role::create(['name' => 'Tecnico']);
        $role4 = Role::create(['name' => 'Operador']);
        $role5 = Role::create(['name' => 'User']);

        Permission::create(['name' => 'user'])
            ->syncRoles([$role1, $role2, $role3, $role4, $role5]);           
        Permission::create(['name' => 'adminMax'])
            ->syncRoles([$role1, $role2]); // Solo SuperAdmin y Admin
        Permission::create(['name' => 'admin'])
            ->syncRoles([$role1, $role2, $role3]); // Solo SuperAdmin y Admin            
        Permission::create(['name' => 'borrarNormal'])
            ->syncRoles([$role1, $role2, $role3]); //Operadores, poca responsabilidad
    }
}
