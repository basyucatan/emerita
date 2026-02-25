@if ($verModalMensaje)
    <div class="modal-overlay">
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width: 80%;"wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardMovil-header">
                        {{ $selected_id ? 'Editar Mensaje' : 'Crear Mensaje' }}
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            <div class="row">
                                @if ($selected_id)
                                    <input type="hidden" wire:model="selected_id">
                                @endif
                                <div class="col-6">
                                    <label for="fechaIni" class="etiBase">Fechaini</label>
                                    <input wire:model="fechaIni" type="date" class="inpBase" id="fechaIni">
                                    @error('fechaIni')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="fechaFin" class="etiBase">Fechafin</label>
                                    <input wire:model="fechaFin" type="date" class="inpBase" id="fechaFin">
                                    @error('fechaFin')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="titulo" class="etiBase">Titulo</label>
                                    <input wire:model="titulo" type="text" class="inpBase" id="titulo">
                                    @error('titulo')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="contenido" class="etiBase">Contenido</label>
                                    <textarea wire:model="contenido" rows="3" class="inpBase" id="contenido"></textarea>
                                    @error('contenido')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    @if ($fotoSubida)
                                        <img src="{{ $fotoSubida->temporaryUrl() }}"
                                            style="heigth: 80px; max-height: 100px; width: auto;"
                                            class="img-fluid border rounded mb-2">
                                        <div class="text-info"><small>Nueva foto</small></div>
                                    @elseif (!empty($Mensaje?->fotoUrl))
                                        <img src="{{ $Mensaje->fotoUrl }}"
                                            style="heigth: 80px; max-height: 100px; width: auto;"
                                            class="img-fluid border rounded mb-2">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <small class="text-secondary">Foto actual</small>
                                            <button type="button" class="bot botRojo btn-sm" wire:click="eliminarFoto">
                                                Eliminar foto
                                            </button>
                                        </div>
                                    @else
                                        <div class="text-muted mb-2">Sin foto</div>
                                    @endif
                                    <div class="d-flex flex-column mt-1">
                                        <div wire:loading wire:target="fotoSubida" class="text-primary">
                                            <small>Cargando imagen…</small>
                                        </div>
                                        @error('fotoSubida')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <input type="file" wire:model="fotoSubida" class="form-control mb-2">
                                    @error('fotoSubida')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    @if ($docSubida)
                                        {{ $docSubida }}
                                        <div class="text-info"><small>Nuevo Doc</small></div>
                                    @elseif (!empty($Mensaje?->docUrl))
                                        <embed src="{{ $Mensaje->docUrl }}#toolbar=0&navpanes=0&scrollbar=0"
                                            type="application/pdf" style="width: 100%; height: 100px;"
                                            class="border rounded">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <small class="text-secondary">Documento Actual</small>
                                            <button type="button" class="bot botRojo btn-sm" wire:click="eliminarDoc">
                                                Eliminar Documento
                                            </button>
                                        </div>
                                    @else
                                        <div class="text-muted mb-2">Sin Doc</div>
                                    @endif
                                    <div class="d-flex flex-column mt-1">
                                        <div wire:loading wire:target="docSubida" class="text-primary">
                                            <small>Cargando Documento…</small>
                                        </div>
                                        @error('docSubida')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <input type="file" wire:model="docSubida" class="form-control mb-2">
                                    @error('docSubida')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="urlLink" class="etiBase">Urllink</label>
                                    <input wire:model="urlLink" type="text" class="inpBase" id="urlLink">
                                    @error('urlLink')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
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
