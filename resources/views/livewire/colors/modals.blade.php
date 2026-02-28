@if ($verModalColor)
    <div class="modal-overlay">
        <div class="modal-dialog" style="width: 80%;">
            <div class="modal-content cardPrin">
                <div class="cardPrin-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0">
                        {{ $selected_id ? 'Editar Color' : 'Crear Color' }}
                    </h5>
                    <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                </div>
                <div class="cardPrin-body" style="max-height: 400px; overflow-y: auto;">
                    <form wire:submit.prevent="save">
                        <input type="hidden" wire:model="selected_id">
                        <div class="form-group">
                            <label for="color" class="etiBase">Nombre del color</label>
                            <input wire:model="color" type="text" class="inpBase" id="color">
                            @error('color')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="etiBase">Elegir color</label>
                            <div class="d-flex align-items-center gap-2">
                                <input wire:model="colorHex" type="color" class="form-control form-control-color"
                                    style="width: 50px; height: 38px; padding: 0;" />
                                
                                <div class="d-flex align-items-center" style="gap: 0.5rem;">
                                    <input wire:model="opacidad" type="range" min="0" max="100" step="1" style="width: 100px;" />
                                    <input wire:model="opacidad" type="number" class="inpSolo" min="0" max="100"
                                        style="width: 50px; font-size: 0.9rem; padding: 2px 4px; text-align: center;" />
                                    <span>%</span>
                                </div>
                                <div style="width: 40px; height: 30px; background-color: {{ $colorRgba }}; border: 1px solid #666; border-radius: 4px;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="IdColorHerraje" class="etiBase">Color Herraje</label>
                            <select id="IdColorHerraje" class="inpBase" wire:model="IdColorHerraje">
                                <option value=""></option>
                                @foreach ($coloresHerrajes as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <div class="form-group">
                            <label for="IdColorable" class="etiBase">Tipo</label>
                            <select id="IdColorable" class="inpBase" wire:model="IdColorable">
                                <option value=""></option>
                                @foreach ($colorables as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
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
@endif
