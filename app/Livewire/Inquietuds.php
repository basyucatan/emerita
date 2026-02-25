<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inquietud;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Inquietuds extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalInquietud=false, $selected_id, $keyWord, $IdComiteDes, $fecha, $user,
		$nombre, $telefono, $titulo, $inquietud, $respuesta, $estatus, $adicionales;
	public $comites = [];

	public function updatedEstatusSel()
	{
		$this->resetPage();
	}
	public function updatedKeyWord()
	{
		$this->resetPage();
	}
    #[Computed]
	public function filteredInquietuds()
	{
		$keyWord = '%' . $this->keyWord . '%';
		$esAdmin = false;
		if ($this->user){
			$esAdmin = $this->user->can('admin') ?? false;
		}
		return Inquietud::query()
			->when(!$esAdmin, function ($q) {
				$q->where('estatus', 'edicion');
			})
			->where(function ($q) use ($keyWord) {
				$q->where('nombre', 'LIKE', $keyWord)
				->orWhere('titulo', 'LIKE', $keyWord)
				->orWhere('inquietud', 'LIKE', $keyWord)
				->orWhere('estatus', 'LIKE', $keyWord)
				->orWhereHas('Comite', function ($c) use ($keyWord) {
					$c->where('abreviatura', 'LIKE', $keyWord);
				});
			})
			->orderByDesc('fecha')
			->paginate(10);

	}
	public function mount(){
		$this->user = Auth::user() ?? null;
	}
	public function render()
	{
		if(!$this->comites)
			$this->comites = DB::table('comites')
				->where('comAsamblea',1)
				->orderBy('orden')->pluck('comite','id');
		return view('livewire.inquietuds.view', [
			'inquietuds' => $this->filteredInquietuds,
		]);
	}
	
    public function cancel()
    {
        $this->verModalInquietud = false;
    }
    public function resetInput()
    {
        $this->resetExcept('user','comites');
    }
    public function edit($id)
    {
        $this->resetInput();
        $this->selected_id = $id;
		$this->fill(Inquietud::findOrFail($id)->toArray());
        $this->verModalInquietud = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalInquietud = true;
    }    
	
	public function save()
	{
		$this->validate([
			'nombre'   => 'required|string|min:2|max:50',
			'telefono' => ['required','regex:/^[0-9,]+$/','max:33'],
			'titulo'   => 'required|string|min:10|max:50',
			'inquietud'=> 'required|string|min:30',
		]);

		$this->nombre = mb_strtoupper(mb_substr($this->nombre, 0, 50));
		$this->titulo = mb_strtoupper(mb_substr($this->titulo, 0, 50));
		$estatus = $this->selected_id ? $this->estatus : 'edicion';
		$IdComiteDes = $this->IdComiteDes ?? 12;

		if ($this->selected_id) {
			$inq = Inquietud::findOrFail($this->selected_id);
			$inq->IdComiteDes = $IdComiteDes;
			$inq->nombre      = $this->nombre;
			$inq->telefono    = $this->telefono;
			$inq->titulo      = $this->titulo;
			$inq->inquietud   = $this->inquietud;
			$inq->respuesta   = $this->respuesta;
			$inq->estatus     = $estatus;

			$dirty    = $inq->getDirty();
			$original = $inq->getOriginal();
			$inq->adicionales = Inquietud::ads($inq->adicionales, $this->user, $dirty, $original);

			$inq->save();
		} else {
			$inq = Inquietud::create([
				'IdComiteDes' => $IdComiteDes,
				'fecha'       => now()->tz('America/Mexico_City'),
				'nombre'      => $this->nombre,
				'telefono'    => $this->telefono,
				'titulo'      => $this->titulo,
				'inquietud'   => $this->inquietud,
				'respuesta'   => $this->respuesta,
				'estatus'     => $estatus,
				'adicionales' => Inquietud::ads(null, $this->user, [], []),
			]);
		}

		$this->verModalInquietud = false;
	}

public function cambiarEstatus($id, $accion)
{
    $sol = Inquietud::findOrFail($id);
    if ($accion == 'aprobar') {
        if ($sol->estatus == 'edicion') {
            $sol->update(['estatus' => 'aprobado']);
        }
        return;
    }
    $esAdmin = $this->user && ($this->user->can('admin') ?? false);
    if (!$esAdmin) return;
    if (!in_array($accion, ['atender', 'nocivo'])) return;
    $sol->estatus = $accion === 'atender' ? 'atendido' : 'nocivo';
    $dirty    = $sol->getDirty();
    $original = $sol->getOriginal();
    $sol->adicionales = Inquietud::ads($sol->adicionales, $this->user, $dirty, $original);
    $sol->save();
}


    public function destroy($id)
    {
        if ($id) {
            Inquietud::where('id', $id)->delete();
        }
    }
}