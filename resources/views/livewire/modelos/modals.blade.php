@if ($verModalModelo)
    <div class="modal-overlay">
        <div class="modal-dialog" style="width: 80%;">
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar Modelo' : 'Crear Modelo' }}
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
                                    <label for="IdMarca" class="etiBase">Marca</label>
                                    <select id="IdMarca" class="inpBase" 
                                        wire:model="IdMarca" wire:change="elegirMarca">
                                        <option value=""></option>
                                        @foreach ($marcas as $key => $value)
                                            <option value="{{ $key }}" {{ $IdMarca == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('IdMarca')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                                   
                                <div class="col-md-6">
                                    <label for="IdLinea" class="etiBase">Línea</label>
                                    <select id="IdLinea" class="inpBase" wire:model="IdLinea">
                                        <option value=""></option>
                                        @foreach ($lineas as $key => $value)
                                            <option value="{{ $key }}" {{ $IdLinea == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('IdLinea')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                                
                                <div class="col-md-6">
                                    <label for="modelo" class="etiBase">Modelo</label>
                                    <input wire:model="modelo" type="text" class="inpBase" id="modelo">
                                    @error('modelo')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="estatus" class="etiBase">Estatus</label>
                                    <select id="estatus" class="inpBase" wire:model="estatus">
                                        <option value=""></option>
                                        @foreach ($estados as $key => $value)
                                            <option value="{{ $key }}" {{ $estatus == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('estatus')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div> 
                                <div class="col-12 mt-3">
                                    <div class="d-flex align-items-center gap-3 border p-2 rounded bg-light">
                                        <div class="border rounded d-flex align-items-center justify-content-center bg-white" style="width: 100px; height: 100px;">
                                            @if ($fichaSubida)
                                                <i class="bi bi-file-earmark-check text-success" style="font-size: 2rem;"></i>
                                            @elseif ($fichaTecnica)
                                                <i class="bi bi-file-earmark-pdf text-danger" style="font-size: 2rem;"></i>
                                            @else
                                                <i class="bi bi-file-earmark-x text-muted" style="font-size: 2rem;"></i>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="etiBase">Ficha Técnica (PDF)</label>
                                            <input type="file" wire:model="fichaSubida" class="form-control form-control-sm" accept="application/pdf">
                                            <div wire:loading wire:target="fichaSubida" class="text-primary small">Subiendo PDF...</div>
                                            @if ($fichaSubida)
                                                <div class="text-success small">PDF listo para guardar</div>
                                            @elseif ($fichaTecnica)
                                                @php $modeloInstancia = \App\Models\Modelo::find($selected_id); @endphp
                                                @if ($modeloInstancia && $modeloInstancia->fichaTecnica)
                                                    <iframe src="{{ asset('storage/' . $modeloInstancia->rutaFicha . '/' . $modeloInstancia->fichaTecnica) }}" 
                                                            style="width:100%; height:100px;" frameborder="0"></iframe>
                                                @endif                                              
                                            @endif
                                        </div>
                                    </div>
                                    @error('fichaSubida') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>                                
                            </div>
                        </form>
                    </div>
                    <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
                        <a wire:click.prevent="cancel()" class="bot botCancel">Cerrar</a>
                        <a wire:click.prevent="save()" class="bot botVerde">Guardar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
