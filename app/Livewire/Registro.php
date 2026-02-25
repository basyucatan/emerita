<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class Registro extends Component
{
    public $name;
    public $telefono;

    public function render()
    {
        return view('livewire.registro.view');
    }



    public function save()
    {
        $this->validate([
            'name'     => 'required|string|min:3',
            'telefono' => 'required|string|unique:users|min:10',
        ]);
        $user = User::create([
            'name'     => $this->name,
            'telefono' => $this->telefono,
            'email'    => 'temp@gmail.com',
            'password' => Hash::make('temp'),
            'activo'   => true,
            'IdDepto'  => 4,
        ]);

        $nombre = strtolower(explode(' ', trim($this->name))[0]);
        $email = $nombre . $user->id . '@gmail.com';
        
        $idTxt = str_pad($user->id, 5, '0', STR_PAD_LEFT); // Generar password juan00001
        $passPlano = $nombre . $idTxt;
        $passFinal = $passPlano;
        do {
            $hash = Hash::make($passFinal);
            $existe = User::where('password', $hash)->exists();
            if ($existe) {
                $passFinal = $passPlano . chr(rand(65, 90)); // A-Z
            }
        } while ($existe);
        $user->update([
            'email'    => $email,
            'password' => $hash,
        ]);
        $user->assignRole('User');
        $user->givePermissionTo('user');
        $this->reset();
        $msg = '✅ Usuario registrado, tu contraseña será: '.$passFinal
            .' consérvalo seguro, este mensaje desparecerá a los 30 segundos';
        session()->flash('message', $msg);
    }

}
