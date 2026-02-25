<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Mensaje;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Livewire\WithFileUploads;


class Mensajes extends Component
{
    use WithPagination, WithFileUploads;

	protected $paginationTheme = 'bootstrap';
    public $verModalMensaje=false, $selected_id, $keyWord, $titulo, 
		$fechaIni, $fechaFin, $foto, $contenido, $documento, $urlLink;
	public $Mensaje, $fotoSubida, $docSubida;
    #[Computed]
	public function filteredMensajes()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Mensaje::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
					->orWhere('titulo', 'LIKE', $keyWord)
					->orWhere('contenido', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
		return view('livewire.mensajes.view', [
			'mensajes' => $this->filteredMensajes,
		]);
	}
	
    public function cancel()
    {
        $this->verModalMensaje = false;
    }
    public function resetInput()
    {
        $this->reset();
    }
    public function edit($id)
    {
        $this->resetInput();
        $this->selected_id = $id;
		$this->Mensaje = Mensaje::findOrFail($id);
		$this->fill($this->Mensaje->toArray());	
        $this->verModalMensaje = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalMensaje = true;
    }   

    public function save()
    {
        $this->validate([
            'titulo'   => 'required',
            'fechaIni' => 'required',
            'fechaFin' => 'required',
        ]);
        $carpeta = Mensaje::FOLDER;
        $archivoFoto = $this->foto; // valor actual guardado en DB
        if ($this->fotoSubida) {
            if ($this->selected_id && $this->foto) {
                Util::borrarArchivo($carpeta, $this->foto);
            }
            $archivoFoto = Util::guardarArchivo(
                $this->fotoSubida,
                $this->titulo,
                $carpeta
            );
        }
        $archivoDoc = $this->documento;
        if ($this->docSubida) {
            if ($this->selected_id && $this->documento) {
                Util::borrarArchivo($carpeta, $this->documento);
            }
            $archivoDoc = Util::guardarArchivo(
                $this->docSubida,
                $this->titulo,
                $carpeta
            );
        }
        Mensaje::updateOrCreate(
            ['id' => $this->selected_id],
            [
                'titulo'    => $this->titulo,
                'fechaIni'  => $this->fechaIni,
                'fechaFin'  => $this->fechaFin,
                'foto'      => $archivoFoto,
                'contenido' => $this->contenido,
                'documento' => $archivoDoc,
                'urlLink'   => $this->urlLink,
            ]
        );
        $this->verModalMensaje = false;
    }

    public function eliminarFoto()
    {
        if (!$this->selected_id) return;
        Util::borrarArchivo($this->foto, Mensaje::FOLDER);
        $this->Mensaje->update(['foto' => null]);
        $this->foto = null;
        $this->fotoSubida = null;
        $this->Mensaje = Mensaje::find($this->selected_id);
    }

    public function eliminarDoc()
    {
        if (!$this->selected_id) return;
        Util::borrarArchivo($this->documento, Mensaje::FOLDER);
        $this->Mensaje->update(['documento' => null]);
        $this->documento = null;
        $this->docSubida = null;
        $this->Mensaje = Mensaje::find($this->selected_id);
    }

    public function destroy($id)
    {
        if ($id) {
            Mensaje::where('id', $id)->delete();
        }
    }
}