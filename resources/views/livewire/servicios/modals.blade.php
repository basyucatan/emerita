@if($verModalServicio)
    <div class="modal-overlay">
        <div x-data="{}" x-init="dragModal($el)" 
            class="modal-dialog" style="width: 80%;"wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardMovil-header">
                        {{ $selected_id ? 'Editar Servicio' : 'Crear Servicio' }}
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            <div class="row">
                                @if ($selected_id)
                                    <input type="hidden" wire:model="selected_id">
                                @endif
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="servicio" class="etiBase">Servicio</label>
                                    <input wire:model="servicio" type="text" class="inpBase" id="servicio">@error('servicio') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="abreviatura" class="etiBase">Abreviatura</label>
                                    <input wire:model="abreviatura" type="text" class="inpBase" id="abreviatura">@error('abreviatura') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="orden" class="etiBase">Orden</label>
                                    <input wire:model="orden" type="text" class="inpBase" id="orden">@error('orden') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
</div></form>
                    </div>
                    <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
                        <button wire:click.prevent="cancel()" class="bot botNegro">Cerrar</button>
                        <button wire:click.prevent="save()" class="bot botVerde">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif