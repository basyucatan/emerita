<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Color;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Colors extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $selected_id, $IdColorable, $IdColorHerraje, $keyWord;
    public $color = '#000000', $opacidad = 100, $colorHex = null, $colorRgba = 'rgba(0, 0, 0, 1)';

    public $verModalColor = false;
    public $colorables = [], $coloresHerrajes=[];


    public function mount()
    {
        $this->actualizarColorRgba();
        $this->colorables = Util::getArray('colorables');
        $this->coloresHerrajes = DB::table('colors')->where('IdColorable',5)->pluck('color', 'id');
    }
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['colorHex', 'opacidad'])) {
            $this->actualizarColorRgba();
        }
    }
    public function actualizarColorRgba()
    {
        $hex = ltrim($this->colorHex, '#');
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        $a = $this->opacidad / 100;
        $this->colorRgba = "rgba($r, $g, $b, $a)";
    }

    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';
        $colors = Color::with('colorable')
            ->where(function($query) use ($keyWord) {
                $query->where('color', 'LIKE', $keyWord)
                    ->orWhere('colorHex', 'LIKE', $keyWord);
            })
            ->orderBy('IdColorable')
            ->get()
            ->groupBy('IdColorable');
        return view('livewire.colors.view', compact('colors'));
    }

    public function resetInput()
    {
        $this->selected_id = null;
        $this->color = null;
        $this->IdColorHerraje = null;
        $this->colorHex = null;
        $this->opacidad = 100;
        $this->IdColorable = null;
    }

    public function cancel()
    {
        $this->resetInput();
        $this->verModalColor = false;
    }

    public function create()
    {
        $this->resetInput();
        $this->verModalColor = true;
    }

    public function edit($id)
    {
        $record = Color::findOrFail($id);
        $this->selected_id = $record->id;
        $this->color = $record->color;
        $this->IdColorHerraje = $record->IdColorHerraje;
        $this->colorHex = $record->colorHex;
        $this->colorRgba = $record->colorRgba;
        $this->IdColorable = $record->IdColorable;
        // Extraer opacidad desde rgba
        if (preg_match('/rgba\(\d+,\s*\d+,\s*\d+,\s*(\d*\.?\d+)\)/', $record->colorRgba, $match)) {
            $this->opacidad = round(floatval($match[1]) * 100);
        }
        $this->verModalColor = true;
    }

    public function save()
    {
        $this->validate([
            'color' => 'required',
            'colorHex' => 'required',
            'opacidad' => 'required|integer|min:0|max:100',
            'IdColorable' => 'required',
        ]);

        $hex = ltrim($this->colorHex, '#');
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        $a = $this->opacidad / 100;
        $rgba = "rgba($r, $g, $b, $a)";

        Color::updateOrCreate(
            ['id' => $this->selected_id],
            [
                'IdColorable' => $this->IdColorable,
                'color' => $this->color,
                'IdColorHerraje' => $this->IdColorHerraje,
                'colorHex' => $this->colorHex,
                'colorRgba' => $rgba,
            ]
        );

        $this->cancel();
    }

    public function destroy($id)
    {
        if ($id) Color::destroy($id);
    }
}
