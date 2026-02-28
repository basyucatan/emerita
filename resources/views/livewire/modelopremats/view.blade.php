@section('title', __('Modelosmats'))
<div class="cardSec">
    <div id="dropzone-modelo" class="soltar" ondragover="handleDragOver(event)" ondrop="handleDrop(event)"
        data-accepts="modelo" data-vista="modelopremats">
        🪟 Aquí puedes agregar todos los materiales de otro modelo !
    </div>
    <div id="dropzone-material" class="soltar" ondragover="handleDragOver(event)" ondrop="handleDrop(event)"
        data-accepts="material" data-vista="modelopremats">
        📦 Aquí puedes agregar un nuevo material !
    </div>
    <div class="cardSec-header" style="grid-template-columns: 40% 30% 30%;">
        <div>Costos<span>{{ \App\Models\Util::Dinero($costoMat, 2) }}</span></div>
        <div>
            <input wire:model.live='keyWord' type="text" class="inpSolo" name="search" id="search"
                placeholder="Buscar">
        </div>
        <div class="d-flex justify-content-around gap-1">
            @if($estatusPre === 'edicion')
                <a class="bot botNaranja" wire:click="calculaDep" title="Costear"><i class="bi-calculator"></i></a>
            @endif
            <a wire:click="imprimir" class="bot botVerde" wire:loading.attr="disabled" wire:target="imprimir">
                <span wire:loading.remove wire:target="imprimir"><i class="bi bi-printer"></i></span>
                <span wire:loading wire:target="imprimir">⏳</span>
            </a>
        </div>
    </div>

    <div class="cardSec-body">
        <div style="overflow-y: auto; height: 65vh; min-height: 250px; padding-bottom: 3rem;">
            <div class="table-responsive">
                <table class="table tabBase">
                    <thead class="thead" style="position: sticky; top: 0; background-color: white; z-index: 1;">
                        <tr>
                            <th style="text-align: left;">#</th>
                            <th style="text-align: left;">Material</th>
                            <th style="text-align: center;">Pos</th>
                            <th style="text-align: center;">Clase</th>
                            <th style="text-align: left;">Tipo</th>
                            <th style="text-align: left;">Obs</th>
                            <th style="text-align: center;">Acciones</th>
                            <th style="text-align: left;">Cant</th>
                            <th style="text-align: left;">Fórmula</th>
                            <th style="text-align: left;">Dimensiones</th>
                            <th style="text-align: right;">Costo</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($modelopremats as $row)
                            @php
                                $imgPos = match ($row->posicion) {
                                    'H' => 'horizontal.png',
                                    'V' => 'vertical.png',
                                    default => null,
                                };

                                $imgClase = match (strtolower($row->material->clase->id ?? '')) {
                                    '1' => 'perfil.png',
                                    '2' => 'vidrio.png',
                                    '3' => 'herraje.png',
                                    '4' => 'accesorios.png',
                                    '5' => 'consumibles.png',
                                    '6' => 'fijacion.png',
                                    '7' => 'otro.png',
                                    default => null,
                                };
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>                               
                                <td wire:click="cargarMaterial({{ $row->material->id }})"
                                    style="cursor: pointer; user-select: none;">
                                    {{ $row->material->material ?? '' }}
                                    @if (!empty($row->materialCosto?->referencia))
                                        ({{ $row->materialCosto->referencia }})
                                    @endif
                                    @if (!empty($row->IdTablaHerraje))
                                        [ {{ $row->cantidadHerraje }}
                                        <img src="{{ asset('img/clases/herraje.png') }}" alt="Herraje" width="16"
                                            style="margin-left: 4px; vertical-align: middle;">]
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    @if ($imgPos)
                                    <img src="{{ asset('img/clases/' . $imgPos) }}" alt="{{ $row->posicion }}"
                                    width="16">
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    @if ($imgClase)
                                    <img src="{{ asset('img/clases/' . $imgClase) }}"
                                    alt="{{ $row->material->clase->clase ?? '' }}" width="16">
                                    @endif
                                </td>
                                @php
                                    $colorHex = $row->materialCosto->color->colorHex ?? null;
                                    $estiloColor = $colorHex ? "background-color: $colorHex;" : "";
                                    $esOscuro = false;
                                    if ($colorHex) {
                                        $hex = ltrim($colorHex, '#');
                                        $r = hexdec(substr($hex, 0, 2));
                                        $g = hexdec(substr($hex, 2, 2));
                                        $b = hexdec(substr($hex, 4, 2));
                                        $luminancia = ($r * 0.299 + $g * 0.587 + $b * 0.114) / 255;
                                        if ($luminancia < 0.5) $esOscuro = true;
                                    }
                                @endphp
                                <td style="{{ $estiloColor }} {{ $esOscuro ? 'color: white;' : '' }}">
                                    {{ $row->tipo->tipo ?? '' }}
                                </td>                                
                                <td>{{ $row->diferenciador }}</td>
                                <td width="80">
                                    <div class="d-flex justify-content-around gap-1">
                                        @if($estatusPre === 'edicion')
                                            <a wire:click="destroy({{ $row->id }})" class="bot botRojo"
                                                onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                                                <i class="bi-trash3-fill"></i>
                                            </a>
                                            <a wire:click="edit({{ $row->id }})" class="bot botNaranja" title="Editar">
                                                <i class="bi-pencil-square"></i>
                                            </a>
                                        @else
                                            <span class="text-black small">🔒 Cerrado</span>
                                        @endif                                        
                                    </div>
                                </td>                                 
                                <td style="{{ $row->principal ? 'background-color: LightGreen;' : '' }}">
                                    {{ $row->cantidad }}
                                </td>
                                <td style="{{ $row->errFormula ? 'background-color: #ffe6e6;' : '' }}">
                                    <span style="{{ $row->errFormula ? 'color: red; font-weight: bold; border-bottom: 1px dotted red;' : '' }}">
                                        {{ $row->formula }}
                                    </span>
                                </td>
                                <td>
                                    {{ $row->Dims }}
                                </td>
                                @php
                                    $esErrorPrecio = $row->adicionales['errPrecio'] ?? false;
                                    $esParcial = $row->adicionales['errCoincideParcial'] ?? false;
                                    $estiloTd = 'text-align: right;';
                                    if ($esErrorPrecio) $estiloTd .= ' background-color: #ffe6e6;';
                                    elseif ($esParcial) $estiloTd .= ' background-color: #fff3e0;';
                                    $estiloSpan = 'text-align: right;';
                                    if ($esErrorPrecio) $estiloSpan .= ' color: red; font-weight: bold; border-color: red;';
                                    elseif ($esParcial) $estiloSpan .= ' color: #e67e22; font-weight: bold; border-color: #e67e22;';
                                @endphp
                                <td style="{{ $estiloTd }}" title="{{ $row->tipCosto }}">
                                    <span style="{{ $estiloSpan }}">
                                        {{ App\Models\Util::Miles($row->costo, 0) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">Sin datos disponibles</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('livewire.modelopremats.modals')
</div>
