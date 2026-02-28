<?php

namespace App\Traits;
use App\Models\{Presupuesto, ModelosPre, Modelo, Modelopremat, Util};
use Illuminate\Support\Facades\{DB, Storage};
trait CrudModelosPre
{
    public $verModalPresuelem = false, $verModalModelopre = false, $verModalDivisiones = false;
    public $selected_id, $keyWord, $IdPresupuesto, $consecutivo, $IdColorable, 
        $IdColorPerfil, $IdVidrio, $IdColorVidrio;
    public $IdModelo, $IdModeloPre, $IdDivision, $cantidad, $tipo, $foto, $ancho, $alto, 
        $direccion, $porRecargo, $IdLamina, $IdGuia;
    public $descripcion, $ubicacion, $precioU, $precioManual, $actualizado, $divisiones;
    public $colorPerfils = [], $vidrios = [], $colorVidrios = [], $tipos = [], 
        $laminas = [], $guias = [], $direcciones = [];

    public function cargarDatos($id)
    {
        $record = ModelosPre::findOrFail($id);
        $this->IdModeloPre = $id;
        $this->IdDivision = $record->Modelo->Linea->IdDivision;
        $this->selected_id = $id;
        $this->fill($record->only([
            'IdVidrio', 'IdColorVidrio', 'IdColorPerfil', 'IdModelo', 'cantidad', 
            'IdLamina', 'IdGuia', 'foto', 'tipo', 'ancho', 'alto', 'direccion', 
            'descripcion', 'ubicacion', 'precioU', 'porRecargo', 'precioManual',
            'actualizado'
        ]));
        $this->cargaArrays();
    }
    
    public function save()
    {
        $this->validate([
            'IdPresupuesto' => 'required',
            'IdModelo' => 'required',
            'cantidad' => 'required',
            'tipo' => 'required',
            'ancho' => 'required',
            'alto' => 'required',
            'descripcion' => 'required',
            'ubicacion' => 'required',
        ]);
        $this->porRecargo = floatval($this->porRecargo ?? 0);
        $recalcular = false;
        $nuevoPrecioU = $this->precioU;
        $costeo = null;
        if ($this->selected_id && $old = ModelosPre::find($this->selected_id)) {
            $this->consecutivo = $old->consecutivo;
            if (floatval($old->porRecargo) != $this->porRecargo) {
                $margen = DB::table('negocios')->where('id', 1)->value('margenUtilidad') ?? 0;
                $costeo = $old->costeo ?? null;
                if ($costeo && isset($costeo['costoMat'])) {
                    $costoU = floatval($old->costoU);
                    $indirectos = $costoU * ($this->porRecargo / 100);
                    $costeo['indirectos'] = $indirectos;
                    $nuevoPrecioU = round(($costoU + $indirectos) * (1 + $margen / 100) * 1.16, 2);
                    $recalcular = true;
                }
            }
        }
        if (!$this->selected_id) {
            $max = ModelosPre::where('IdPresupuesto', $this->IdPresupuesto)->max('consecutivo');
            $this->consecutivo = $max ? $max + 1 : 1;
        }
        $modeloPre = ModelosPre::updateOrCreate(
            ['id' => $this->selected_id],
            [
                'IdPresupuesto' => $this->IdPresupuesto,
                'consecutivo' => $this->consecutivo,
                'IdColorPerfil' => $this->IdColorPerfil,
                'IdVidrio' => $this->IdVidrio ? : null,
                'IdColorVidrio' => $this->IdColorVidrio ? : null,
                'IdModelo' => $this->IdModelo,
                'IdLamina' => $this->IdLamina,
                'IdGuia' => $this->IdGuia,
                'cantidad' => $this->cantidad,
                'tipo' => $this->tipo,
                'ancho' => $this->ancho,
                'alto' => $this->alto,
                'direccion' => $this->direccion !== '' ? $this->direccion : null,
                'descripcion' => $this->descripcion,
                'ubicacion' => $this->ubicacion,
                'precioU' => $recalcular ? $nuevoPrecioU : $this->precioU,
                'costeo' => $recalcular ? $costeo : ($old->costeo ?? null),
                'porRecargo' => $this->porRecargo,
                'precioManual' => $this->precioManual ? : false,
                'actualizado' => $this->actualizado ? : false,
            ]
        );
        if (!$this->selected_id) {
            $this->crearMats($modeloPre->id);
        }
        $this->verModalPresuelem = false;
        $this->verModalModelopre = false;
        $this->resetInput();
        $this->ordenarRegistros($this->IdPresupuesto);
    }

    private function crearMats($id)
    {
        $modeloPre = ModelosPre::find($id);
        $modeloBase = Modelo::findOrFail($modeloPre->IdModelo);
        $marca = $modeloBase->Linea->Marca->marca ?? 'sin_marca';
        if ($modeloBase->foto) {
            $origen = 'public/modelos/' . $marca . '/' . $modeloBase->foto;
            $nuevoNombre = $id . '-' . $modeloBase->foto;
            $destino = 'public/modelospre/' . $marca . '/' . $nuevoNombre;
            if (Storage::exists($origen)) {
                Storage::copy($origen, $destino);
                $modeloPre->update(['foto' => $nuevoNombre]);
            }
        }
        foreach ($modeloBase->modelosmats as $mat) {
            Modelopremat::create([
                'IdModeloPre' => $modeloPre->id,
                'principal' => $mat->principal,
                'cantidad' => $mat->cantidad,
                'IdMaterial' => $mat->IdMaterial,
                'diferenciador' => $mat->diferenciador,
                'IdTipo' => $mat->IdTipo,
                'posicion' => $mat->posicion,
                'IdTablaHerraje' => $mat->IdTablaHerraje,
                'cantidadHerraje' => $mat->cantidadHerraje,
                'formula' => $mat->formula,
                'errFormula' => $mat->errFormula,
            ]);
        }
        $this->dispatch('modeloPreSelId', $modeloPre->id);
    }
    public function activaManual($intencional)
    {
        $this->precioManual = !$this->precioManual;
        if ($intencional) {
            $this->precioManual = true;
            $this->actualizado = true;
        }
    }
    public function activaObsoleto()
    {
        $this->actualizado = false;
        if ($this->precioManual) $this->actualizado = true;
    }
    public function ordenarRegistros($idPresupuesto)
    {
        $items = ModelosPre::where('IdPresupuesto', $idPresupuesto)->orderBy('id')->get();
        foreach ($items as $index => $item) {
            $item->update(['consecutivo' => $index + 1]);
        }
    }
    public function calculaDescripcion()
    {
        $modelo = Modelo::find($this->IdModelo);
        $partes = [];
        if ($this->tipo) $partes[] = $this->tipo;
        if ($modelo?->Linea?->colorable) $partes[] = 'de ' . $modelo->Linea->Colorable->colorable;
        if ($modelo?->Linea?->linea) $partes[] = $modelo->Linea->linea;
        $this->descripcion = implode(' ', $partes);
    }
    public function cargaArrays()
    {
        $this->tipos = Util::getArray('modelospre', 'tipo');
        $this->laminas = Util::getArray('laminas', 'codigo');
        $this->guias = Util::getArray('guias');
        $this->direcciones = Util::getArray('modelospre', 'direccion');
        if(!$this->IdModeloPre){
            $record = Presupuesto::findOrFail($this->IdPresupuesto);
            $IdColorable = $record->ColorPerfil->IdColorable ?? 2;
        } else {
            $record = ModelosPre::findOrFail($this->IdModeloPre);
            $IdColorable = $record->Presupuesto->ColorPerfil->IdColorable ?? 2;
        }
        $this->colorPerfils = DB::table('colors')->where('IdColorable', $IdColorable)->pluck('color', 'id');
        $this->vidrios = DB::table('vidrios')->select(DB::raw("id, CONCAT(vidrio, ' ', ROUND(grosor, 0), 'mm') as vidriomm"))->orderBy('vidriomm')->pluck('vidriomm', 'id')->toArray();
        $this->colorVidrios = DB::table('colors')->where('IdColorable', 4)->pluck('color', 'id');
    }
    public function resetInput()
    {
        $this->resetExcept('IdModelo', 'colorPerfils', 'IdModeloPre',
            'tipos', 'vidrios', 'direcciones', 'colorVidrios', 'IdPresupuesto');
    }
    public function cancel()
    {
        $this->resetInput();
        $this->verModalPresuelem = false;
        $this->verModalDivisiones = false;
    }
}