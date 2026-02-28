@if ($verModalTablaherraje)
    <div class="modal-overlay"> 
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width: 80%;" wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin" style="cursor: move;">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar Tablaherraje' : 'Crear Tablaherraje' }}
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
                                    <label for="IdMarca" class="etiBase">Marca</label>
                                    <select id="IdMarca" class="inpBase" 
                                        wire:model="IdMarca" wire:change="elegirMarca">
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
                                <div class="col-md-6">
                                    <label for="IdLinea" class="etiBase">Línea</label>
                                    <select id="IdLinea" class="inpBase" 
                                        wire:model="IdLinea" wire:change="elegirMarca">
                                        <option value=""></option>
                                        @foreach ($lineas as $key => $value)
                                            <option value="{{ $key }}" {{ $IdLinea == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('IdLinea')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="tablaHerraje" class="etiBase">Tabla de herraje</label>
                                    <input wire:model="tablaHerraje" type="text" class="inpBase" id="tablaHerraje">
                                    @error('tablaHerraje')
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
