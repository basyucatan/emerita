    {{-- Modal Crear --}}
    @if($modalCrear)
        <div class="modal show d-block">
            <div class="modal-dialog">
                <div class="modal-content p-3">
                    <h5>Nuevo {{ $tipoNodo }}</h5>
                    <input type="text" wire:model="nombreNuevo" class="form-control" placeholder="Nombre">
                    <div class="mt-3 text-end">
                        <button wire:click="guardarElemento" class="btn btn-primary">Guardar</button>
                        <button wire:click="$set('modalCrear', false)" class="btn btn-secondary">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Modal Eliminar --}}
    @if($modalEliminar)
        <div class="modal show d-block">
            <div class="modal-dialog">
                <div class="modal-content p-3">
                    <h5>Eliminar {{ $tipoNodo }}</h5>
                    <p>¿Seguro que deseas eliminar este elemento?</p>
                    <div class="mt-3 text-end">
                        <button wire:click="eliminarElemento" class="btn btn-danger">Eliminar</button>
                        <button wire:click="$set('modalEliminar', false)" class="btn btn-secondary">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
