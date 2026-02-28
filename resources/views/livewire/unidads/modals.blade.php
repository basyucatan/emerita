@if($verModalUnidad)
    <div class="modal-overlay">
        <div class="modal-dialog" style="width: 80%;">
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar Unidad' : 'Crear Unidad' }}
                        </h5>
                        <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            @if ($selected_id)
                                <input type="hidden" wire:model="selected_id">
                            @endif
                    <div class="form-group">
                        <label for="tipo" class="etiBase">Tipo</label>
                        <select id="tipo" class="inpBase" wire:model="tipo">
                            <option value=""></option>
                            @foreach ($tipos as $key => $value)
                                <option value="{{ $key }}" {{ $tipo == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="unidad" class="etiBase">Unidad</label>
                        <input wire:model.live="unidad" type="text" class="inpBase" id="unidad" placeholder="Unidad">@error('unidad') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="abreviatura" class="etiBase">Abreviatura</label>
                        <input wire:model.live="abreviatura" type="text" class="inpBase" id="abreviatura" placeholder="Abreviatura">@error('abreviatura') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="factorConversion" class="etiBase">Factorconversion</label>
                        <input wire:model.live="factorConversion" type="text" class="inpBase" id="factorConversion" placeholder="Factorconversion">@error('factorConversion') <span class="error text-danger">{{ $message }}</span> @enderror
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