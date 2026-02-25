<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Distrito;
use App\Models\Grupo;
use Illuminate\Support\Collection;

class Arboldistritos extends Component
{
    public $arbol = [];
    public $expand = [];
    public $mostrarRaiz = true;
    public $keyWord = '';

    public function mount()
    {
        $this->cargarArbol();
    }

    public function cargarArbol()
    {
        $this->arbol = $this->crearConsulta()->toArray();
        $this->expand = [];
    }
    public function borrarKeyWord()
    {
        $this->keyWord = '';
        $this->cargarArbol();
    }

    protected function crearConsulta(): Collection
    {
        $query = Distrito::query()
            ->with(['grupos' => function ($q) {
                $q->where('tipo', 'Grupo') // 👈 filtro clave
                ->orderBy('grupo', 'asc');

                if ($this->keyWord) {
                    $kw = "%{$this->keyWord}%";

                    $q->where(function ($sub) use ($kw) {
                        $sub->where('grupo', 'like', $kw)
                            ->orWhere('direccion', 'like', $kw)
                            ->orWhere('localidad', 'like', $kw);
                    });
                }
            }])
            ->orderBy('orden', 'asc');

        if ($this->keyWord) {
            $kw = "%{$this->keyWord}%";

            $query->where(function ($q) use ($kw) {
                $q->where('distrito', 'like', $kw)
                ->orWhereHas('grupos', function ($sub) use ($kw) {
                    $sub->where('tipo', 'Grupo') // 👈 mismo filtro aquí
                        ->where(function ($s) use ($kw) {
                            $s->where('grupo', 'like', $kw)
                                ->orWhere('direccion', 'like', $kw)
                                ->orWhere('localidad', 'like', $kw);
                        });
                });
            });
        }
        return $query->get();
    }

    public function updatedKeyWord()
    {
        $this->cargarArbol();
        $this->expandirTodo();
    }

    protected function expandirTodo()
    {
        foreach ($this->arbol as $dist) {
            $this->expand['Distrito'][$dist['id']] = true;

            if (!empty($dist['grupos'])) {
                foreach ($dist['grupos'] as $grp) {
                    $this->expand['Grupo'][$grp['id']] = true;
                }
            }
        }
    }

    public function toggle($tipo, $id)
    {
        $this->expand[$tipo][$id] = !($this->expand[$tipo][$id] ?? false);
        $this->dispatch('IdPadreElecto', $tipo, $id);
    }

    public function elegir($tipo, $id)
    {
        $grupo = Grupo::find($id);
        $this->toggle('xd',$grupo->IdDistrito);
        if ($grupo) {
            $this->dispatch(
                'msgBox',
                titulo: $grupo->grupo,
                contenido:
                    ($grupo->direccion ?? 'Sin dirección') . ', ' .
                    ($grupo->localidad ?? '') .
                    ' | RSG: ' . ($grupo->rsgCorto ?? '')
            );
        }
    }

    public function render()
    {
        return view('livewire.arboldistritos.view');
    }
}
