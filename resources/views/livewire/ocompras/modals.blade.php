@if($verModalOcompra)
    <div class="modal-overlay"> 
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width: 80%;" wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin" style="cursor: move;">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar Ocompra' : 'Crear Ocompra' }}
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
                                    <label for="IdDivision" class="etiBase">Iddivision</label>
                                    <input wire:model="IdDivision" type="text" class="inpBase" id="IdDivision">@error('IdDivision') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="IdProveedor" class="etiBase">Idproveedor</label>
                                    <input wire:model="IdProveedor" type="text" class="inpBase" id="IdProveedor">@error('IdProveedor') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="IdUser" class="etiBase">Iduser</label>
                                    <input wire:model="IdUser" type="text" class="inpBase" id="IdUser">@error('IdUser') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="IdObra" class="etiBase">Idobra</label>
                                    <input wire:model="IdObra" type="text" class="inpBase" id="IdObra">@error('IdObra') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="IdCondPago" class="etiBase">Idcondpago</label>
                                    <input wire:model="IdCondPago" type="text" class="inpBase" id="IdCondPago">@error('IdCondPago') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="IdCondFlete" class="etiBase">Idcondflete</label>
                                    <input wire:model="IdCondFlete" type="text" class="inpBase" id="IdCondFlete">@error('IdCondFlete') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="fechaHSol" class="etiBase">Fechahsol</label>
                                    <input wire:model="fechaHSol" type="text" class="inpBase" id="fechaHSol">@error('fechaHSol') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="fechaERec" class="etiBase">Fechaerec</label>
                                    <input wire:model="fechaERec" type="text" class="inpBase" id="fechaERec">@error('fechaERec') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="porDescuento" class="etiBase">Pordescuento</label>
                                    <input wire:model="porDescuento" type="text" class="inpBase" id="porDescuento">@error('porDescuento') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="concepto" class="etiBase">Concepto</label>
                                    <input wire:model="concepto" type="text" class="inpBase" id="concepto">@error('concepto') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="estatus" class="etiBase">Estatus</label>
                                    <input wire:model="estatus" type="text" class="inpBase" id="estatus">@error('estatus') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="adicionales" class="etiBase">Adicionales</label>
                                    <input wire:model="adicionales" type="text" class="inpBase" id="adicionales">@error('adicionales') <span class="error text-danger">{{ $message }}</span> @enderror
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