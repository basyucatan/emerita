<div class="cardPrin">
    <div class="cardPrin-header d-flex justify-content-between align-items-center">
        <span>#{{ $Pedido?->id }}</span>
        <button type="button" class="bot botNegro" wire:click="saveDets()">💾</button>
        <button type="button" class="bot botNaranja" wire:click="imprimir('LITERATURA')">🖨️L</button>
        <button type="button" class="bot botNegro" wire:click="imprimir('PLENITUD')">🖨️P</button>
        <button type="button" class="bot botRojo" 
            onclick="confirm('¿Confirmas el pedido?, ya no lo podrás editar') || event.stopImmediatePropagation()"
            wire:click="confirmar()">✔️</button>
        <span style="color: black; font-weight: bold;">
            $ {{ number_format($Pedido->total ?? 0, 2) }}
        </span>
    </div>

    <div class="cardPrin-body">
        @if ($Pedido)
            <table class="table tabBase ch">
                <thead>
                    <tr>
                        <th>Cant</th>
                        <th>Producto</th>
                        <th>PrecioU</th>
                        <th>Importe</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($Pedido->Pedidosdets as $row)
                        <tr>
                            <td width="40">
                                <input type="number" min="1" class="inpChico"
                                    wire:model.lazy="cantsDets.{{ $row->id }}">
                            </td>
                            <td>{{ mb_substr($row->Producto->producto, 0, 30) }}</td>
                            <td style="text-align: right;">{{ $row->precioU }}</td>
                            <td style="text-align:right">
                                {{ number_format(
                                    ($cantsDets[$row->id] ?? $row->cantidad) * $row->precioU,
                                    2
                                ) }}
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        @endif
    </div>
</div>
