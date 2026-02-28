<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Movinventario;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Movinventarios extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalMovinventario=false, $selected_id, $keyWord, $IdUserOri, 
		$IdUserDes, $tipo, $IdMatCosto, $IdDeptoOri, $IdDeptoDes, $fechaH,
		$cantidad, $valorU, $dimensiones, $adicionales;
	public $users=[], $deptos=[];

	public function mount(){
        $this->users = Util::getArray('users', 'name');
        $this->deptos = Util::getArray('deptos');
    }

	public function updatingKeyWord()
	{
		$this->resetPage();
	}	
    #[Computed]
	public function filteredMovinventarios()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Movinventario::where('id', '>', 0)
			->where(function ($query) use ($keyWord) {
				$query
					->orWhere('tipo', 'LIKE', $keyWord)
					->orWhereRaw("CAST(adicionales AS CHAR) LIKE ?", [$keyWord])
					->orWhereHas('userOri', function ($q) use ($keyWord) {
						$q->where('name', 'LIKE', $keyWord);
					})
					->orWhereHas('userDes', function ($q) use ($keyWord) {
						$q->where('name', 'LIKE', $keyWord);
					})
					->orWhereHas('deptoOri', function ($q) use ($keyWord) {
						$q->where('depto', 'LIKE', $keyWord);
					})
					->orWhereHas('deptoDes', function ($q) use ($keyWord) {
						$q->where('depto', 'LIKE', $keyWord);
					})
					->orWhereHas('materialscosto', function ($q) use ($keyWord) {
						$q->where('referencia', 'LIKE', $keyWord)
						->orWhereHas('material', function ($m) use ($keyWord) {
							$m->where('material', 'LIKE', $keyWord);
						});
					});
			})
			->orderby('fechaH','desc')
			->paginate(10);
	}


	public function render()
	{
		return view('livewire.movinventarios.view', [
			'movinventarios' => $this->filteredMovinventarios,
		]);
	}
	
    public function cancel()
    {
        $this->resetInput();
        $this->verModalMovinventario = false;
    }
    public function resetInput()
    {
        $this->resetExcept('users','deptos');
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalMovinventario = true;
    } 	
	public function edit($id)
	{
		$mov = Movinventario::findOrFail($id);
		$this->selected_id = $mov->id;
		$this->fill($mov->toArray());
		$this->adicionales = is_array($mov->adicionales)
			? json_encode($mov->adicionales, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
			: ($mov->adicionales ?? '');

		$this->verModalMovinventario = true;
	}
    public function save()
    {
        $this->validate([
		'tipo' => 'required',
		'IdMatCosto' => 'required',
		'fechaH' => 'required',
		'cantidad' => 'required',
		'valorU' => 'required',
        ]);

        Movinventario::updateOrCreate(
			['id' => $this->selected_id],
			[
				'IdUserOri' => $this-> IdUserOri,
				'IdUserDes' => $this-> IdUserDes,
				'tipo' => $this-> tipo,
				'IdMatCosto' => $this-> IdMatCosto,
				'IdDeptoOri' => $this-> IdDeptoOri,
				'IdDeptoDes' => $this-> IdDeptoDes,
				'fechaH' => $this-> fechaH,
				'cantidad' => $this-> cantidad,
				'valorU' => $this-> valorU,
				'dimensiones' => $this-> dimensiones,
				'adicionales' => $this-> adicionales
			]
		);
        $this->resetInput();
        $this->verModalMovinventario = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Movinventario::where('id', $id)->delete();
        }
    }
}