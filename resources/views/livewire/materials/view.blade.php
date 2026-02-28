@section('title', __('Materials'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    <div>
                        {{ $Linea->linea ?? '' }} | {{ $material }}
                    </div>
                    <div>
                        @if ($fotoUrl)
                            <img src="{{ $fotoUrl }}?v={{ now()->timestamp }}" 
                                data-src="{{ $fotoUrl }}?v={{ now()->timestamp }}" 
                                class="ImgExpandible img-fluid border rounded mb-2">
                        @else
                            <span>-</span>
                        @endif
                        <div id="ImgModal" class="imgModal" style="display: none;">
                            <div class="imgModalContent">
                                <img id="ImgModalImg" src="" alt="Imagen expandida">
                            </div>
                        </div>
                        <a class="bot botNaranja" wire:click="edit"><i class="bi-pencil-square"></i></a>
                    </div>
                </div>
                <div class="cardPrin-body">
                    <div id="dropzone-material" class="soltar" ondragover="handleDragOver(event)"
                        ondrop="handleDrop(event)" data-accepts="material" data-vista="materials">
                        📦 Aquí puedes cargar un material !
                    </div>
                    <table class="table tabBase">
                        <thead class="thead" style="position: sticky; top: 0; z-index: 1;">
                            <tr>
                                <th style="text-align: left;">Marca</th>
                                <th style="text-align: left;">Clase</th>
                                <th style="text-align: left;">Tipo Perfil</th>
                                <th style="text-align: center;">Unidad Costeo</th>
                                <th style="text-align: left;">Ref.</th>
                                <th style="text-align: left;">Ancho Lama</th>
                                <th style="text-align: center;">Rendimiento</th>
                                <th style="text-align: center;">Unidad Rend.</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $imgClase = match (strtolower($materials->clase->id ?? '')) {
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
                                <td>{{ $Linea->Marca->marca ?? null }}</td>
                                <td style="text-align: center;">
                                    @if ($imgClase)
                                        <img src="{{ asset('img/clases/' . $imgClase) }}" width="16">
                                    @endif
                                    {{ $materials->clase->clase }}
                                </td>
                                <td>{{ $materials->Tipo->tipo ?? null }}</td>
                                <td style="text-align: center;">{{ $materials->Unidad->unidad ?? null }}</td>
                                <td>{{ $materials->referencia }}</td>
                                <td>{{ $materials->adicionales['anchoLama'] ?? ''}}</td>
                                <td style="text-align: right;">{{ $materials->rendimiento }}</td>
                                <td style="text-align: center;">{{ $materials->UnidadRend->unidad ?? null }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @include('livewire.materials.modals')
                    <div>
                        @livewire('materialscostos', ['IdMaterial' => $selected_id, 'padre' => 'materials'],
                            key('materialscostos-' . $selected_id))
                        @livewire('reglas', ['IdMaterial' => $selected_id], key('reglas-' . $selected_id))
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
