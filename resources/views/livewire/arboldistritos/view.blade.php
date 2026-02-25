<div class="container-fluid">
    <div class="cardSec">
        <div class="cardSec-header">
            <div class="d-flex gap-2 mb-2">
                <input wire:model.live="keyWord"
                       class="form-control form-control-md"
                       placeholder="Buscar">
                <button class="bot botVerde px-2" wire:click="borrarKeyWord">
                    x
                </button>
                <button class="bot botBlanco px-2" wire:click="$toggle('mostrarRaiz')">
                    {{ $mostrarRaiz ? '🔼' : '🔽' }}
                </button>
            </div>
        </div>

        <div class="cardSec-body" style="max-height:60vh; overflow-y:auto;">
            @if($mostrarRaiz)
                <ul class="list-unstyled">
                    @foreach($arbol as $dist)
                        @php
                            $expanded = $expand['Distrito'][$dist['id']] ?? false;
                            $hasChildren = !empty($dist['grupos']);
                        @endphp

                        @include('livewire.arboldistritos.nodo', [
                            'tipo'     => 'Distrito',
                            'nodo'     => $dist,
                            'texto'    => $dist['distrito'].'°',
                            'expanded' => $expanded,
                            'hijos'    => collect($dist['grupos'] ?? [])
                        ])
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
