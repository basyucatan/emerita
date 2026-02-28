@if($verModalLamina)
    <div class="modal-overlay"> 
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width: 80%;" wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin" style="cursor: move;">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar Lamina' : 'Crear Lamina' }}
                        </h5>
                        <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            <div class="row">
                                @if ($selected_id)
                                    <input type="hidden" wire:model="selected_id">
                                @endif
                                <div class="col-md-6">
                                    <label for="lamina" class="etiBase">Lamina</label>
                                    <input wire:model="lamina" type="text" class="inpBase" id="lamina">@error('lamina') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="codigo" class="etiBase">Codigo</label>
                                    <input wire:model="codigo" type="text" class="inpBase" id="codigo">@error('codigo') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="codigoCinta" class="etiBase">Codigocinta</label>
                                    <input wire:model="codigoCinta" type="text" class="inpBase" id="codigoCinta">@error('codigoCinta') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="pesoML" class="etiBase">Pesoml</label>
                                    <input wire:model="pesoML" type="text" class="inpBase" id="pesoML">@error('pesoML') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="calibre" class="etiBase">Calibre</label>
                                    <input wire:model="calibre" type="text" class="inpBase" id="calibre">@error('calibre') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="dUtil" class="etiBase">Dutil</label>
                                    <input wire:model="dUtil" type="text" class="inpBase" id="dUtil">@error('dUtil') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
</div></form>
                    </div>
                    <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
                        <a wire:click.prevent="cancel()" class="bot botNegro">Cerrar</a>
                        <a wire:click.prevent="save()" class="bot botVerde">Guardar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif