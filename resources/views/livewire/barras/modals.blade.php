@if($verModalBarra)
    <div class="modal-overlay">
        <div class="modal-dialog" style="width: 80%;">
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar Barra' : 'Crear Barra' }}
                        </h5>
                        <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            @if ($selected_id)
                                <input type="hidden" wire:model="selected_id">
                            @endif
                    <div class="form-group">
                        <label for="longitud" class="etiBase">Longitud</label>
                        <input wire:model.live="longitud" type="text" class="inpBase" id="longitud" placeholder="Longitud">@error('longitud') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="etiBase">Descripcion</label>
                        <input wire:model.live="descripcion" type="text" class="inpBase" id="descripcion" placeholder="Descripcion">@error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
</form>
                    </div>
                    <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
                        <a wire:click.prevent="cancel()" class="bot botCancel">Cerrar</a>
                        <a wire:click.prevent="save()" class="bot botVerde">Guardar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif