@if ($verModalArbolDes)
    <div class="modal-overlay"> 
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width: 80%;" wire:ignore.self>
            <div class="modal-content">
                <div class="cardPrin" style="cursor: move;">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            Re Organizar Ubicaciones
                        </h5>
                        <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 500px; overflow-y: auto;">
                        <form>
                            <div class="row g-1">
                                <div class="col-6">
                                    <div class="col-12 etiBase" style="text-align: center">Árbol</div>
                                    <div class="col-12">
                                        <label class="etiBase">Clase</label>
                                        <select wire:model.defer="origen.IdClase" 
                                            wire:change="cambioArbol('clase')" class="inpBase">
                                            <option value=""></option>
                                            @foreach ($clases as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="etiBase">Marca</label>
                                        <select wire:model.defer="origen.IdMarca" 
                                            wire:change="cambioArbol('marca')" class="inpBase">
                                            <option value=""></option>
                                            @foreach ($marcas as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="etiBase">Línea</label>
                                        <select wire:model.defer="origen.IdLinea" class="inpBase">
                                            <option value=""></option>
                                            @foreach ($lineas as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach                                         
                                        </select>
                                    </div>                                    
                                </div>
                                <div class="col-6">
                                    @include('livewire.materialscostos.modalsDestino')
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
                        <a wire:click.prevent="cancel()" class="bot botCancel">Cerrar</a>
                        <a wire:click.prevent="saveArbolDes()" class="bot botVerde">Guardar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

