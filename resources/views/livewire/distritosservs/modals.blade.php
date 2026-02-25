@if($verModalDistritosserv)
    <div class="modal-overlay">
        <div x-data="{}" x-init="dragModal($el)" 
            class="modal-dialog" style="width: 80%;"wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardMovil-header">
                        {{ $selected_id ? 'Editar Distritosserv' : 'Crear Distritosserv' }}
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            <div class="row">
                                @if ($selected_id)
                                    <input type="hidden" wire:model="selected_id">
                                @endif
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="IdDistrito" class="etiBase">Iddistrito</label>
                                    <input wire:model="IdDistrito" type="text" class="inpBase" id="IdDistrito">@error('IdDistrito') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="IdServicio" class="etiBase">Idservicio</label>
                                    <input wire:model="IdServicio" type="text" class="inpBase" id="IdServicio">@error('IdServicio') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="IdComite" class="etiBase">Idcomite</label>
                                    <input wire:model="IdComite" type="text" class="inpBase" id="IdComite">@error('IdComite') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="IdComiteCan" class="etiBase">Idcomitecan</label>
                                    <input wire:model="IdComiteCan" type="text" class="inpBase" id="IdComiteCan">@error('IdComiteCan') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="servidor" class="etiBase">Servidor</label>
                                    <input wire:model="servidor" type="text" class="inpBase" id="servidor">@error('servidor') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="telefono" class="etiBase">Telefono</label>
                                    <input wire:model="telefono" type="text" class="inpBase" id="telefono">@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="asamblea1" class="etiBase">Asamblea1</label>
                                    <input wire:model="asamblea1" type="text" class="inpBase" id="asamblea1">@error('asamblea1') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="asamblea2" class="etiBase">Asamblea2</label>
                                    <input wire:model="asamblea2" type="text" class="inpBase" id="asamblea2">@error('asamblea2') <span class="error text-danger">{{ $message }}</span> @enderror
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