<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ocompra;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Ocompras extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalOcompra=false, $selected_id, $keyWord, $IdDivision, $IdProveedor, $IdUser, $IdObra, $IdCondPago, $IdCondFlete, $fechaHSol, $fechaERec, $porDescuento, $concepto, $estatus, $adicionales;
	
    public function updatedKeyWord()
	{
		$this->resetPage();
	}
    #[Computed]
	public function filteredOcompras()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Ocompra::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('IdDivision', 'LIKE', $keyWord)
						->orWhere('IdProveedor', 'LIKE', $keyWord)
						->orWhere('IdUser', 'LIKE', $keyWord)
						->orWhere('IdObra', 'LIKE', $keyWord)
						->orWhere('IdCondPago', 'LIKE', $keyWord)
						->orWhere('IdCondFlete', 'LIKE', $keyWord)
						->orWhere('fechaHSol', 'LIKE', $keyWord)
						->orWhere('fechaERec', 'LIKE', $keyWord)
						->orWhere('porDescuento', 'LIKE', $keyWord)
						->orWhere('concepto', 'LIKE', $keyWord)
						->orWhere('estatus', 'LIKE', $keyWord)
						->orWhere('adicionales', 'LIKE', $keyWord);
			})
			->paginate(12);
	}

	public function render()
	{
		return view('livewire.ocompras.view', [
			'ocompras' => $this->filteredOcompras,
		]);
	}
	
    public function cancel()
    {
        $this->resetInput();
        $this->verModalOcompra = false;
    }

    public function resetInput()
    {
        $this->reset();
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Ocompra::findOrFail($id)->toArray());
        $this->verModalOcompra = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalOcompra = true;
    }    
    public function save()
    {
        $this->validate([
		'IdDivision' => 'required',
		'IdProveedor' => 'required',
		'IdCondPago' => 'required',
		'IdCondFlete' => 'required',
		'fechaHSol' => 'required',
		'fechaERec' => 'required',
		'estatus' => 'required',
        ]);

        Ocompra::updateOrCreate(
			['id' => $this->selected_id],
			[
				'IdDivision' => $this-> IdDivision,
				'IdProveedor' => $this-> IdProveedor,
				'IdUser' => $this-> IdUser,
				'IdObra' => $this-> IdObra,
				'IdCondPago' => $this-> IdCondPago,
				'IdCondFlete' => $this-> IdCondFlete,
				'fechaHSol' => $this-> fechaHSol,
				'fechaERec' => $this-> fechaERec,
				'porDescuento' => $this-> porDescuento,
				'concepto' => $this-> concepto,
				'estatus' => $this-> estatus,
				'adicionales' => $this-> adicionales
			]
		);
        $this->resetInput();
        $this->verModalOcompra = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Ocompra::where('id', $id)->delete();
        }
    }
}