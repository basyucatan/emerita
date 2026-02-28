@section('title', __('Cortes'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Cortes</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="form-control" placeholder="Buscar">
                        </div>
                        <a wire:click.prevent="create('Cortes')" class="bot botVerde" 
                            title="Generar Cortes"><i class="bi bi-diagram-3"></i></a>                                
                    </div>
                </div>
                <div class="cardPrin-body">
                    @include('livewire.traspasos.modals')
                </div>
            </div>
        </div>
    </div>
</div>
