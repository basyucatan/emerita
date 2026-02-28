@section('title', __('Modelosmats'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardSec">
                <div class="cardSec-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Materiales</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="form-control" placeholder="Buscar">
                        </div>
                    </div>
                </div>
                <div class="cardSec-body">
                    @include('livewire.modelosmats.modals')
                    <div class="table-responsive" style="overflow-y: auto; height: 75vh; min-height: 50vh;">
                        <table class="table tabBase">
                            <thead class="thead" style="position: sticky; top: 0; z-index: 1;">
                                <tr>
                                    <th style="text-align: left;">#</th>
                                    <th style="text-align: center;">Acciones</th>
                                    <th style="text-align: left;">Material</th>
                                    <th style="text-align: center;">Pos</th>
                                    <th style="text-align: center;">Clase</th>
                                    <th style="text-align: left;">Tipo</th>
                                    <th style="text-align: left;">Obs</th>
                                    <th style="text-align: left;">Cant</th>
                                    <th style="text-align: left;">Fórmula</th>
                                    <th style="text-align: left;">Dimensiones</th>
                                    <th style="text-align: right;">Costo</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($modelosmats as $row)
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
                                        <td width="80">
                                            <div class="d-flex justify-content-around gap-1">
                                                <a wire:click="destroy({{ $row->id }})" class="bot botRojo"
                                                    onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                                                    <i class="bi-trash3-fill"></i>
                                                </a>
                                                <a wire:click="edit({{ $row->id }})" class="bot botNaranja" title="Editar">
                                                    <i class="bi-pencil-square"></i>
                                                </a>
                                            </div>
                                        </td>                                
                                        <td style="cursor: pointer; user-select: none;">
                                            {{ $row->material->material ?? '' }}
                                            @if (!empty($row->material?->referencia))
                                                ({{ $row->material->referencia }})
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
                                        <td>{{ $row->tipo->tipo ?? '' }}</td>
                                        <td>{{ $row->diferenciador }}</td>
                                        <td style="{{ $row->principal ? 'background-color: LightGreen;' : '' }}">
                                            {{ $row->cantidad }}
                                        </td>
                                        <td>
                                            {{ $row->formula }}
                                        </td>
                                        <td style="{{ $row->errFormula ? 'font-weight: bold; color: red;' : '' }}">
                                            {{ $row->Dims }}
                                        </td>
                                        <td style="text-align: right;" title="{{ $row->tipCosto }}"
                                            class="{{ str_starts_with($row->tipCosto, 'No se encontró') ? 'text-danger fw-bold' : '' }}">
                                            {{ App\Models\Util::Miles($row->costo, 0) }}
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
        </div>
    </div>
</div>
