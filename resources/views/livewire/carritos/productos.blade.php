<div class="cardPrin">
    <div class="cardPrin-header">
        <div class="d-flex justify-content-between align-items-center mb-2">
            #{{ $Pedido?->id }}
            <div style="width:30%;">
                <input wire:model.live.debounce.500ms="keyWord"
                    type="text" class="inpSolo" placeholder="Buscar">
            </div>
            <button type="button" class="bot botNegro" wire:click="saveProds">💾</button>
            <button class="bot botAzul" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtroOffCanvas"><i
                    class="bi bi-funnel-fill"></i> Filtros
            </button>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div class="d-flex flex-wrap gap-2">
                {{-- <strong>( {{ $Productos?->count() }} )</strong> --}}
                @if ($deptoSel)
                    <div class="bot botVerdeC botPill">
                        {{ mb_substr($deptoSel, 0, 3) }}
                        <button type="button" class="btn-close" wire:click="quitarFiltro('Depto')"></button>
                    </div>
                @endif
                @if ($IdClase)
                    <div class="bot botVerdeC botPill">
                        {{ mb_substr($clases[$IdClase], 0, 8) }}
                        <button type="button" class="btn-close" wire:click="quitarFiltro('Clase')"></button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div wire:ignore>
        <div class="offcanvas offcanvas-end filtrosOffcanvas" tabindex="-1" id="filtroOffCanvas">
            <div class="offcanvas-header d-flex align-items-center">
                <span>Filtrar productos</span>
                <button type="button" class="bot botNegro ms-auto" data-bs-dismiss="offcanvas">X</button>
            </div>
            <div class="offcanvas-body">
                <div class="filtro">
                    <label class="etiBase">Depto</label>
                    <select class="inpBase" wire:model="deptoSel" wire:change="elegirDepto">
                        <option value=""></option>
                        @foreach ($deptos as $k => $v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filtro">
                    <label class="etiBase">Clase</label>
                    <select class="inpBase" wire:model="IdClase">
                        <option value=""></option>
                        @foreach ($clases as $k => $v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="offcanvas-footer">
                <div class="d-flex gap-2">
                    <button class="bot botNegro" type="button" wire:click="aplicarFiltros(false)"
                        data-bs-dismiss="offcanvas">
                        Cerrar
                    </button>
                    <button class="bot botVerde" type="button" wire:click="aplicarFiltros" data-bs-dismiss="offcanvas">
                        Aplicar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="cardPrin-body">
        <table class="table tabBase ch">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>PrecioU</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @forelse($Productos as $row)
                    <tr wire:key="prod-{{ $row->id }}">
                        <td>{{ mb_substr($row->producto, 0, 30) }} ({{ $row->codigo }})</td>
                        <td style="text-align: right;">{{ $row->precioU }}</td>
                        <td width="40">
                            <input type="number" min="0" class="inpChico"
                                wire:model.debounce.500ms="cantsProds.{{ $row->id }}">
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
</div>
