<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Marca;
use App\Models\Linea;
use App\Models\Material;
use App\Models\Materialscosto;
use Illuminate\Support\Str;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Materialsarbol extends Component
{
    public $arbol = [], $expandido = [], $formData = [], $camposCrear = [];
    public $mostrarRaiz = true, $modalCrear = false, $modalEliminar = false, $keyWord,
        $tipoNodo, $IdPadre, $elementoSel, $nombreNuevo,  $nivel = 4;

    public $clases = [], $monedas = [], $barras = [], $panels = [], $tipos = [], $colorables = [];

    public function cargarArrays()
    {
        $this->clases = Util::getArray('clases');
        $this->colorables = Util::getArray('colorables');
        $this->monedas = Util::getArray('monedas');
        $this->barras = Util::getArray('barras', 'descripcion');
        $this->panels = Util::getArray('panels');
        $this->tipos = Util::getArray('tipos');
    }
    public function mount()
    {
        $this->cargarArbol();
        $this->cargarArrays();
    }
    public function updatedKeyWord()
    {
        $this->cargarArbol();
    }    
    public function cargarArbol()
    {
        $with = match ($this->nivel) {
            1 => [], // solo marcas
            2 => ['lineas'],
            3 => ['lineas.materials'],
            4 => ['lineas.materials.materialscostos'],
            default => throw new \InvalidArgumentException("Nivel inválido: {$this->nivel}")
        };
        $marcas = Marca::with($with)->get();
        if (!empty($this->keyWord)) {
            $keyW = Str::lower($this->keyWord);
            $marcas = $marcas->map(fn($marca) => $this->filtrarMarca($marca, $keyW))->filter();
        }
        $this->arbol = $marcas;
    }

    private function filtrarMarca($marca, $keyW)
    {
        if ($this->nivel >= 2) {
            $marca->lineas = $marca->lineas
                ->map(fn($linea) => $this->filtrarLinea($linea, $keyW))
                ->filter();
        }
        $marcaCoincide = Str::contains(Str::lower($marca->marca), $keyW)
            || ($this->nivel >= 2 && $marca->lineas->isNotEmpty());

        if ($marcaCoincide) $this->expandido['Marca'][$marca->id] = true;
        return $marcaCoincide ? $marca : null;
    }

    private function filtrarLinea($linea, $keyW)
    {
        if ($this->nivel >= 3) {
            $linea->materials = $linea->materials
                ->map(fn($material) => $this->filtrarMaterial($material, $keyW))
                ->filter();
        }
        $lineaCoincide = Str::contains(Str::lower($linea->linea), $keyW)
            || ($this->nivel >= 3 && $linea->materials->isNotEmpty());

        if ($lineaCoincide) $this->expandido['Linea'][$linea->id] = true;
        return $lineaCoincide ? $linea : null;
    }

    private function filtrarMaterial($material, $keyW)
    {
        $materialCoincide = Str::contains(Str::lower($material->material), $keyW)
            || Str::contains(Str::lower((string) $material->referencia), $keyW);
        if ($this->nivel >= 4) {
            $costosFiltrados = $material->Materialscostos
                ->filter(fn($costo) => Str::contains(Str::lower((string) $costo->referencia), $keyW))
                ->values();
            $material->setRelation('Materialscostos', $costosFiltrados);
            $materialCoincide = $materialCoincide || $costosFiltrados->isNotEmpty();
        }
        if ($materialCoincide) {
            $this->expandido['Material'][$material->id] = true;
            return $material;
        }
        return null;
    }

    public function abrirCrear($tipoCrear, $IdPadre = null)
    {
        $this->modalCrear = true;
        $this->tipoNodo = $tipoCrear;
        $this->IdPadre = $IdPadre;
        $this->formData = [];
        switch ($tipoCrear) {
            case 'Marca':
                $this->camposCrear = [
                    'marca' => ['label' => 'Nombre de la Marca', 'visible' => true],
                ];
                break;

            case 'Linea':
                $this->camposCrear = [
                    'linea'   => ['label' => 'Nombre de la Línea', 'visible' => true],
                    'IdColorablePerfil'  => [
                        'label'   => 'Grupo de Colores',
                        'visible' => true,
                        'type'    => 'select',
                        'options' => $this->colorables,
                    ],
                    'IdMarca' => ['label' => 'IdMarca', 'visible' => false],
                ];
                $this->formData['IdMarca'] = $IdPadre;
                break;
            case 'Material':
                $this->camposCrear = [
                    'material' => [
                        'label'   => 'Nombre del Material',
                        'visible' => true,
                        'type'    => 'text',
                    ],
                    'IdClase'  => [
                        'label'   => 'Clase',
                        'visible' => true,
                        'type'    => 'select',
                        'options' => $this->clases,
                    ],
                    'IdTipo'  => [
                        'label'   => 'Tipo de Perfil',
                        'visible' => true,
                        'type'    => 'select',
                        'options' => $this->tipos,
                    ],
                    'IdLinea'  => [
                        'label'   => 'IdLinea',
                        'visible' => false,
                        'type'    => 'hidden',
                    ],
                ];
                $this->formData['IdLinea'] = $IdPadre;
                break;
            case 'Materialscosto':
                $material = Material::find($this->IdPadre);
                $IdColorable = null;
                if ($material) {
                    if ($material->IdClase == 1) {
                        $IdColorable = $material->Linea->IdColorablePerfil;
                    }
                    if ($material->IdClase == 2) {
                        $IdColorable = 4;
                    }
                    if ($material->IdClase == 3) {
                        $IdColorable = 5;
                    }
                }
                $colors = DB::table('colors')
                    ->where('IdColorable', $IdColorable)
                    ->pluck('color', 'id');
                $this->camposCrear = [
                    'referencia'  => ['label' => 'Referencia', 'visible' => true],
                    'costo'       => ['label' => 'Costo', 'visible' => true],
                    'IdMoneda'  => [
                        'label'   => 'Moneda',
                        'visible' => true,
                        'type'    => 'select',
                        'options' => $this->monedas,
                    ],
                    'IdColor'  => [
                        'label'   => 'Color',
                        'visible' => true,
                        'type'    => 'select',
                        'options' => $colors,
                    ],
                    'IdBarra'  => [
                        'label'   => 'Barra',
                        'visible' => true,
                        'type'    => 'select',
                        'options' => $this->barras,
                    ],
                    'IdPanel'  => [
                        'label'   => 'Panel',
                        'visible' => true,
                        'type'    => 'select',
                        'options' => $this->panels,
                    ],
                    'IdMaterial'  => ['label' => 'IdMaterial', 'visible' => false],
                ];
                $this->formData['IdMaterial'] = $IdPadre;
                $this->formData['costo'] = 0;
                break;
        }
    }

    public function guardarElemento()
    {
        switch ($this->tipoNodo) {
            case 'Marca':
                Marca::create($this->formData);
                break;
            case 'Linea':
                Linea::create($this->formData);
                break;
            case 'Material':
                Material::create([
                    'material' => $this->formData['material'],
                    'IdLinea' => $this->formData['IdLinea'],
                    'IdClase' => $this->formData['IdClase'],
                    'IdTipo' => $this->formData['IdClase'],
                    'IdUnidad' => 1,
                ]);
                break;
            case 'Materialscosto':
                Materialscosto::create($this->formData);
                break;
        }
        $this->modalCrear = false;
        $this->cargarArbol();
    }

    public function abrirEliminar($tipo, $id)
    {
        $this->modalEliminar = true;
        $this->tipoNodo = $tipo;
        $this->elementoSel = $id;
    }

    public function eliminarElemento()
    {
        match ($this->tipoNodo) {
            'Marca' => Marca::find($this->elementoSel)?->delete(),
            'Linea' => Linea::find($this->elementoSel)?->delete(),
            'Material' => Material::find($this->elementoSel)?->delete(),
            'Materialscosto' => Materialscosto::find($this->elementoSel)?->delete(),
        };

        $this->modalEliminar = false;
        $this->cargarArbol();
    }

    public function toggleNodo($tipo, $id)
    {
        $this->expandido[$tipo][$id] = !($this->expandido[$tipo][$id] ?? false);
    }

    public function agregar($tipo, $id)
    {
        $evento = 'agregar' . $tipo;
        $this->dispatch($evento, $id);
        $this->cargarArbol();
    }

    public function resetBusqueda()
    {
        $this->keyWord = '';
        $this->expandido = [];
        $this->cargarArbol();
    }
    public function render()
    {
        return view('livewire.materialsarbol.view');
    }
}
