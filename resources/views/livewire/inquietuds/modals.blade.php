@if ($verModalInquietud)
    <div class="modal-overlay">
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width: 80%;"wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardMovil-header">
                        {{ $selected_id ? 'Editar Inquietud' : 'Crear Inquietud' }}
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            <div class="row">
                                @if ($selected_id)
                                    <input type="hidden" wire:model="selected_id">
                                @endif
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="nombre" class="etiBase">Nombre (Solo se verá el primer nombre)</label>
                                    <input wire:model="nombre" type="text" class="inpBase" id="nombre">
                                    @error('nombre')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="telefono" class="etiBase">Telefono (no se publicará)</label>
                                    <input wire:model="telefono" type="text" class="inpBase" id="telefono">
                                    @error('telefono')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="etiBase">Comité</label>
                                    <select wire:model="IdComiteDes" class="inpBase">
                                        <option value=""></option>
                                        @foreach ($comites as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('IdComiteDes') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>                                  
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="titulo" class="etiBase">Asunto</label>
                                    <input wire:model="titulo" type="text" class="inpBase" id="titulo">
                                    @error('titulo')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="inquietud" class="etiBase">Punto de Vista</label>
                                    <textarea wire:model="inquietud" type="text" class="inpBase" id="inquietud" rows="4"></textarea>
                                    @error('inquietud')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if($estatus != 'edicion')
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <label for="respuesta" class="etiBase">Respuesta</label>
                                        <input wire:model="respuesta" type="text" class="inpBase">
                                        @error('respuesta')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>                                
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
                        <button wire:click.prevent="cancel()" class="bot botNegro">Cerrar</button>
                        <button wire:click.prevent="save()" class="bot botVerde">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
