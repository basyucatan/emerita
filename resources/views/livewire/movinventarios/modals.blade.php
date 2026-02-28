@if ($verModalMovinventario)
    <div class="modal-overlay">
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width: 80%;" wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin" style="cursor: move;">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar Movinventario' : 'Crear Movinventario' }}
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
                                    <label for="IdUserOri" class="etiBase">Envía</label>
                                    <select id="IdUserOri" class="inpBase" wire:model="IdUserOri">
                                        <option value=""></option>
                                        @foreach ($users as $key => $value)
                                            <option value="{{ $key }}" {{ $IdUserOri == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('IdUserOri') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>                                 
                                <div class="col-md-6">
                                    <label for="IdUserDes" class="etiBase">Recibe</label>
                                    <select id="IdUserDes" class="inpBase" wire:model="IdUserDes">
                                        <option value=""></option>
                                        @foreach ($users as $key => $value)
                                            <option value="{{ $key }}" {{ $IdUserDes == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('IdUserDes') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>                                 
                                <div class="col-md-6">
                                    <label for="tipo" class="etiBase">Tipo</label>
                                    <input wire:model="tipo" type="text" class="inpBase" id="tipo">
                                    @error('tipo')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="IdMatCosto" class="etiBase">Idmatcosto</label>
                                    <input wire:model="IdMatCosto" type="text" class="inpBase" id="IdMatCosto">
                                    @error('IdMatCosto')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="IdDeptoOri" class="etiBase">DeptoEnvia</label>
                                    <select id="IdDeptoOri" class="inpBase" wire:model="IdDeptoOri">
                                        <option value=""></option>
                                        @foreach ($deptos as $key => $value)
                                            <option value="{{ $key }}" {{ $IdDeptoOri == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('IdDeptoOri') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>                                
                                <div class="col-md-6">
                                    <label for="IdDeptoDes" class="etiBase">DeptoRecibe</label>
                                    <select id="IdDeptoDes" class="inpBase" wire:model="IdDeptoDes">
                                        <option value=""></option>
                                        @foreach ($deptos as $key => $value)
                                            <option value="{{ $key }}" {{ $IdDeptoDes == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('IdDeptoDes') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>  
                                <div class="col-md-6">
                                    <label for="fechaH" class="etiBase">Fechah</label>
                                    <input wire:model="fechaH" type="text" class="inpBase" id="fechaH">
                                    @error('fechaH')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="cantidad" class="etiBase">Cantidad</label>
                                    <input wire:model="cantidad" type="text" class="inpBase" id="cantidad">
                                    @error('cantidad')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="valorU" class="etiBase">Valoru</label>
                                    <input wire:model="valorU" type="text" class="inpBase" id="valorU">
                                    @error('valorU')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="dimensiones" class="etiBase">Dimensiones</label>
                                    <input wire:model="dimensiones" type="text" class="inpBase" id="dimensiones">
                                    @error('dimensiones')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="adicionales" class="etiBase">Adicionales</label>
                                    <input wire:model="adicionales" type="text" class="inpBase" id="adicionales">
                                    @error('adicionales')
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
