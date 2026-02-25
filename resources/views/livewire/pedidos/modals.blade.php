@if($verModalPedido)
    <div class="modal-overlay"> 
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width: 80%;" wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin" style="cursor: move;">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar Pedido' : 'Crear Pedido' }}
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
                                    <label for="IdUser" class="etiBase">Iduser</label>
                                    <input wire:model="IdUser" type="text" class="inpBase" id="IdUser">@error('IdUser') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="IdCliente" class="etiBase">Idcliente</label>
                                    <input wire:model="IdCliente" type="text" class="inpBase" id="IdCliente">@error('IdCliente') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="FechaH" class="etiBase">Fechah</label>
                                    <input wire:model="FechaH" type="text" class="inpBase" id="FechaH">@error('FechaH') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="total" class="etiBase">Total</label>
                                    <input wire:model="total" type="text" class="inpBase" id="total">@error('total') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="totalArticulos" class="etiBase">Totalarticulos</label>
                                    <input wire:model="totalArticulos" type="text" class="inpBase" id="totalArticulos">@error('totalArticulos') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="estatus" class="etiBase">Estatus</label>
                                    <input wire:model="estatus" type="text" class="inpBase" id="estatus">@error('estatus') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="Obs" class="etiBase">Obs</label>
                                    <input wire:model="Obs" type="text" class="inpBase" id="Obs">@error('Obs') <span class="error text-danger">{{ $message }}</span> @enderror
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