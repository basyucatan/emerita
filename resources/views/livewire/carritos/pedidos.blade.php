<div class="cardPrin">
    <div class="cardPrin-header d-flex justify-content-between align-items-center">
        <span>Pedidos Pendientes</span>
        <span style="color: black; font-weight: bold;">
            {{ is_countable($pedsPends) ? count($pedsPends) : 0 }}
        </span>
        <button type="button" class="bot botVerde" wire:click="nuevoPedido">💾 Nuevo</button>
    </div>
    <div class="cardPrin-body">
        @if ($pedsPends)
            <table class="table tabBase ch">
                <thead>
                    <tr>
                        <th>#|Fecha-Dist</th>
                        <th>Nombre</th>
                        <th>Importe</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pedsPends as $row)
                        <tr
                            wire:click="elegirPedido({{ $row->id }})">
                            <td style="background-color: {{ $row->fondoPed }}">
                                {{ $row->id}} |
                                {{  \App\Models\Util::formatFecha($row->FechaH,'D/MMM') }}-
                                {{ $row->Distrito->distrito ?? ''}}
                            </td>
                            <td>{{ mb_substr($row->adicionales['nombre'], 0, 30) }}</td>
                            <td style="text-align: right;">{{ \App\Models\Util::Dinero($row->total) ?? 0}}</td>
                            <td width="30">
                                <button wire:click="borrarPedido({{ $row->id }})" class="bot botRojo"
                                    onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                                    <i class="bi-trash3-fill"></i>
                                </button>
                            </td>                            
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        @endif
    </div>
</div>
