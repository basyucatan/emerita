<div class="table-responsive" style="max-height: 50vh; overflow-y: auto;">
    @include('livewire.estructura.modalservidor')
    <table class="table tabBase ch">
        <thead>
            <tr>
                <th style="width:30%">Servidor</th>
                <th style="width:50%">Servicio/Comité</th>
                <th style="width:20%">Acc</th>
            </tr>
        </thead>                            
        <tbody>
            @forelse ($servidores as $row)
            <tr>
                <td>{{ $row->servidorCorto }}</td>
                <td>
                    {{ $row->Servicio->abreviatura }}
                    {{ in_array($row->Comite?->abreviatura, 
                        [null, 'MED', 'MEA','DEL']) ? '' : $row->Comite->abreviatura }}
                    @if(!empty($row->ComiteCanalizado?->abreviatura))
                        / {{ $row->ComiteCanalizado->abreviatura }}
                    @endif
                    @if(!empty($row->telefono) && ($row->IdDistrito == 100))
                        📞 {{ $row->telefono }}
                    @endif
                    @auth
                        @if(!empty($row->telefono) && auth()->user()->can('admin'))
                            📞 {{ $row->telefono }}
                        @endif
                    @endauth
                </td>
                <td>
                    <div class="d-flex justify-content-around align-items-center gap-1">
                        <button wire:click="editServidor({{ $row->id }})" class="bot botNaranja"
                            title="Editar">
                            <i class="bi-pencil-square"></i>
                        </button>
                        <button wire:click="destroyServidor({{ $row->id }})" class="bot botRojo"
                            onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                            <i class="bi-trash3-fill"></i>
                        </button>
                    </div>
                </td>                  
            </tr>
            @empty
            @endforelse            
        </tbody>
    </table>
</div>