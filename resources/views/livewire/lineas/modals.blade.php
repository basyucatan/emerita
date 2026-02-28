@if ($verModalLinea)
    <div class="modal-overlay">
        <div class="modal-dialog" style="width: 80%;">
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar Linea' : 'Crear Linea' }}
                        </h5>
                        <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            <div class="row">
                                @if ($selected_id)
                                    <input type="hidden" wire:model="selected_id">
                                @endif
                                <div class="col-6">
                                    <label for="IdDivision" class="etiBase">División</label>
                                    <select id="IdDivision" class="inpBase" wire:model="IdDivision">
                                        <option value=""></option>
                                        @foreach ($divisions as $key => $value)
                                            <option value="{{ $key }}" {{ $IdDivision == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('IdDivision') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>                             
                                <div class="col-6">
                                    <label for="IdMarca" class="etiBase">Marca</label>
                                    <select id="IdMarca" class="inpBase" 
                                        wire:model="IdMarca">
                                        <option value=""></option>
                                        @foreach ($marcas as $key => $value)
                                            <option value="{{ $key }}" {{ $IdMarca == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('IdMarca')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="IdColorablePerfil" class="etiBase">Tipo Perfil</label>
                                    <select id="IdColorablePerfil" class="inpBase" wire:model="IdColorablePerfil">
                                        <option value=""></option>
                                        @foreach ($colorables as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $IdColorablePerfil == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('IdColorablePerfil')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="linea" class="etiBase">Linea</label>
                                    <input wire:model.live="linea" type="text" class="inpBase" id="linea">
                                    @error('linea')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="orden" class="etiBase">Orden</label>
                                    <input wire:model.live="orden" type="text" class="inpBase" id="orden">
                                    @error('orden')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
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
