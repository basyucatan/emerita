<li class="mb-1">
    <div class="d-flex align-items-center">
        <span style="cursor:pointer; user-select:none;"
              wire:click="toggle('{{ $tipo }}', {{ $nodo['id'] }})">

            @if($hijos->count() > 0)
                {{ $expanded ? '🔼' : '🔽' }} {{ $texto }}
            @else
                🔵 {{ $texto }}
            @endif
        </span>
    </div>
    @if($expanded && $hijos->count() > 0)
        <ul class="list-unstyled ps-3 mt-1">
            @foreach($hijos as $grp)
                @php
                    $rsg = trim($grp['RSG'] ?? '');
                    $partes = preg_split('/\s+/', $rsg);
                    $rsgCorto = $partes[0] ?? 'N/A';

                    if (count($partes) > 1) {
                        $rsgCorto .= ' ' . strtoupper(substr($partes[1], 0, 1)) . '.';
                    }
                @endphp

                <li>
<span
    style="cursor:pointer; user-select:none;"
    wire:click="elegir('Grupo', {{ $grp['id'] }})"
>
    🔴 {{ $grp['grupo'] }}
</span>

                </li>
            @endforeach
        </ul>
    @endif
</li>
