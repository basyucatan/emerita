@section('title', __('Precios'))
<div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="cardPrin">
                    <div class="cardPrin-header">
                        <div>Ficha del Material</div>
                        <div style="font-size: 14px;">
                        <button wire:click="costosPDF('sin')" class="bot botMenu" title="Sin costos">🖨️❌💲</button>
                        <button wire:click="costosPDF('con')" class="bot botVerde" title="Con costos">🖨️✅💲</button>
                        </div>
                    </div>
                    <div class="cardPrin-body">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <livewire:arbolclasesmats />
                            </div>
                            <div class="col-12 col-lg-9">
                                <div class="inpSolo mb-2">
                                    <div class="row align-items-center">
                                        <div class="col-md-10">
                                            <h5 class="mb-0">
                                                {{ $material->Linea->linea ?? '' }}
                                                - {{ $material->referencia ?? '' }}
                                                | {{ $material->material ?? '' }}
                                            </h5>
                                        </div>
                                        <div class="col-md-2 imgWrapper text-end">
                                            @if ($material?->foto)
                                                @php
                                                    $marca = rawurlencode($material->Linea->Marca->marca);
                                                    $foto  = rawurlencode($material->foto);
                                                    $ruta  = asset("storage/materiales/{$marca}/{$foto}");
                                                @endphp
                                                <img src="{{ $ruta }}" class="ImgExpandible" data-src="{{ $ruta }}">
                                            @else
                                                <span>-</span>
                                            @endif
                                            <div id="ImgModal" class="imgModal" style="display:none;" wire:ignore.self>
                                                <div class="imgModalContent">
                                                    <img id="ImgModalImg" src="" alt="Imagen expandida">
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div id="catalogo-center" style="width: 100%; height: 70%; overflow-y: hidden;">
                                    <div class="tab-container">
                                        <div class="tab-headers">
                                            <button wire:click="$set('tabActivo', 'tab1')"
                                                class="tab-button {{ $tabActivo === 'tab1' ? 'active' : '' }}"
                                                data-tab="tab1">Costos</button>
                                            <button wire:click="$set('tabActivo', 'tab2')"
                                                class="tab-button {{ $tabActivo === 'tab2' ? 'active' : '' }}"
                                                data-tab="tab2">Dependencias</button>
                                        </div>
                                        <div style="overflow-y: none; height: 85vh; min-height: 250px; padding-bottom: 3rem;">
                                            <div class="tab-content-wrapper">
                                                <div id="tab1" class="tab-content {{ $tabActivo === 'tab1' ? 'active' : '' }}">
                                                    @livewire('materialscostos', ['IdMaterial' => $IdMaterial], key('materialscostos-' . $IdMaterial))
                                                </div>
                                                <div id="tab2" class="tab-content {{ $tabActivo === 'tab2' ? 'active' : '' }}">
                                                    @include('livewire.fichamats.dependencias')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
