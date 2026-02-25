@section('title', __('Mensajes'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Mensajes</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="form-control" placeholder="Buscar">
                        </div>
                        <div class="bot botVerde" wire:click="create" title="Nuevo Mensaje">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="cardPrin-body">
                    @include('livewire.mensajes.modals')
                    <div class="row g-1">
                        @forelse($mensajes as $row)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="cardSec">
                                    <div class="cardSec-header">
                                        <div style="display:flex; flex-direction:column;">
                                            <div>{{ $row->titulo }}</div>
                                            <div style="font-size: 12px;">
                                                Vigencia: {{ \App\Models\Util::formatFecha($row->fechaIni, 'D/MMM/AA') }}
                                                -{{ \App\Models\Util::formatFecha($row->fechaFin, 'D/MMM/AA') }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="cardSec-body">
                                        <div class="row g-1">
                                            <div class="col-4">
                                                @if ($row->foto)
                                                    <img src="{{ $row->fotoUrl }}" class="cardSecFoto border rounded">
                                                @else
                                                    <div class="text-muted">Sin foto</div>
                                                @endif
                                            </div>
                                            <div class="col-8">
                                                @if ($row->documento)
                                                    <embed src="{{ $row->docUrl }}#toolbar=0&navpanes=0&scrollbar=0"
                                                        type="application/pdf" style="width: 100%; height: 100px;"
                                                        class="border rounded">
                                                @else
                                                @endif
                                            </div>
                                            <div class="col-12 mt-2">{{ $row->contenido }}</div>
                                        </div>
                                    </div>

                                    <div class="cardSec-footer">
                                        <button wire:click="edit({{ $row->id }})" class="bot botNaranja"
                                            title="Editar">
                                            <i class="bi-pencil-square"></i>
                                        </button>
                                        <button wire:click="destroy({{ $row->id }})" class="bot botRojo"
                                            onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                                            <i class="bi-trash3-fill"></i>
                                        </button>
                                        @if ($row->documento)
                                            <a href="{{ $row->docUrl }}" class="bot botVerde mt-2" target="_blank"
                                                onclick="event.stopPropagation();">Descargar</a>
                                        @endif
                                        @if ($row->urlLink)
                                            <a href="{{ $row->urlLink }}" class="bot botAzul mt-2" target="_blank"
                                                onclick="event.stopPropagation();">Enlace</a>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        @empty
                            <p>No se encontraron datos</p>
                        @endforelse
                    </div>

                    <div class="float-end mt-2">
                        {{ $mensajes->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
