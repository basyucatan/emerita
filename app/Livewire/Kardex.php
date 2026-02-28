<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Materialscosto;
use App\Models\Negocio;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class Kardex extends Component
{
    public $matCosto, $movs, $existencia, $IdDepto = 3;
    public $deptos = [];
    protected $listeners = [
        'agregarMaterialscosto' => 'agregarMaterialscosto',
    ];
    public function agregarMaterialscosto($id){
        $this->matCosto = Materialscosto::find($id);
        $this->calcularMovs();
    }
    public function updatedIdDepto($value)
    {
        $this->IdDepto = (int) $value;
    }    
    public function calcularMovs()
    {
        $this->existencia = 0;
        $this->movs = collect();

        if ($this->matCosto && $this->IdDepto && $this->IdDepto < 6) {
            $this->movs = $this->matCosto->kardex($this->IdDepto)->map(function ($row) {
                $adicionales = is_array($row->adicionales)
                    ? $row->adicionales
                    : (is_string($row->adicionales)
                        ? json_decode($row->adicionales, true)
                        : []);
                $row->adicionalesTexto = collect($adicionales)
                    ->map(fn($v, $k) => substr($k, 0, 5) . ': ' . $v)
                    ->join(', ');
                return $row;
            });
            $this->existencia = $this->matCosto->existencia($this->IdDepto);
        }
    }

    private function getExistencias($deptoId = null)
    {
        $matCosto = \App\Models\Materialscosto::with([
            'material.clase',
            'material.tipo',
            'color',
            'moneda',
        ])->get();
        $matCosto = $matCosto->sortBy([
            fn($a, $b) => ($a->material->clase->orden ?? 0) <=> ($b->material->clase->orden ?? 0),
            fn($a, $b) => ($a->material->tipo->orden ?? 0) <=> ($b->material->tipo->orden ?? 0),
        ]);
        if ($deptoId) {
            $existencias = $matCosto->map(function ($mat) use ($deptoId) {
                $existencia = $mat->existencia($deptoId);
                $monedaSim = $mat->Moneda->simbolo ?? '$';
                $valorU = $mat->costo ?? 0;
                $valorUMXN = $mat->Valores['valorURealMXN'] ?? 0;
                $importe = round($existencia * $valorUMXN, 2);
                return [
                    'material'   => $mat->material->material ?? 'Sin nombre',
                    'referencia' => $mat->referencia ?? '',
                    'unidad' => $mat->unidad,
                    'longBarra' => $mat->Barra->longitud ?? '-',
                    'existencia' => $existencia,
                    'monedaSim'  => $monedaSim,
                    'valorU'     => $valorU,
                    'valorUMXN'  => $valorUMXN,
                    'importe'    => $importe,
                ];
            })
            ->filter(fn($item) => $item['existencia'] > 0)
            ->values();
            return collect([$deptoId => [
                'nombre' => \App\Models\Depto::find($deptoId)?->depto ?? 'Sin nombre',
                'items'  => $existencias,
                'total'  => $existencias->sum('importe'),
            ]]);
        }
        $deptos = \App\Models\Depto::orderBy('id')->get();
        $existencias = $deptos->mapWithKeys(function ($depto) use ($matCosto) {
            $items = $matCosto->map(function ($mat) use ($depto) {
                $existencia = $mat->existencia($depto->id);
                $monedaSim = $mat->Moneda->simbolo ?? '$';
                $valorU = $mat->costo ?? 0;
                $valorUMXN = $mat->Valores['valorURealMXN'] ?? 0;
                $importe = round($existencia * $valorUMXN, 2);
                return [
                    'material'   => $mat->material->material ?? 'Sin nombre',
                    'referencia' => $mat->referencia ?? '',
                    'unidad' => $mat->unidad,
                    'longBarra' => $mat->Barra->longitud ?? '-',
                    'existencia' => $existencia,
                    'monedaSim'  => $monedaSim,
                    'valorU'     => $valorU,
                    'valorUMXN'  => $valorUMXN,
                    'importe'    => $importe,
                ];
            })
            ->filter(fn($item) => $item['existencia'] > 0)
            ->values();
            if ($items->isEmpty()) return [];
            return [$depto->id => [
                'nombre' => $depto->depto,
                'items'  => $items,
                'total'  => $items->sum('importe'),
            ]];
        });
        return $existencias;
    }

    public function exisDepto($id = null)
    {
        if(!$id) return;
        $existencias = $this->getExistencias($id);
        $depto = \App\Models\Depto::find($id);
        $negocio = \App\Models\Negocio::find(1);
        $pdf = PDF::loadView('livewire.kardex.exisDeptoPDF', compact('existencias', 'depto', 'negocio'))
            ->setPaper('letter', 'portrait');
        $pdfPath = public_path('reportes/existencias.pdf');
        $pdf->save($pdfPath);
        $this->calcularMovs();
        return response()->file($pdfPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="existencias.pdf"'
        ]);
    }
    public function existencias()
    {
        $existencias = $this->getExistencias();
        if ($existencias->isEmpty()) {
            return back()->with('mensaje', 'No hay existencias registradas en ningún departamento.');
        }
        $negocio = \App\Models\Negocio::find(1);
        $pdf = PDF::loadView('livewire.kardex.existenciasPDF', compact('existencias', 'negocio'))
            ->setPaper('letter', 'portrait');
        $pdfPath = public_path('reportes/existencias_general.pdf');
        $pdf->save($pdfPath);
        $this->calcularMovs();
        return response()->file($pdfPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="existencias_general.pdf"'
        ]);
    }

    public function render()
    {
        if (!$this->deptos) {
            $this->deptos = DB::table('deptos')->where('id','<', 6)
                ->pluck('depto', 'id');
        }
        return view('livewire.kardex.view');
    }
}
