    <div style="width: 100%; height: auto; max-height: 60%; overflow-y: auto;">
        <div class="tab-container">
            <!-- ENCABEZADOS DE PESTAÑAS -->
            <div class="tab-headers">
                <button wire:click="$set('tabActivo', 'tab1')"
                    class="tab-button {{ $tabActivo === 'tab1' ? 'active' : '' }}"
                    data-tab="tab1">Grupos</button>
                <button wire:click="$set('tabActivo', 'tab2')"
                    class="tab-button {{ $tabActivo === 'tab2' ? 'active' : '' }}" 
                    data-tab="tab2">Servidores</button>
            </div>
            <!-- CONTENIDO DE PESTAÑAS -->
            <div style="overflow-y: none; height: auto; min-height: 250px; padding-bottom: 3rem;">
                <div class="tab-content-wrapper">
                    <div id="tab1" class="tab-content {{ $tabActivo === 'tab1' ? 'active' : '' }}">
                        @include('livewire.estructura.grupos')
                    </div>
                    <div id="tab2" class="tab-content {{ $tabActivo === 'tab2' ? 'active' : '' }}">
                        @include('livewire.estructura.servidores')
                    </div>
                </div>
            </div>
        </div>
    </div>