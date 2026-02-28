<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ModelosPre;
use App\Models\Modelopremat;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;

class Modelopremats extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalModelopremat=false, $selected_id, $keyWord, $IdModeloPre,
		$IdTablaHerraje=null, $cantidadHerraje=1, $IdLineaPref=null, $presupuesto,
		$IdMaterialCosto, $principal, $cantidad, $IdMaterial, $material, $diferenciador, 
		$IdTipo, $posicion, $formula, $errFormula, $dimensiones, $costo, $tipCosto, 
		$obs, $adicionales, $estatusPre;
	public $costoMat=0;

	public $modelos=[], $materials=[], $tipos=[], $lineas=[], $tablas=[], 
		$modelosMatsArray = [];
    protected $listeners = [
        'modeloPreSelId' => 'modeloPreSelId', 
        'modeloPreActualizado' => 'calculaDep', 
        'nuevoMaterial' => 'nuevoMaterial', 
		'cargarModelo' => 'nuevoModelo',
    ];
    public function nuevoMaterial($id)
    {
        $this->IdMaterial = (int) $id;
        $this->create();
    }	
	public function mount(){
		$this->cargarArrays();
	}
	public function modeloPreSelId($id){
		$this->IdModeloPre = $id;
		$this->estatusPre = ModelosPre::find($id)?->presupuesto->estatus;
		if ($this->estatusPre == 'edicion'){
			$this->calculaDep();
		}
		$this->cargarArrays();
	} 
    #[Computed]
	public function filteredModelopremats()
	{
		$keyWord = '%' . $this->keyWord . '%';
		if(!$this->estatusPre){
			$this->estatusPre = ModelosPre::find($this->IdModeloPre)?->presupuesto->estatus;
		}
		return Modelopremat::query()
			->select('modelopremats.*')
			->join('materials', 'materials.id', '=', 'modelopremats.IdMaterial')
			->join('clases', 'clases.id', '=', 'materials.IdClase')
			->leftJoin('tipos', 'tipos.id', '=', 'modelopremats.IdTipo')
			->where('IdModeloPre', $this->IdModeloPre)
			->where(function ($consulta) use ($keyWord) {
				$consulta->where('modelopremats.cantidad', 'LIKE', "%{$keyWord}%")
					->orWhere('modelopremats.diferenciador', 'LIKE', "%{$keyWord}%")
					->orWhere('modelopremats.posicion', 'LIKE', "%{$keyWord}%")
					->orWhere('modelopremats.formula', 'LIKE', "%{$keyWord}%")
					->orWhere('materials.material', 'LIKE', "%{$keyWord}%")
					->orWhere('materials.referencia', 'LIKE', "%{$keyWord}%");
			})
			->with(['material.clase', 'material.tipo', 'materialCosto'])
			->orderBy('clases.orden')
			->orderByRaw('CASE WHEN tipos.orden IS NULL THEN 1 ELSE 0 END')
			->orderBy('tipos.orden')
			->orderBy('materials.id')
			->orderByDesc('modelopremats.principal')
			->orderBy('modelopremats.posicion')
			->orderByDesc('modelopremats.costo')
			->get();
	}

	public function render()
	{
		return view('livewire.modelopremats.view', [
			'modelopremats' => $this->filteredModelopremats,
		]);
	}
	
	public function cargarArrays(){
        $this->modelos = Util::getArray('modelos');
        $this->materials = Util::getArray('materials');
        $this->tipos = Util::getArray('tipos');
        $this->lineas = Util::getArray('lineas');
        $this->tablas = Util::getArray('tablaherrajes');
		$Linea= \App\Models\Modelospre::find($this->IdModeloPre)?->Modelo?->Linea;
		if($Linea){
			$this->lineas = DB::table('lineas')->where('IdMarca', $Linea->Marca?->id)
				->pluck('linea', 'id');
			$this->tablas = DB::table('tablaherrajes')->where('IdLinea', $Linea->id)
				->pluck('tablaHerraje', 'id');	
		}
	}

	public function nuevoModelo($id)
	{
		$existen = Modelopremat::where('IdModeloPre', $this->IdModeloPre)->exists();
		if ($existen) {
			$this->dispatch('sweetalert', \App\Helpers\SweetAlert::mensaje(
				'⚠️ Este modelo ya tiene materiales asignados.',
				2000,
				'warning'
			));
			return;
		}

		$modelo = \App\Models\Modelo::with(['modelosmats' => function ($q) {
			$q->where('principal', 1);
		}])->find($id);
		foreach ($modelo->modelosmats as $material) {
			Modelopremat::create([
				'IdModeloPre'    => $this->IdModeloPre,
				'principal'      => 1,
				'cantidad'       => $material->cantidad,
				'IdMaterial'     => $material->IdMaterial,
				'diferenciador'  => $material->diferenciador,
				'IdTipo'         => $material->IdTipo,
				'posicion'       => $material->posicion,
				'formula'        => $material->formula,
				'IdLineaPref' => $material->IdLineaPref,
				'IdTablaHerraje' => $material->IdTablaHerraje,
				'cantidadHerraje' => $material->cantidadHerraje,				
				'obs'            => $material->obs,
			]);
		}
		$this->dispatch('sweetalert', \App\Helpers\SweetAlert::mensaje(
			'✅ Materiales agregados correctamente!',
			1500,
			'success'
		));
	}
	public function cargarMaterial($id){
		$this->dispatch('materialSelId', $id);
		$this->dispatch('sweetalert', \App\Helpers\SweetAlert::mensaje(
			'✅ Material cargado!',
			1000,'success'));		
	}
    public function create()
    {
		$this->resetInput();
        $this->verModalModelopremat = true;
    } 
    private function resetInput()
    {
		$this->reset('selected_id','posicion','presupuesto','IdLineaPref',
			'IdTipo','IdTablaHerraje','cantidadHerraje','formula','obs');		
		$this->cantidad = 1;
    }
		
	private function consulta()
	{
		$modelopremats = Modelopremat::select('modelopremats.*')
			->join('materials', 'materials.id', '=', 'modelopremats.IdMaterial')
			->join('clases', 'clases.id', '=', 'materials.IdClase')
			->leftJoin('tipos', 'tipos.id', '=', 'materials.IdTipo') // 👈 igual que en la otra
			->leftJoin('materialscostos', 'materialscostos.id', '=', 'modelopremats.IdMaterialCosto')
			->where('modelopremats.IdModeloPre', $this->IdModeloPre)
			->with([
				'material.clase',
				'material.tipo',
				'materialscosto',
			])
			->addSelect('materialscostos.referencia as referencia_costo') 
			->orderBy('clases.orden')          // primero la clase (Perfiles, Vidrios, etc.)
			->orderBy('tipos.orden')           // luego el tipo (Marco, Hoja, Junquillo, Refuerzo)
			->orderByDesc('modelopremats.principal')
			->orderByDesc('materialscostos.costo')
			->orderBy('materials.id')
			->orderBy('modelopremats.posicion')
			->get();

		return $modelopremats;
	}

	public function imprimir()
	{
		$modelopremats = $this->consulta();
		$modelosPre = ModelosPre::find($this->IdModeloPre);
		$factorRec  = $modelosPre->porRecargo/100 ?? 0;
		$costoMat = $this->costoMat;
		$indirectos = $costoMat *  $factorRec;
		$subtotal = $costoMat + $indirectos;
		$iva = $subtotal * .16 ;
		$total    = $subtotal * 1.16;		
		$pdf = PDF::loadView('livewire.modelopremats.viewPDF', 
			compact('modelopremats', 'costoMat', 'modelosPre'))
			->setPaper('letter', 'portrait');

		$pdfName = 'Modelo.pdf';
		$pdfPath = public_path('presupuestos/' . $pdfName);
		$pdf->save($pdfPath);

		return response()->file($pdfPath, [
			'Content-Type' => 'application/pdf',
			'Content-Disposition' => 'inline; filename="' . $pdfName . '"'
		]);
	}

	public function calculaDep()
	{
		$datos = \App\Services\Optims\Datos::generar($this->IdModeloPre);
		$procesador = new \App\Services\Optims\Procesador($datos);
		$respuesta = $procesador->ejecutar();
		$this->costoMat = $respuesta['resultados']['costoMaterial'];
		$this->dispatch('presuElemActualizado');
		$tieneErrores = count($respuesta['errores']) > 0;
		$this->dispatch('sweetalert', \App\Helpers\SweetAlert::mensaje(
			$tieneErrores ? '⚠️ Algunos cálculos tienen errores!' 
			: '✅ Dependencias aplicadas!', 1000,
			$tieneErrores ? 'warning' : 'success'
		));		
	}

    public function cancel()
    {
		$this->resetInput();
        $this->verModalModelopremat = false;
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Modelopremat::findOrFail($id)->toArray());
		$this->IdLineaPref = $this->adicionales['IdLineaPref'] ?? '';
        $this->verModalModelopremat = true;
    }

    public function save()
    {
		if (!$this->selected_id) 
			$this-> principal = true;		
		$this->validate([
		'IdModeloPre' => 'required',
		'principal' => 'required',
		'cantidad' => 'required',
		]);
		if ($this->IdTablaHerraje && (!$this->cantidadHerraje || $this->cantidadHerraje < 1)) {
			$this->cantidadHerraje = 1;
		}
		$adicionales = $this->adicionales;
		$adicionales['IdLineaPref'] = (int) $this->IdLineaPref;
		$xd = Modelopremat::updateOrCreate(
			['id' => $this->selected_id],
			[
				'IdModeloPre' => $this->IdModeloPre,
				'principal' => $this->principal,
				'cantidad' => $this->cantidad,
				'IdMaterial' => $this->IdMaterial,
				'diferenciador' => $this->diferenciador,
				'IdTipo' => $this->IdTipo ?: null,
				'posicion' => $this->posicion,
				'formula' => $this->formula,
				'errFormula' => $this->errFormula,
				'dimensiones' => $this->dimensiones,
				'costo' => $this->costo,
				'IdTablaHerraje' => $this->IdTablaHerraje ?: null,
				'cantidadHerraje' => (empty($this->IdTablaHerraje)) ? null : intval($this->cantidadHerraje),
				'adicionales' => $adicionales,
				'obs' => $this->obs
			]
		);
		$this->verModalModelopremat = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Modelopremat::where('id', $id)->delete();
        }
    }
}