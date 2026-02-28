<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\{ModelosPre, Modelo, Modelosmat, Util};
use Livewire\WithFileUploads;
use App\Traits\CrudModelosPre;
use App\Helpers\SweetAlert;

class ModelosPres extends Component
{
    use WithFileUploads, CrudModelosPre;

    public $verModalDuplicar = false;

    protected $listeners = ['modeloPreSelId' => 'actualizaIdModelo'];

    public function actualizaIdModelo($id)
    {
        if (!$id) return;
        $this->IdModeloPre = $id;
        $this->dispatch('presuElemActualizado');
    }
    public function render()
    {
        $modelopre = ModelosPre::find($this->IdModeloPre);
        return view('livewire.modelospres.view', compact('modelopre'));
    }

    public function edit($id)
    {
        $this->cargarDatos($id);
        $this->IdModeloPre = $id;
        $this->verModalModelopre = true;
    }

    public function save()
    {
        $this->validate([
            'IdColorPerfil' => 'required',
            'ancho' => 'required',
            'alto' => 'required',
        ]);
        $modelo = ModelosPre::findOrFail($this->IdModeloPre);
        $modelo->update([
            'ancho' => $this->ancho,
            'alto' => $this->alto,
            'IdColorPerfil' => $this->IdColorPerfil ? : null,
            'IdVidrio' => $this->IdVidrio ? : null,
            'IdColorVidrio' => $this->IdColorVidrio,
        ]);
        $this->dispatch('modeloPreActualizado');
        $this->verModalModelopre = false;
    }

    public function guardarEnMod()
    {
        if (!$this->IdModeloPre) return;
        $datos = \App\Services\Optims\Datos::generar($this->IdModeloPre);
        $procesador = new \App\Services\Optims\Procesador($datos);
        $procesador->ejecutar();
        $modeloPre = ModelosPre::with(['modelo.linea.marca', 'modelopremats'])->find($this->IdModeloPre);
        if (!$modeloPre) return;
        $modeloBase = $modeloPre->modelo;
        $marca = $modeloBase->linea->marca->marca;
        $pathOri = storage_path("app/public/modelospre/{$marca}/{$modeloPre->foto}");
        $pathDes = storage_path("app/public/modelos/{$marca}/{$modeloBase->modelo}.jpg");
        if (file_exists($pathOri)) {
            Util::copiarSiDif($pathOri, $pathDes);
            $modeloBase->update(['foto' => $modeloBase->modelo . '.jpg']);
        }
        Modelosmat::where('IdModelo', $modeloBase->id)->delete();
        foreach ($modeloPre->modelopremats as $row) {
            Modelosmat::create([
                'IdModelo' => $modeloBase->id,
                'IdMaterial' => $row->IdMaterial,
                'principal' => $row->principal,
                'cantidad' => $row->cantidad,
                'diferenciador' => $row->diferenciador,
                'IdTipo' => $row->IdTipo,
                'posicion' => $row->posicion,
                'formula' => $row->formula,
                'errFormula' => $row->errFormula,
                'dimensiones' => $row->dimensiones,
                'IdTablaHerraje' => $row->IdTablaHerraje,
                'cantidadHerraje' => $row->cantidadHerraje,
                'tipCosto' => $row->tipCosto,
                'costo' => $row->costo,
            ]);
        }
        $this->dispatch('sweetalert', SweetAlert::mensaje('✅ Modelo maestro actualizado!', 1500, 'success'));
    }
}