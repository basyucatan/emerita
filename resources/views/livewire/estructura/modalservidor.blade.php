@if ($verModalServidor)
    <div class="modal-overlay">
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width:80%" wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardMovil-header">
                        {{ $selected_id ? 'Editar Servidor' : 'Crear Servidor' }}
                    </div>
                    <div class="cardPrin-body" style="padding:0 20px; max-height:400px; overflow-y:auto;">
                        <form wire:submit.prevent="save">
                            @if ($selected_id)
                                <input type="hidden" wire:model.defer="selected_id">
                            @endif
                            <div class="row g-1">
                                <div class="col-12 col-md-6">
                                    <label class="etiBase">Nombre</label>
                                    <input wire:model.defer.defer="datosServidor.servidor" class="inpBase">
                                    @error('datosServidor.grupo')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label class="etiBase">Servicio</label>
                                    <select wire:model.defer="datosServidor.IdServicio"  class="inpBase">
                                        <option value=""></option>
                                        @foreach ($servicios as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('datosServidor.IdServicio') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="telefono" class="etiBase">Telefono</label>
                                    <input wire:model.defer="datosServidor.telefono" class="inpBase" id="telefono">
                                    @error('datosServidor.telefono')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                                
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label class="etiBase">Comité</label>
                                    <select wire:model.defer="datosServidor.IdComite"  class="inpBase">
                                        <option value=""></option>
                                        @foreach ($comites as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('datosServidor.IdComite') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label class="etiBase">Canalizado a</label>
                                    <select wire:model.defer="datosServidor.IdComiteCan"  class="inpBase">
                                        <option value=""></option>
                                        @foreach ($comites as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('datosServidor.IdComiteCan') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
                        <button type="button" wire:click="cancel" class="bot botNegro">Cerrar</button>
                        <button type="button" wire:click="saveServidor" class="bot botVerde">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
