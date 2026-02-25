@if($verModalDistrito)
    <div class="modal-overlay">
        <div x-data="{}" x-init="dragModal($el)" 
            class="modal-dialog" style="width: 80%;"wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardMovil-header">
                        {{ $selected_id ? 'Editar Distrito' : 'Crear Distrito' }}
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            <div class="row">
                                @if ($selected_id)
                                    <input type="hidden" wire:model="selected_id">
                                @endif
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="distrito" class="etiBase">Distrito</label>
                                    <input wire:model="distrito" type="text" class="inpBase" id="distrito">@error('distrito') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="panel" class="etiBase">Panel</label>
                                    <input wire:model="panel" type="text" class="inpBase" id="panel">@error('panel') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="orden" class="etiBase">Orden</label>
                                    <input wire:model="orden" type="text" class="inpBase" id="orden">@error('orden') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="direccion" class="etiBase">Direccion</label>
                                    <input wire:model="direccion" type="text" class="inpBase" id="direccion">@error('direccion') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="telefono" class="etiBase">Telefono</label>
                                    <input wire:model="telefono" type="text" class="inpBase" id="telefono">@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="foto" class="etiBase">Foto</label>
                                    <input wire:model="foto" type="text" class="inpBase" id="foto">@error('foto') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="gmaps" class="etiBase">Gmaps</label>
                                    <input wire:model="gmaps" type="text" class="inpBase" id="gmaps">@error('gmaps') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="ubicacion" class="etiBase">Ubicacion</label>
                                    <input wire:model="ubicacion" type="text" class="inpBase" id="ubicacion">@error('ubicacion') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="fechaHPle" class="etiBase">Fechahple</label>
                                    <input wire:model="fechaHPle" type="text" class="inpBase" id="fechaHPle">@error('fechaHPle') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="fechaHEst" class="etiBase">Fechahest</label>
                                    <input wire:model="fechaHEst" type="text" class="inpBase" id="fechaHEst">@error('fechaHEst') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="fechaHSer" class="etiBase">Fechahser</label>
                                    <input wire:model="fechaHSer" type="text" class="inpBase" id="fechaHSer">@error('fechaHSer') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="fechaHEva" class="etiBase">Fechaheva</label>
                                    <input wire:model="fechaHEva" type="text" class="inpBase" id="fechaHEva">@error('fechaHEva') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="obs" class="etiBase">Obs</label>
                                    <input wire:model="obs" type="text" class="inpBase" id="obs">@error('obs') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="adicionales" class="etiBase">Adicionales</label>
                                    <input wire:model="adicionales" type="text" class="inpBase" id="adicionales">@error('adicionales') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="porcionGeo" class="etiBase">Porciongeo</label>
                                    <input wire:model="porcionGeo" type="text" class="inpBase" id="porcionGeo">@error('porcionGeo') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
</div></form>
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