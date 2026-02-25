@if ($verModalDistrito)
    <div class="modal-overlay">
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width: 80%;"wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardMovil-header">
                        {{ $selected_id ? 'Editar Distrito' : 'Crear Distrito' }}
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            <div class="row">
                                @if ($selected_id)
                                    <input type="hidden" wire:model.defer="selected_id">
                                @endif
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="direccion" class="etiBase">Direccion</label>
                                    <textarea wire:model.defer="datosDistrito.direccion" type="text" class="inpBase" id="direccion" rows="3"></textarea>
                                    @error('datosDistrito.direccion')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="gmaps" class="etiBase">Gmaps</label>
                                    <input wire:model.defer="datosDistrito.gmaps" type="text" class="inpBase" id="gmaps">
                                    @error('datosDistrito.gmaps')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="ubicacion" class="etiBase">Ubicacion</label>
                                    <input wire:model.defer="datosDistrito.ubicacion" type="text" class="inpBase" id="ubicacion">
                                    @error('datosDistrito.ubicacion')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                                
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="fechaHPle" class="etiBase">Dia/Hora Plenaria</label>
                                    <input wire:model.defer="datosDistrito.fechaHPle" type="text" class="inpBase" id="fechaHPle">
                                    @error('datosDistrito.fechaHPle')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="fechaHEst" class="etiBase">Dia/Hora Estudio</label>
                                    <input wire:model.defer="datosDistrito.fechaHEst" type="text" class="inpBase" id="fechaHEst">
                                    @error('datosDistrito.fechaHEst')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
                        <button wire:click.prevent="cancel()" class="bot botNegro">Cerrar</button>
                        <button wire:click.prevent="saveDistrito()" class="bot botVerde">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
