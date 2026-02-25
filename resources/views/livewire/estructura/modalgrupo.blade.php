@if ($verModalGrupo)
<div class="modal-overlay">
    <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width:80%" wire:ignore.self>
        <div class="modal-content">
            <div class="cardPrin">

                <div class="cardMovil-header">
                    {{ $selected_id ? 'Editar Grupo' : 'Crear Grupo' }}
                </div>

                <div class="cardPrin-body" style="padding:0 20px; max-height:400px; overflow-y:auto;">
                    <form wire:submit.prevent="save">
                        @if ($selected_id)
                            <input type="hidden" wire:model="selected_id">
                        @endif
                        <div class="row g-1">
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="etiBase">Grupo</label>
                                <input type="text" class="inpBase"
                                       wire:model.defer="datosGrupo.grupo">
                                @error('datosGrupo.grupo')<span class="error text-danger">{{ $message }}</span>@enderror
                            </div>   
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="etiBase">Localidad</label>
                                <input type="text" class="inpBase"
                                       wire:model.defer="datosGrupo.localidad">
                                @error('datosGrupo.localidad')<span class="error text-danger">{{ $message }}</span>@enderror
                            </div>  
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="etiBase">Dirección</label>
                                <textarea rows="3" type="text" class="inpBase"
                                       wire:model.defer="datosGrupo.direccion"></textarea>
                                @error('datosGrupo.direccion')<span class="error text-danger">{{ $message }}</span>@enderror
                            </div>  
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="etiBase">Google Maps</label>
                                <input type="text" class="inpBase"
                                       wire:model.defer="datosGrupo.gmaps">
                                @error('datosGrupo.gmaps')<span class="error text-danger">{{ $message }}</span>@enderror
                            </div>    
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="etiBase">Ubicación</label>
                                <input type="text" class="inpBase"
                                       wire:model.defer="datosGrupo.ubicacion">
                                @error('datosGrupo.ubicacion')<span class="error text-danger">{{ $message }}</span>@enderror
                            </div>                               
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="etiBase">RSG</label>
                                <input type="text" class="inpBase"
                                       wire:model.defer="datosGrupo.RSG">
                                @error('datosGrupo.RSG')<span class="error text-danger">{{ $message }}</span>@enderror
                            </div>    
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="etiBase">RSG Sup.</label>
                                <input type="text" class="inpBase"
                                       wire:model.defer="datosGrupo.RSGSup">
                                @error('datosGrupo.RSGSup')<span class="error text-danger">{{ $message }}</span>@enderror
                            </div>     
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="etiBase">Tel. RSG</label>
                                <input type="text" class="inpBase"
                                       wire:model.defer="datosGrupo.telefonoRSG">
                                @error('datosGrupo.telefonoRSG')<span class="error text-danger">{{ $message }}</span>@enderror
                            </div>    
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="etiBase">Resp. Asamblea</label>
                                <input type="text" class="inpBase"
                                       wire:model.defer="datosGrupo.respCAsam">
                                @error('datosGrupo.respCAsam')<span class="error text-danger">{{ $message }}</span>@enderror
                            </div>     
                            <div class="col-12">
                                <label class="etiBase">Conteo de Miembros</label>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="etiBase">Total</label>
                                <input type="text" class="inpBase"
                                       wire:model.defer="datosGrupo.miembros">
                                @error('datosGrupo.miembros')<span class="error text-danger">{{ $message }}</span>@enderror
                            </div>    
                            <div class="col-6 col-md-3">
                                <label class="etiBase">Mujeres</label>
                                <input type="text" class="inpBase"
                                       wire:model.defer="datosGrupo.mujeres">
                                @error('datosGrupo.mujeres')<span class="error text-danger">{{ $message }}</span>@enderror
                            </div> 
                            <div class="col-6 col-md-3">
                                <label class="etiBase">LGBTQ+</label>
                                <input type="text" class="inpBase"
                                       wire:model.defer="datosGrupo.LGBTQyMas">
                                @error('datosGrupo.LGBTQyMas')<span class="error text-danger">{{ $message }}</span>@enderror
                            </div>         
                            <div class="col-6 col-md-3">
                                <label class="etiBase">Discap.</label>
                                <input type="text" class="inpBase"
                                       wire:model.defer="datosGrupo.discapacitados">
                                @error('datosGrupo.discapacitados')<span class="error text-danger">{{ $message }}</span>@enderror
                            </div>                                                                                                                                                                                                                                     
                        </div>                        
                    </form>
                </div>
                <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
                    <button type="button" wire:click="cancel" class="bot botNegro">Cerrar</button>
                    <button type="button" wire:click="saveGrupo" class="bot botVerde">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
