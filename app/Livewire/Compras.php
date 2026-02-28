<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Negocio;
use App\Models\Traspaso;
use App\Models\Traspasosdet;
use Livewire\Attributes\Computed;
use App\Traits\CrudTraspasos;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class Compras extends Component
{
    use WithPagination, CrudTraspasos;

    protected $paginationTheme = 'bootstrap';
    public $keyWord;

	public function updatingKeyWord()
	{
		$this->resetPage();
	}

	#[Computed]
	public function filteredTraspasos()
	{
		$keyWord = '%' . $this->keyWord . '%';
		$query = Traspaso::where('tipo', 'Compra')
			->when($this->queVer === 'Cerrado', function ($q) {
				$q->whereIn('estatus', ['Cerrado', 'Cancelado']);
			}, function ($q) {
				$q->where('estatus', 'Abierto');
			})
			->where(function ($query) use ($keyWord) {
				$query
					->orWhere('id', 'LIKE', $keyWord)
					->orWhereHas('userOri', fn($q) => $q->where('name', 'LIKE', $keyWord))
					->orWhereHas('userDes', fn($q) => $q->where('name', 'LIKE', $keyWord))
					->orWhereHas('deptoOri', fn($q) => $q->where('depto', 'LIKE', $keyWord))
					->orWhereHas('deptoDes', fn($q) => $q->where('depto', 'LIKE', $keyWord))
					->orWhere('adicionales->obs', 'LIKE', $keyWord)
					->orWhere('adicionales->presupuesto', 'LIKE', $keyWord);
			})
			->orderBy('fecha', $this->orden)
			->orderBy('id', $this->orden);
		if ($this->queVer === 'Cerrado') {
			$traspasos = $query->paginate(3);
		} else {
			$traspasos = $query->get();
		}

		return $traspasos;

	}

    public function render()
    {
        return view('livewire.compras.view', [
            'traspasos' => $this->filteredTraspasos,
        ]);
    }

    public function generarDets()
    {
        $this->verModalPresu = false;
        $presupuesto = \App\Models\Presupuesto::find($this->IdPresupuesto);
        $this->marcas = $presupuesto->buscarMarcas();
        $opt = new \App\Services\OptimizarCompra();
        $this->optim = $opt->optimizar($this->IdPresupuesto, false);
        $optPerfils = collect($this->optim['perfils']['grupos'] ?? []);
        $optVidrios = collect($this->optim['vidrios']['grupos'] ?? []);
        // $this->verModalCortes = true; return;
        foreach ($this->marcas as $marca) {
            $this->IdMarca = $marca['id'];
            $compra = $this->save();
            $modeloPreMats = $presupuesto->buscarMatsXMarca($marca['id']);
            $optimProcesados = [];
            $agrupados = [];
            foreach ($modeloPreMats as $modeloPreMat) {
                $idMatCosto = $modeloPreMat->IdMaterialCosto;
                $grupoPerfil = $optPerfils->firstWhere('IdMaterialCosto', $idMatCosto);
                $grupoVidrio = $optVidrios->firstWhere('IdMaterialCosto', $idMatCosto);

                if ($grupoPerfil || $grupoVidrio) {
                    if (in_array($idMatCosto, $optimProcesados, true)) {
                        continue; // ya procesado por optimización
                    }
                    if ($grupoPerfil) {
                        $cantidad = collect($grupoPerfil['barras'] ?? [])->where('existe', false)->count();
                    } else {
                        $cantidad = collect($grupoVidrio['hojas'] ?? [])->where('existe', false)->count();
                    }
                    $matCosto = \App\Models\Materialscosto::find($idMatCosto);
                    Traspasosdet::create([
                        'IdTraspaso'  => $compra->id,
                        'IdMatCosto'  => $idMatCosto,
                        'cantidad'    => $cantidad,
                        'dimensiones' => null, 
                        'valorU'      => $matCosto ? $matCosto->costo : 0,
                    ]);
                    $optimProcesados[] = $idMatCosto;
                } else {
                    if (!isset($agrupados[$idMatCosto])) {
                        $matCosto = \App\Models\Materialscosto::find($idMatCosto);
                        $agrupados[$idMatCosto] = [
                            'IdTraspaso'  => $compra->id,
                            'IdMatCosto'  => $idMatCosto,
                            'cantidad'    => 0.0,
                            'dimensiones' => null, // dejamos null porque la cantidad ya incorpora la dimensión
                            'valorU' => $matCosto?->costo ?? 0,
                        ];
                    }
                    $dimsRaw = trim($modeloPreMat->dimensiones ?? '');
                    $parts = array_values(array_filter(array_map('trim', explode(',', $dimsRaw))));
                    if (count($parts) === 0) {
                        $add = (float) $modeloPreMat->cantidad;
                    } elseif (count($parts) === 1) { // Una dimensión: cantidad * dimensión
                        $dim = (float) $parts[0];
                        $add = (float) $modeloPreMat->cantidad * $dim/1000;
                    } else {// Dos o más dimensiones ancho x alto (mm),
                        $w = (float) $parts[0];
                        $h = (float) $parts[1];
                        $area_m2 = ($w * $h) / 1000000.0;
                        $add = (float) $modeloPreMat->cantidad * $area_m2;
                    }
                    $agrupados[$idMatCosto]['cantidad'] += $add;
                }
            } // end foreach modeloPreMats
            foreach ($agrupados as $fila) {
                Traspasosdet::create($fila);
            }
        } // end foreach marcas
    }

    public function imprimir($id)
    {
        $traspaso = Traspaso::with('traspasosdets')->findOrFail($id);
        $negocio = Negocio::find(1);
        $pdf = PDF::loadView('livewire.traspasos.traspasoPDF', compact('traspaso', 'negocio'))
            ->setPaper('letter', 'portrait');
        $pdfName = 'traspaso.pdf';
        $pdfPath = public_path('traspasos/' . $pdfName);
        $pdf->save($pdfPath);
        return response()->file($pdfPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $pdfName . '"'
        ]);    
    }

    public function cerrarCortes()
    {
        $this->verModalCortes = false;
    }

}
