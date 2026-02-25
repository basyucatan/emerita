@if($verModalProducto)
    <div class="modal-overlay"> 
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width: 80%;" wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin" style="cursor: move;">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar Producto' : 'Crear Producto' }}
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
                                    <label for="codigo" class="etiBase">Codigo</label>
                                    <input wire:model="codigo" type="text" class="inpBase" id="codigo">@error('codigo') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="foto" class="etiBase">Foto</label>
                                    <input wire:model="foto" type="text" class="inpBase" id="foto">@error('foto') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="linkCMSG" class="etiBase">Linkcmsg</label>
                                    <input wire:model="linkCMSG" type="text" class="inpBase" id="linkCMSG">@error('linkCMSG') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="producto" class="etiBase">Producto</label>
                                    <input wire:model="producto" type="text" class="inpBase" id="producto">@error('producto') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="IdClase" class="etiBase">Idclase</label>
                                    <input wire:model="IdClase" type="text" class="inpBase" id="IdClase">@error('IdClase') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="precioU" class="etiBase">Preciou</label>
                                    <input wire:model="precioU" type="text" class="inpBase" id="precioU">@error('precioU') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="precioN" class="etiBase">Precion</label>
                                    <input wire:model="precioN" type="text" class="inpBase" id="precioN">@error('precioN') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="costoU" class="etiBase">Costou</label>
                                    <input wire:model="costoU" type="text" class="inpBase" id="costoU">@error('costoU') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="stockMin" class="etiBase">Stockmin</label>
                                    <input wire:model="stockMin" type="text" class="inpBase" id="stockMin">@error('stockMin') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="pDescuento" class="etiBase">Pdescuento</label>
                                    <input wire:model="pDescuento" type="text" class="inpBase" id="pDescuento">@error('pDescuento') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="activo" class="etiBase">Activo</label>
                                    <input wire:model="activo" type="text" class="inpBase" id="activo">@error('activo') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="obs" class="etiBase">Obs</label>
                                    <input wire:model="obs" type="text" class="inpBase" id="obs">@error('obs') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
</div></form>
                    </div>
                    <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
                        <a wire:click.prevent="cancel()" class="bot botNegro">Cerrar</a>
                        <a wire:click.prevent="save()" class="bot botVerde">Guardar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif