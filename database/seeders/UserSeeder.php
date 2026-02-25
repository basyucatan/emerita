<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{    
    public function run()
    {
        $deptos = array(
        array('id' => '1','depto' => 'Compras'),
        array('id' => '2','depto' => 'AlmacénPre'),
        array('id' => '3','depto' => 'AlmacénMP'),
        array('id' => '4','depto' => 'Retales'),
        array('id' => '5','depto' => 'Corte'),
        array('id' => '6','depto' => 'Ensamble'),
        array('id' => '7','depto' => 'AlmacénPT'),
        array('id' => '8','depto' => 'Instalación'),
        array('id' => '9','depto' => 'Entregas'),
        array('id' => '10','depto' => 'Administración'),
        );
        DB::table('deptos')->insert($deptos);    

        User::create(['name'=>'Basilio', 'email'=>'basilio_hh@hotmail.com','telefono'=>'9991','password'=>Hash::make('1234'), 'activo'=>true, 'IdDepto' => 10,
        ])->assignRole('SuperAdmin'); 
        User::create(['name'=>'Gerente', 'email'=>'gerente@gmail.com','telefono'=>'9992','password'=>Hash::make('ABCD'), 'activo'=>true, 'IdDepto' => 10,
        ])->assignRole('Gerente');    
        User::create(['name'=>'Tecnico', 'email'=>'tecnico@gmail.com','telefono'=>'9993','password'=>Hash::make('4321'), 'activo'=>true, 'IdDepto' => 10,
        ])->assignRole('Tecnico');  
        User::create(['name'=>'Marla', 'email'=>'marla@gmail.com','telefono'=>'9994','password'=>Hash::make('4321'), 'activo'=>true, 'IdDepto' => 10,
        ])->assignRole('Tecnico');         
        User::create(['name'=>'User', 'email'=>'user@gmail.com','telefono'=>'9995','password'=>Hash::make('4321'), 'activo'=>true, 'IdDepto' => 10,
        ])->assignRole('User');                      
    }
}
