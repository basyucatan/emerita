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

class Cortes extends Component
{
    use WithPagination, CrudTraspasos;

    protected $paginationTheme = 'bootstrap';
    public $keyWord;
	public $perfils =[], $vidrios =[];

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
        return view('livewire.cortes.view', [
            'traspasos' => $this->filteredTraspasos,
        ]);
    }

	public function generarDets()
	{
		$this->verModalPresu = false;
		$presupuesto = \App\Models\Presupuesto::find($this->IdPresupuesto);
		$this->marcas = $presupuesto->buscarMarcas();
		$opt = new \App\Services\OptimizarCompra();
		$this->optim = $opt->optimizar($this->IdPresupuesto, true);
		$this->perfils = array_map(function($grupo) {
			$grupo['barras'] = array_map(function($barra) {
				$barra['hecho'] = false;
				return $barra;
			}, $grupo['barras'] ?? []);
			return $grupo;
		}, $this->optim['perfils']['grupos'] ?? []);
		$this->vidrios = array_map(function($grupo) {
			$grupo['hojas'] = array_map(function($hoja) {
				$hoja['hecho'] = false;
				return $hoja;
			}, $grupo['hojas'] ?? []);
			return $grupo;
		}, $this->optim['vidrios']['grupos'] ?? []);
		$this->verModalCortes = true;
	}

	public function cortar($tipo, $grupoId = null, $elemId = null)
	{
		if ($grupoId === '') $grupoId = null;
		if ($elemId === '') $elemId = null;
		if ($tipo === 'perfil') { // PERFIL
			if ($elemId === null) {
				$grupoIndex = 0;
				$barraIndex = (int) $grupoId;
			} else {
				$grupoIndex = (int) $grupoId;
				$barraIndex = (int) $elemId;
			}
			if (!isset($this->perfils[$grupoIndex])) {
				$this->msg = 'Grupo de perfiles no encontrado.';
				return;
			}
			if (!isset($this->perfils[$grupoIndex]['barras'][$barraIndex])) {
				$this->msg = 'Barra no encontrada.';
				return;
			}
			$etiquetaCortada = null;
			$marcado = false;
			if (!empty($this->perfils[$grupoIndex]['barras'][$barraIndex]['cortes'])) {
				foreach ($this->perfils[$grupoIndex]['barras'][$barraIndex]['cortes'] as $i => $c) {
					if (empty($c['hecho'])) {
						$etiquetaCortada = ($c['etiqueta'] ?? '') .'-'. ($c['dim'] ?? '');
						$this->perfils[$grupoIndex]['barras'][$barraIndex]['cortes'][$i]['hecho'] = true;
						$marcado = true;
						break;
					}
				}
			}
			if (!$marcado) {
				$this->msg = 'No hay cortes pendientes en esta barra.';
				return;
			}
			$todos = true;
			foreach ($this->perfils[$grupoIndex]['barras'][$barraIndex]['cortes'] as $c) {
				if (empty($c['hecho'])) { $todos = false; break; }
			}
			$this->perfils[$grupoIndex]['barras'][$barraIndex]['hecho'] = $todos;
			$this->optim['perfils']['grupos'] = $this->perfils;
			$this->calcularAvanceGlobal();
			$etiquetaCortada = $etiquetaCortada ?? 'Etiqueta desconocida';
			$this->msg = "✅ Corte realizado: {$etiquetaCortada}";
			return;
		}
		if ($tipo === 'vidrio') { // VIDRIO
			if ($elemId === null) {
				$grupoIndex = 0;
				$hojaIndex = (int) $grupoId;
			} else {
				$grupoIndex = (int) $grupoId;
				$hojaIndex = (int) $elemId;
			}
			if (!isset($this->vidrios[$grupoIndex])) {
				$this->msg = 'Grupo de vidrios no encontrado.';
				return;
			}
			if (!isset($this->vidrios[$grupoIndex]['hojas'][$hojaIndex])) {
				$this->msg = 'Hoja no encontrada.';
				return;
			}
			$etiquetaCortada = null;
			$marcado = false;
			if (!empty($this->vidrios[$grupoIndex]['hojas'][$hojaIndex]['cortes'])) {
				foreach ($this->vidrios[$grupoIndex]['hojas'][$hojaIndex]['cortes'] as $i => $c) {
					if (empty($c['hecho'])) {
						$etiquetaCortada = ($c['etiqueta'] ?? '') .'-'. ($c['dim'] ?? '');
						$this->vidrios[$grupoIndex]['hojas'][$hojaIndex]['cortes'][$i]['hecho'] = true;
						$marcado = true;
						break;
					}
				}
			}
			if (!$marcado) {
				$this->msg = 'No hay cortes pendientes en esta hoja.';
				return;
			}
			$todos = true;
			foreach ($this->vidrios[$grupoIndex]['hojas'][$hojaIndex]['cortes'] as $c) {
				if (empty($c['hecho'])) { $todos = false; break; }
			}
			$this->vidrios[$grupoIndex]['hojas'][$hojaIndex]['hecho'] = $todos;
			// $this->optim['vidrios']['grupos'] = $this->vidrios; // sincronizar optim (opcional)
			$this->calcularAvanceGlobal();
			$etiquetaCortada = $etiquetaCortada ?? 'Etiqueta desconocida';
			$this->msg = "✅ Corte realizado: {$etiquetaCortada}";
			return;
		}
		$this->msg = 'Tipo de corte no reconocido.';
	}

	public function cerrarCortes()
	{
		$this->verModalCortes = false;
	}
	public function calcularAvanceGlobal()
	{
		$total = 0;
		$hechas = 0;
		foreach ($this->perfils as $grupo) {
			foreach ($grupo['barras'] as $barra) {
				foreach ($barra['cortes'] as $c) {
					$total++;
					if (!empty($c['hecho'])) $hechas++;
				}
			}
		}
		foreach ($this->vidrios as $grupo) {
			foreach ($grupo['hojas'] as $hoja) {
				foreach ($hoja['cortes'] as $c) {
					$total++;
					if (!empty($c['hecho'])) $hechas++;
				}
			}
		}
		$this->avance = $total > 0 ? round(($hechas * 100) / $total, 1) : 0;
	}
}
