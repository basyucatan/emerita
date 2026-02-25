<div class="row g-1">
    @foreach($servidores as $comiteId => $grupo)
        @php
            $primerServ = $grupo->first();
        @endphp
        @if($primerServ && $primerServ->Comite)
            <div class="col-12">
                <h5 class="mt-3 mb-2">
                    {{ $primerServ->Comite->comite }} 
                </h5>
            </div>
        @endif

        @foreach($grupo as $serv)
            @if($serv) {{-- asegura que $serv no sea falso --}}
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="cardSec">
                        <div class="cardSec-header">
                            {{ $serv->servidorCorto ?? '' }}
                        </div>
                        <div class="cardSec-body">
                            {{ $serv->Servicio->servicio ?? '' }}<br>
                            {{ $serv->telefono ?? '' }}
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endforeach
</div>
