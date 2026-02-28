@if ($verModalModelopre)
    <div class="modal-overlay">
        <div class="modal-dialog" style="width: 80%;">
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar Modelo' : 'Crear Modelo' }}
                        </h5>
                        <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            @if ($selected_id)
                                <input type="hidden" wire:model="selected_id">
                            @endif
                            <div class="form-group">
                                <label for="ancho" class="etiBase">Ancho</label>
                                <input wire:model.live="ancho" type="number" step="100" class="inpBase"
                                    id="ancho">
                                @error('ancho')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alto" class="etiBase">Alto</label>
                                <input wire:model.live="alto" type="number" step="100" class="inpBase"id="alto">
                                @error('alto')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="IdColorPerfil" class="etiBase">Color del Perfil</label>
                                <select id="IdColorPerfil" class="inpBase" wire:model="IdColorPerfil">
                                    <option value=""></option>
                                    @foreach ($colorPerfils as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ $IdColorPerfil == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('IdColorPerfil')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="IdVidrio" class="etiBase">Vidrio</label>
                                <select id="IdVidrio" class="inpBase" wire:model="IdVidrio">
                                    <option value=""></option>
                                    @foreach ($vidrios as $key => $value)
                                        <option value="{{ $key }}" {{ $IdVidrio == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('IdVidrio')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="IdColorVidrio" class="etiBase">Color del Vidrio</label>
                                <select id="IdColorVidrio" class="inpBase" wire:model="IdColorVidrio">
                                    <option value=""></option>
                                    @foreach ($colorVidrios as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ $IdColorVidrio == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('IdColorVidrio')
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


@if ($verModalDuplicar)
    <div class="modal-overlay">
        <div class="modal-dialog" style="width: 40%;">
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Duplicar Modelo</h5>
                        <button wire:click="$set('verModalDuplicar', false)" class="btn-close"></button>
                    </div>
                    <div class="cardPrin-body">
                        <div class="form-group">
                            <label for="nuevoModelo" class="etiBase">Nuevo nombre del modelo</label>
                            <input wire:model="nuevoModelo" type="text" class="inpBase" id="nuevoModelo">
                            @error('nuevoModelo')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button wire:click="copiar" class="btn btn-primary">Duplicar</button>
                            <button wire:click="$set('verModalDuplicar', false)"
                                class="btn btn-secondary ms-2">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
