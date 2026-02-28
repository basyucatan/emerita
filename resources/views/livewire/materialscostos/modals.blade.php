@if ($verModalMaterialscosto)
    <div class="modal-overlay"> 
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width: 80%;" wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin" style="cursor: move;">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar Materialscosto' : 'Crear Materialscosto' }}
                        </h5>
                        <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            <div class="row">
                                @if ($selected_id)
                                    <input type="hidden" wire:model="selected_id">
                                @endif
                                <div class="col-md-4">
                                    <label for="IdColor" class="etiBase">Color</label>
                                    <select id="IdColor" class="inpBase" wire:model="IdColor">
                                        <option value=""></option>
                                        @foreach ($colors as $key => $value)
                                            <option value="{{ $key }}" {{ $IdColor == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('IdColor')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="referencia" class="etiBase">Referencia</label>
                                    <input wire:model.live="referencia" type="text" class="inpBase" id="referencia">
                                    @error('referencia')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>        
                                <div class="col-md-4">
                                    <label for="costo" class="etiBase">Costo</label>
                                    <input wire:model.live="costo" type="text" class="inpBase" id="costo">
                                    @error('costo')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="IdMoneda" class="etiBase">Moneda</label>
                                    <select id="IdMoneda" class="inpBase" wire:model="IdMoneda">
                                        <option value=""></option>
                                        @foreach ($monedas as $key => $value)
                                            <option value="{{ $key }}" {{ $IdMoneda == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('IdMoneda')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>        
                                <div class="col-md-4">
                                    <label for="direccion" class="etiBase">Direcccion</label>
                                    <select id="direccion" class="inpBase" wire:model="direccion">
                                        <option value=""></option>
                                        @foreach ($direcciones as $key => $value)
                                            <option value="{{ $key }}" {{ $direccion == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('direccion')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                                                                       
                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    <label for="IdBarra" class="etiBase">Barra</label>
                                    <select id="IdBarra" class="inpBase" wire:model="IdBarra">
                                        <option value=""></option>
                                        @foreach ($barras as $key => $value)
                                            <option value="{{ $key }}" {{ $IdBarra == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('IdBarra')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>  
                                <div class="col-md-4">
                                    <label for="IdPanel" class="etiBase">Panel</label>
                                    <select id="IdPanel" class="inpBase" wire:model="IdPanel">
                                        <option value=""></option>
                                        @foreach ($panels as $key => $value)
                                            <option value="{{ $key }}" {{ $IdPanel == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('IdPanel')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                                
                            </div>
                            <br>                      
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

