@if($verModalGrupo)
    <div class="modal-overlay">
        <div x-data="{}" x-init="dragModal($el)" 
            class="modal-dialog" style="width: 80%;"wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardMovil-header">
                        {{ $selected_id ? 'Editar Grupo' : 'Crear Grupo' }}
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            <div class="row">
                                @if ($selected_id)
                                    <input type="hidden" wire:model="selected_id">
                                @endif
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="IdDistrito" class="etiBase">Iddistrito</label>
                                    <input wire:model="IdDistrito" type="text" class="inpBase" id="IdDistrito">@error('IdDistrito') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="grupo" class="etiBase">Grupo</label>
                                    <input wire:model="grupo" type="text" class="inpBase" id="grupo">@error('grupo') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="miembros" class="etiBase">Miembros</label>
                                    <input wire:model="miembros" type="text" class="inpBase" id="miembros">@error('miembros') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="mujeres" class="etiBase">Mujeres</label>
                                    <input wire:model="mujeres" type="text" class="inpBase" id="mujeres">@error('mujeres') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="discapacitados" class="etiBase">Discapacitados</label>
                                    <input wire:model="discapacitados" type="text" class="inpBase" id="discapacitados">@error('discapacitados') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="LGBTQyMas" class="etiBase">Lgbtqymas</label>
                                    <input wire:model="LGBTQyMas" type="text" class="inpBase" id="LGBTQyMas">@error('LGBTQyMas') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="direccion" class="etiBase">Direccion</label>
                                    <input wire:model="direccion" type="text" class="inpBase" id="direccion">@error('direccion') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="localidad" class="etiBase">Localidad</label>
                                    <input wire:model="localidad" type="text" class="inpBase" id="localidad">@error('localidad') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="tipo" class="etiBase">Tipo</label>
                                    <input wire:model="tipo" type="text" class="inpBase" id="tipo">@error('tipo') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="RSG" class="etiBase">Rsg</label>
                                    <input wire:model="RSG" type="text" class="inpBase" id="RSG">@error('RSG') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="RSGSup" class="etiBase">Rsgsup</label>
                                    <input wire:model="RSGSup" type="text" class="inpBase" id="RSGSup">@error('RSGSup') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="telefonoRSG" class="etiBase">Telefonorsg</label>
                                    <input wire:model="telefonoRSG" type="text" class="inpBase" id="telefonoRSG">@error('telefonoRSG') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="respCAsam" class="etiBase">Respcasam</label>
                                    <input wire:model="respCAsam" type="text" class="inpBase" id="respCAsam">@error('respCAsam') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                    <label for="IdComite" class="etiBase">Idcomite</label>
                                    <input wire:model="IdComite" type="text" class="inpBase" id="IdComite">@error('IdComite') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="clase" class="etiBase">Clase</label>
                                    <input wire:model="clase" type="text" class="inpBase" id="clase">@error('clase') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="Obs" class="etiBase">Obs</label>
                                    <input wire:model="Obs" type="text" class="inpBase" id="Obs">@error('Obs') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="asamblea1" class="etiBase">Asamblea1</label>
                                    <input wire:model="asamblea1" type="text" class="inpBase" id="asamblea1">@error('asamblea1') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="asamblea2" class="etiBase">Asamblea2</label>
                                    <input wire:model="asamblea2" type="text" class="inpBase" id="asamblea2">@error('asamblea2') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="vigente" class="etiBase">Vigente</label>
                                    <input wire:model="vigente" type="text" class="inpBase" id="vigente">@error('vigente') <span class="error text-danger">{{ $message }}</span> @enderror
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