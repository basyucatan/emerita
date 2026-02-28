@section('title', __('Modelos'))

<div style="width: 100%;">
    <div class="cardPrin" style="height: 100%; overflow-y: auto;">
        <div class="cardPrin-body">
            @include('livewire.modelospres.modals')
            @if ($modelopre)
                <div class="cardPrin">
                    @if (session()->has('message'))
                        <div wire:poll.2s
                            class="btn btn-sm {{ session('status') === 'success' ? 'btn-success' : 'btn-danger' }}">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="cardPrin-header">
                        <div>
                            {{ $modelopre->Modelo->Linea->linea . '-' . 
                                $modelopre->Modelo->modelo.' | '.
                                sprintf('%02d', $modelopre->consecutivo).
                                '-'.$modelopre->ubicacion }}
                            @if ($modelopre->ruta())
                                <img src="{{ $modelopre->ruta() }}?v={{ now()->timestamp }}" alt="foto"
                                    style="width: auto; height: 40px; object-fit: contain;">
                            @else
                                <span>Sin foto</span>
                            @endif
                        </div>
                        <div style="color: #000; font-size: 14px;">
                            <strong>H= {{ $modelopre->ancho }}, V= {{ $modelopre->alto }}
                                @if (!empty($modelopre->divisiones))
                                    | 
                                    @foreach ($modelopre->divisiones as $clave => $valor)
                                        {{ $clave }}={{ $valor }}{{ !$loop->last ? ',' : '' }}
                                    @endforeach
                                    <br>
                                @endif
                            </strong>
                            <strong>Perfil: </strong>
                            <span class="cuadroColor"
                                style="background-color: {{ $modelopre->colorPerfil->colorRgba ?? '#fff' }};"
                                title="{{ $modelopre->colorPerfil->color ?? '' }}">
                            </span>
                            <strong>{{ $modelopre->vidrio->vidrio ?? '' }} {{ $modelopre->vidrio->grosor ?? '' }}mm</strong>
                            <span class="cuadroColor"
                                style="background-color: {{ $modelopre->colorVidrio->colorRgba ?? '#fff' }};"
                                title="{{ $modelopre->colorVidrio->color ?? '' }}">
                            </span>
                            <strong>Herraje: </strong>
                            <span class="cuadroColor"
                                style="background-color: {{ $modelopre->colorPerfil->colorHerraje->colorRgba ?? '#fff' }};"
                                title="{{ $modelopre->colorPerfil->colorHerraje->color ?? '' }}">
                            </span>
                            @if($modelopre->presupuesto->estatus === 'edicion')
                                <a class="bot botNaranja" wire:click="edit({{ $modelopre->id }})"><i class="bi-pencil-square"></i></a>
                            @endif
                            @canany(['adminMax', 'borrarNormal'])
                                <a class="bot botRojo" wire:click="guardarEnMod()" 
                                title="Guardar en Modelo"><i class="bi-upload"></i></a>
                            @endcan
                        </div>
                    </div>

                    <div class="cardPrin-body">
                        @livewire('modelopremats', ['IdModeloPre' => $IdModeloPre], 
                            key('modelopremats-' . $IdModeloPre))
                    </div>
                </div>
            @else
                <p>Sin datos</p>
            @endif

        </div>
    </div>
</div>
