<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Distritosserv;
use App\Models\Distrito;
use App\Models\Grupo;

class Miscelanea extends Component
{
    public $servidores;

    // Rifa
    public $verModalConfigRifa = false;
    public $rifa = [
        'desde' => 1,
        'hasta' => 30,
        'totalPremiados' => 3,
        'disponibles' => [],
        'premiados' => [],
    ];

    public function mount()
    {
        // Servidores
        $this->servidores = Distritosserv::with(['Comite', 'Servicio'])
            ->where('IdDistrito', 100)
            ->get()
            ->sortBy(fn ($item) => $item->Comite->orden ?? 0)
            ->groupBy(fn ($item) => $item->Comite->id ?? 0)
            ->map(function ($grupo) {
                return $grupo->sortBy(fn ($item) => str_pad($item->Servicio->orden ?? 0, 3, '0', STR_PAD_LEFT) . '-' . ($item->servidor ?? ''));
            })
            ->filter(fn ($grupo) => $grupo->isNotEmpty());
    }

    public function inicializarRifa()
    {
        $this->rifa['disponibles'] = range($this->rifa['desde'], $this->rifa['hasta']);
        shuffle($this->rifa['disponibles']);
        $this->rifa['premiados'] = [];
    }

    // Abrir modal
    public function abrirModalRifa()
    {
        $this->verModalConfigRifa = true;
    }

    public function render()
    {
        return view('livewire.miscelanea.view', [
            'distritos' => Distrito::with('Mcd')->get(),
            'grupos'    => Grupo::all(),
        ]);
    }
}
