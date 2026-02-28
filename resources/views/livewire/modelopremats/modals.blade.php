@if($verModalModelopremat)
    <div class="modal-overlay"> 
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width: 80%;" wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin" style="cursor: move;">
                <div class="cardPrin-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0">
                        {{ $selected_id ? 'Editar '.$material : 'Crear Material' }}
                    </h5>
                    <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                </div>
                <div class="cardPrin-body" style="padding: 0 20px 0 20px; max-height: 400px; overflow-y: auto;">
                    <form>
                        <div class="row">
                            <input type="hidden" wire:model="selected_id">
                            <div class="col-4">
                                <label for="cantidad" class="etiBase">Cantidad</label>
                                <input wire:model="cantidad" type="number" class="inpBase" id="cantidad" placeholder="Cantidad">@error('cantidad') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-4">
                                <label for="IdTipo" class="etiBase">Tipo</label>
                                <select id="IdTipo" class="inpBase" wire:model="IdTipo">
                                    <option value=""></option>
                                    @foreach ($tipos as $key => $value)
                                        <option value="{{ $key }}" {{ $IdTipo == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('IdTipo') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>            
                            <div class="col-4">
                                <label for="posicion" class="etiBase">Posición</label>
                                <select wire:model="posicion" id="posicion" class="inpBase">
                                    <option value="">-- Selecciona --</option>
                                    <option value="V">V</option>
                                    <option value="H">H</option>
                                </select>
                                @error('posicion') 
                                    <span class="error text-danger">{{ $message }}</span> 
                                @enderror
                            </div>                            
                            <div class="col-6">
                                <label for="formula" class="etiBase">Formula</label>
                                <input wire:model="formula" type="text" class="inpBase" id="formula" placeholder="Formula">@error('formula') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>   
                            <div class="col-4">
                                <label for="IdTablaHerraje" class="etiBase">Tabla de Herrajes</label>
                                <select id="IdTablaHerraje" class="inpBase" 
                                    wire:model.live="IdTablaHerraje">
                                    <option value=""></option>
                                    @foreach ($tablas as $key => $value)
                                        <option value="{{ $key }}" {{ $IdTablaHerraje == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('IdTablaHerraje') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>                           
                            @if(!empty($IdTablaHerraje))
                                <div class="col-2">
                                    <label for="cantidadHerraje" class="etiBase">#Herr</label>
                                    <input wire:model="cantidadHerraje" type="number" step="1" class="inpBase" id="cantidadHerraje">
                                    @error('cantidadHerraje') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            @endif  
                            <div class="col-6">
                                <label for="IdLineaPref" class="etiBase">Línea Preferente</label>
                                <select id="IdLineaPref" class="inpBase" wire:model.live="IdLineaPref">
                                    <option value=""></option>
                                    @foreach ($lineas as $key => $value)
                                        <option value="{{ $key }}" {{ $IdLineaPref == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('IdLineaPref') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>  
                            <div class="col-6">
                                <label for="diferenciador" class="etiBase">Obs.</label>
                                <input wire:model="diferenciador" type="text" class="inpBase" id="diferenciador">@error('diferenciador') <span class="error text-danger">{{ $message }}</span> @enderror
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
@endif
