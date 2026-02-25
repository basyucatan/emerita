<div class="table-responsive" style="max-height: 50%; overflow-y: auto;">
    @include('livewire.estructura.modalgrupo')
    <table class="table tabBase ch">
        <thead>
            <tr>
                <th style="width:70%">Loc/Grupo | RSG</th>
                <th style="width:30%">Acc</th>
            </tr>
        </thead>                            
        <tbody>
            @php
            $gruposPorLocalidad = $grupos->groupBy(function ($item) {
                return strtoupper(trim($item->localidad));
            });
            @endphp
            @forelse ($gruposPorLocalidad as $localidad => $items)
                <tr class="table-secondary">
                    <td colspan="3"><strong>{{ $localidad }}</strong></td>
                </tr>
                @foreach ($items as $row)
                    <tr wire:key="grupo-{{ $row->id }}">
                        <td>
                            @if ($row->gmaps)
                                <a href="{{ $row->gmaps }}" class="bot botRojo ms-2 me-2" target="_blank">
                                    <i class="fas fa-map-marker-alt"></i>
                                </a>
                            @endif                            
                            {{ $row->grupo }}
                            @if(!empty($row->RSG))
                                | {{ $row->rsgCorto }}
                            @endif                            
                            @if(!empty($row->RSGSup))
                                , Sup. {{ $row->RSGSup }}
                            @endif
                        </td>
                        <td width="100">
                            <div class="d-flex justify-content-around align-items-center gap-1">
                                <button wire:click="editGrupo({{ $row->id }})" class="bot botNaranja"
                                    title="Editar">
                                    <i class="bi-pencil-square"></i>
                                </button>
                                <button wire:click="destroyGrupo({{ $row->id }})" class="bot botRojo"
                                    onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                                    <i class="bi-trash3-fill"></i>
                                </button>
                            </div>
                        </td>                        
                    </tr>
                @endforeach
            @empty
            @endforelse
        </tbody>
    </table>
</div>