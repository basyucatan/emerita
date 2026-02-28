<li class="mb-1">
    <div class="d-flex align-items-center">
        <span style="cursor:pointer; user-select:none;"
              wire:click="toggle('{{ $tipo }}', {{ $nodo['id'] }})">
            @if($hijos->count() > 0)
                {{ $expanded ? '🔼' : '🔽' }} {{ $texto }}
            @else
                🔴 {{ $texto }}
            @endif
        </span>      
    </div>
    @if($expanded && $hijos->count() > 0)
        <ul class="list-unstyled ps-3 mt-1">
            @foreach($hijos as $mat)
                @php
                    $expandedMat = $expand['Material'][$mat['id']] ?? false;
                @endphp
                <li>
                    <span style="cursor:pointer; user-select:none;"
                          wire:click="elegir('Material', {{ $mat['id'] }})">
                        🔴 {{ $mat['material'] }} {{ $mat['referencia'] }}
                    </span>
                </li>
            @endforeach
        </ul>
    @endif
</li>
