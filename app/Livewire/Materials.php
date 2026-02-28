<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Material;
use App\Models\Util;
use Livewire\WithFileUploads;

class Materials extends Component
{
    use WithPagination;
	use WithFileUploads;

	protected $paginationTheme = 'bootstrap';
    public $verModalMaterial=false, $selected_id, $keyWord, $IdClase, $IdUnidad, $fotoSubida,
		$IdLinea, $Linea, $IdTipo, $referencia, $material, $materialObj, $foto, 
		$tipos, $unidads, $existente,
		$rendimiento, $KgxMetro, $IdUnidadRend, $anchoLama;

    public $fotoUrl, $fotoSubidaUrl, $rutaFoto;

	protected $listeners = [
		'cargarMaterial' => 'cargarMaterial',
		'materialSelId' => 'cargarMaterial',
	];

    public function cargarMaterial($id)
    {
        $material = Material::findOrFail($id);
        $this->selected_id = $id;
        $this->fill($material->toArray());
        $this->Linea = \App\Models\Linea::find($this->IdLinea);
        $this->anchoLama = $material->adicionales['anchoLama'] ?? null;
        $this->fotoUrl = $material->foto
            ? asset('storage/' . $material->rutaFoto . '/' . mb_convert_encoding($material->foto, 'UTF-8', 'UTF-8'))
            : null;
        $this->dispatch('cargarMaterialCostos');
    }

	public function render()
	{
		$this->selected_id ?? $this->cargarMaterial(1);
		$this->unidads ??= Util::getArray('unidads');
		$this->tipos ??= Util::getArray('tipos');		
		$materials = Material::where('id',$this->selected_id)->first();
		$this->materialObj = $materials;
		return view('livewire.materials.view', compact('materials'));
	}
	
    public function cancel()
    {
        $this->resetinput();
        $this->verModalMaterial = false;
    }

    public function resetInput()
    {
    }
	public function edit()
	{
        $this->fotoSubida = null;
        $this->fotoSubidaUrl = null;         
		$this->verModalMaterial = true;
	}
    public function updatedFotoSubida()
    {
        $this->fotoSubidaUrl = $this->fotoSubida->temporaryUrl();
    }
    public function create()
    {
        $this->resetinput();
        $this->verModalMaterial = true;
    }   

    public function save()
    {
        $this->validate([
            'IdClase' => 'required',
            'IdLinea' => 'required',
            'IdUnidad' => 'required',
            'material' => 'required',
            'IdTipo' => 'required_if:IdClase,1',
            'fotoSubida' => 'nullable|image|max:10240',
        ]);
        $archivoFoto = $this->foto;
        $this->Linea = \App\Models\Linea::find($this->IdLinea);
        $marcaNombre = $this->Linea->Marca->marca ?? 'generico';
        $this->rutaFoto = "materiales/" . strtolower(mb_convert_encoding($marcaNombre, 'UTF-8', 'UTF-8'));
        if ($this->fotoSubida) {
            if ($this->selected_id) {
                Util::borrarArchivo($this->selected_id, Material::class, $this->rutaFoto);
            }
            $archivoFoto = Util::guardarFoto($this->fotoSubida, $this->material, $this->rutaFoto);
        }
        $adicionales = [
            'anchoLama' => $this->anchoLama
        ];
        $material = Material::updateOrCreate(
            ['id' => $this->selected_id],
            [
                'IdClase' => $this->IdClase,
                'IdLinea' => $this->IdLinea,
                'IdUnidad' => $this->IdUnidad,
                'IdTipo' => $this->IdTipo ?: null,
                'referencia' => $this->referencia,
                'material' => $this->material,
                'foto' => $archivoFoto,
                'KgxMetro' => $this->KgxMetro ?: null,
                'rendimiento' => $this->rendimiento ?: null,
                'IdUnidadRend' => $this->IdUnidadRend ?: null,
                'adicionales' => $adicionales,
            ]
        );
        $this->foto = $archivoFoto;
        $this->fotoUrl = asset('storage/' . $this->rutaFoto . '/' . mb_convert_encoding($archivoFoto, 'UTF-8', 'UTF-8'));
        $this->fotoSubida = null;
        $this->verModalMaterial = false;
        $this->dispatch('cargarMaterialCostos');
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Material::find($id);
            if ($record) {
                Util::borrarArchivo($id, Material::class, $record->rutaFoto, 'foto');
                $record->delete();
            }
        }
    }
}