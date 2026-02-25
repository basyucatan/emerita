@section('title', __('Distritos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('livewire.estructura.modaldistrito')
            <div class="cardSec">
                <div class="cardSec-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Distrito {{ $distritoObj->distrito }}° ({{ $distritoObj->panel }})</div>
                        <div class="d-flex justify-content-around align-items-center gap-1">
                            @if ($distritoObj->gmaps)
                                <a href="{{ $distritoObj->gmaps }}" class="bot botRojo ms-2 me-2" target="_blank">
                                    <i class="fas fa-map-marker-alt"></i>
                                </a>
                            @endif
                            <button wire:click="editDistrito({{ $distritoObj->id }})" class="bot botNaranja" title="Editar">
                                <i class="bi-pencil-square"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="cardSec-body">
                    <div class="table-responsive">
                        <table class="table tabBase ch">
                            <thead>
                                <tr>
                                    <th style="width:65%">Dirección</th>
                                    <th style="width:35%">MCD</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $distritoObj->direccion }}</td>
                                    <td>
                                        {{ $distritoObj->Mcd->servidorCorto ?? '' }}<br>
                                        📞{{ $distritoObj->Mcd->telefono ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @include('livewire.estructura.tabs')
                </div>
            </div>
        </div>
    </div>
</div>
