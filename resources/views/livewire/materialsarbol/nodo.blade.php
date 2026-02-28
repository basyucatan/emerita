@php
    $nivelActual = $nivelActual ?? 1;
    $maxNivel = $nivel ?? 4;

    if ($nodo instanceof \App\Models\Marca) {
        $tipoActual = 'Marca';
        $nombre = $nodo->marca;
        $hijos = $maxNivel >= 2 ? $nodo->lineas : collect();
        $tipoCrear = $maxNivel >= 2 ? 'Linea' : null;
    } elseif ($nodo instanceof \App\Models\Linea) {
        $tipoActual = 'Linea';
        $nombre = $nodo->linea;
        $hijos = $maxNivel >= 3 ? $nodo->materials : collect();
        $tipoCrear = $maxNivel >= 3 ? 'Material' : null;
    } elseif ($nodo instanceof \App\Models\Material) {
        $tipoActual = 'Material';
        $nombre = $nodo->material;
        $hijos = $maxNivel >= 4 ? $nodo->Materialscostos : collect();
        $tipoCrear = $maxNivel >= 4 ? 'Materialscosto' : null;
    } elseif ($nodo instanceof \App\Models\Materialscosto) {
        $tipoActual = 'Materialscosto';
        $nombre = $nodo->referencia ?? 'Sin referencia';
        $hijos = collect();
        $tipoCrear = null;
    }
    $id = $nodo->id;
    $esExpandido = $expandido[$tipoActual][$id] ?? false;

    // decidir si este nodo tiene doble click activo
    $dobleClick = false;
    if ($tipoActual === 'Material' && $maxNivel == 3) {
        $dobleClick = true;
    }
    if ($tipoActual === 'Materialscosto' && $maxNivel == 4) {
        $dobleClick = true;
    }
@endphp

<li>
    <div class="d-grid align-items-center" style="grid-template-columns:70% 30%;">
        @if ($hijos->count() > 0)
            <span style="cursor:pointer; user-select: none;"
                wire:click="toggleNodo('{{ $tipoActual }}', {{ $id }})"
                @if ($dobleClick) wire:dblclick="agregar('{{ $tipoActual }}', {{ $id }})" @endif>
                {{ $esExpandido ? '🔼' : '🔽' }} {{ $nombre }}
            </span>
        @else
            <span style="cursor:pointer; user-select: none;"
                @if ($dobleClick) wire:dblclick="agregar('{{ $tipoActual }}', {{ $id }})" @endif>
                🔴 {{ $nombre }}
            </span>
        @endif
        <div class="text-end">
            @if ($tipoCrear)
                <a wire:click="abrirCrear('{{ $tipoCrear }}', {{ $id }})" class="btnIcono">➕</a>
            @endif
            <a wire:click="abrirEliminar('{{ $tipoActual }}', {{ $id }})" class="btnIcono">❌</a>
        </div>
    </div>

    @if ($esExpandido && $hijos->count() > 0)
        <ul class="list-unstyled ps-3">
            @foreach ($hijos as $child)
                @include('livewire.materialsarbol.nodo', [
                    'nodo' => $child,
                    'nivelActual' => $nivelActual + 1,
                    'expandido' => $expandido,
                ])
            @endforeach
        </ul>
    @endif
</li>
