@section('title', __('Tablaherrajes'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4" style="height: 80vh; overflow-y: hidden;">
                    @include('livewire.tablaherrajes.arboles')
                </div>
                <div class="col-md-8">
                    <div class="cardSec-body">
                        <div id="catalogo-center" style="width: 100%; height: 80vh; overflow-y: hidden;">
                            <div class="tab-container">
                                <div class="tab-headers">
                                    <button wire:click="$set('tabActivo', 'tab1')"
                                        class="tab-button {{ $tabActivo === 'tab1' ? 'active' : '' }}"
                                        data-tab="tab1">Tabla</button>
                                    <button wire:click="$set('tabActivo', 'tab2')"
                                        class="tab-button {{ $tabActivo === 'tab2' ? 'active' : '' }}"
                                        data-tab="tab2">Dependencias</button>
                                </div>
                                <div style="overflow-y: none; height: 85vh; min-height: 250px; padding-bottom: 3rem;">
                                    <div class="tab-content-wrapper">
                                        <div id="tab1" class="tab-content {{ $tabActivo === 'tab1' ? 'active' : '' }}">
                                            @livewire('tablaherrajesdets', ['IdTablaHerraje' => $selected_id], 
                                                key('tablaherrajesdets-' . $selected_id))
                                        </div>
                                        <div id="tab2" class="tab-content {{ $tabActivo === 'tab2' ? 'active' : '' }}">
                                            @include('livewire.tablaherrajes.modelosdep')
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
