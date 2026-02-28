@if ($verModalMarca)
    <div class="modal-overlay">
        <div class="modal-dialog" style="width: 80%;">
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar Marca' : 'Crear Marca' }}
                        </h5>
                        <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            @if ($selected_id)
                                <input type="hidden" wire:model="selected_id">
                            @endif
                            <div class="form-group">
                                <label for="marca" class="etiBase">Marca</label>
                                <input wire:model.live="marca" type="text" class="inpBase" id="marca"
                                    placeholder="Marca">
                                @error('marca')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="IdColorable" class="etiBase">Idcolorable</label>
                                <input wire:model.live="IdColorable" type="text" class="inpBase" id="IdColorable"
                                    placeholder="Idcolorable">
                                @error('IdColorable')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="etiBase">Colorable</label>
                                <select wire:model.live="IdColorable" class="inpBase">
                                    <option value=""></option>
                                    @foreach ($colorables as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>                                                      
                            <div class="form-group">
                                <label for="foto" class="etiBase">Foto</label>
                                <input wire:model.live="foto" type="text" class="inpBase" id="foto"
                                    placeholder="Foto">
                                @error('foto')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
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
