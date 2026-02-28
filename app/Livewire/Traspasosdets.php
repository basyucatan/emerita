<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Traspasosdet;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Traspasosdets extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalTraspasosdet=false, $selected_id, $keyWord, $IdTraspaso, $tipoMov,
    $estatusPadre, $compra,
		$IdMatCosto, $cantidad, $valorU, $dimensiones, $adicionales;
	protected $listeners = [
        'agregarMaterialscosto' => 'agregarMaterialscosto',
        'cambioEstatus' => 'cambioEstatus'
    ];
	public function cambioEstatus($id, $estatus)
    {
        $this->IdTraspaso = $id;
        $this->estatusPadre = $estatus;
        $this->filteredTraspasosdets();
    }
    public function updatingKeyWord()
	{
		$this->resetPage();
	}

    #[Computed]
    public function filteredTraspasosdets()
    {
        $keyWord = '%' . $this->keyWord . '%';
        $query = Traspasosdet::query()
            ->select('traspasosdets.*')
            ->where('traspasosdets.IdTraspaso', $this->IdTraspaso)
            ->leftJoin('materialscostos', 'materialscostos.id', '=', 'traspasosdets.IdMatCosto')
            ->leftJoin('materials', 'materials.id', '=', 'materialscostos.IdMaterial')
            ->leftJoin('clases', 'clases.id', '=', 'materials.IdClase')
            ->where(function ($q) use ($keyWord) {
                $q->where('traspasosdets.dimensiones', 'LIKE', $keyWord)
                ->orWhere('traspasosdets.adicionales', 'LIKE', $keyWord)
                ->orWhere('materialscostos.referencia', 'LIKE', $keyWord)
                ->orWhere('materials.material', 'LIKE', $keyWord);
            })
            ->orderBy('clases.orden')
            ->orderBy('materials.IdClase')
            ->orderBy('materials.id')
            ->orderBy('materialscostos.id');
        return $query->get();
    }

	public function mount(){
        if($this->IdTraspaso){
            $this->compra = DB::table('traspasos')->find($this->IdTraspaso);
            $this->estatusPadre = $this->compra->estatus;
		}
	}

	public function render()
	{
		return view('livewire.traspasosdets.view', [
			'traspasosdets' => $this->filteredTraspasosdets,
		]);
	}
	public function agregarMaterialscosto($id)
	{
		$this->resetInput();
		$matCosto = \App\Models\Materialscosto::find($id);
		if($matCosto){
			$this->cantidad=1;
			$this->IdMatCosto=$id;
			$this->valorU = $matCosto->costo;
			$this->verModalTraspasosdet = true;
		}
	}	
    public function cancel()
    {
        $this->resetInput();
        $this->verModalTraspasosdet = false;
    }
    public function resetInput()
    {
		$this->resetExcept('IdTraspaso','estatusPadre');
    }
    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Traspasosdet::findOrFail($id)->toArray());
        $this->verModalTraspasosdet = true;
    }

    public function save()
    {
        if (!$this->IdTraspaso) {
            $this->verModalTraspasosdet = false;
            $this->dispatch('sweetalert', \App\Helpers\SweetAlert::mensaje(
                'No se encuentra los datos del documento',
                1200,
                'warning'
            ));
            return;
        }
        $this->validate([
            'IdTraspaso' => 'required',
            'cantidad' => 'required',
            'valorU' => 'required',
        ]);
        if (!empty($this->dimensiones)) {
            $det = Traspasosdet::find($this->selected_id) ?? new Traspasosdet([
                'IdMatCosto' => $this->IdMatCosto,
                'dimensiones' => $this->dimensiones
            ]);
            $this->cantidad = $det->ConvertirCantidad();
        }
        Traspasosdet::updateOrCreate(
            ['id' => $this->selected_id],
            [
                'IdTraspaso' => $this->IdTraspaso,
                'IdMatCosto' => $this->IdMatCosto,
                'cantidad' => $this->cantidad,
                'valorU' => $this->valorU,
                'dimensiones' => $this->dimensiones,
                'adicionales' => $this->adicionales
            ]
        );
        $this->resetInput();
        $this->verModalTraspasosdet = false;
    }
    public function duplicar($id){
        $nuevo = Util::duplicar('Traspasosdet', $id);
    }

    public function destroy($id)
    {
        if ($id) {
            Traspasosdet::where('id', $id)->delete();
        }
    }
}