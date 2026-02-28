@if ($verModalRegla)
    <div class="modal-overlay">
        <div class="modal-dialog" style="width: 80%;">
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar Regla' : 'Crear Regla' }}
                        </h5>
                        <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            @if ($selected_id)
                                <input type="hidden" wire:model="selected_id">
                            @endif
                            <div class="row">
                                <div class="col-6">
                                    <label for="baseCalculo" class="etiBase">Base del Cálculo</label>
                                    <select id="baseCalculo" class="inpBase" wire:model="baseCalculo">
                                        <option value=""></option>
                                        @foreach ($bases as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $baseCalculo == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('baseCalculo')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="efectoCalculo" class="etiBase">Efecto del Cálculo</label>
                                    <select id="efectoCalculo" class="inpBase" wire:model="efectoCalculo">
                                        <option value=""></option>
                                        @foreach ($bases as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $efectoCalculo == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('efectoCalculo')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="factor" class="etiBase">Factor</label>
                                    <input wire:model.live="factor" type="text" class="inpBase" id="factor"
                                        placeholder="Factor">
                                    @error('factor')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="descuento" class="etiBase">Descuento</label>
                                    <input wire:model.live="descuento" type="text" class="inpBase" id="descuento"
                                        placeholder="descuento">
                                    @error('descuento')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                            
                                <div class="col-6">
                                    <label for="IdLinea" class="etiBase">Línea (Junquillos y Viniles)</label>
                                    <select id="IdLinea" class="inpBase" wire:model="IdLinea">
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
                                <div class="col-6">
                                    <label for="IdVidrio" class="etiBase">Grosor de vidrio</label>
                                    <select id="IdVidrio" class="inpBase" wire:model="IdVidrio">
                                        <option value=""></option>
                                        @foreach ($grosors as $key => $value)
                                            <option value="{{ $key }}" {{ $IdVidrio == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('IdVidrio')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                                  
                                <div class="col-6">
                                    <label for="IdTipo" class="etiBase">Exclusivo</label>
                                    <select id="IdTipo" class="inpBase" wire:model="IdTipo">
                                        <option value=""></option>
                                        @foreach ($tipos as $key => $value)
                                            <option value="{{ $key }}" {{ $IdTipo == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('IdTipo')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                                   
                            </div>
                        </form>
                    </div>
                    <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
                        <a wire:click.prevent="cancel()" class="bot botCancel">Cerrar</a>
                        <a wire:click.prevent="save()" class="bot botSave">Guardar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
