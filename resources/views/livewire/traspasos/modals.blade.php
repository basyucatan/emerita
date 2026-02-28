@if ($verModalTraspaso)
    <div class="modal-overlay">
        <div class="modal-dialog" style="width: 80%;">
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            {{ $selected_id ? 'Editar '.$tipo : 'Crear '.$tipo }}
                        </h5>
                        <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>

                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            @if ($selected_id)
                                <input type="hidden" wire:model="selected_id">
                            @endif

                            <div class="row">
                                @if($EditIdDeptoOri)
                                    <div class="col-md-6">
                                        <label for="IdDeptoOri" class="etiBase">Depto Origen</label>
                                        <select id="IdDeptoOri" class="inpBase" wire:model="IdDeptoOri">
                                            <option value=""></option>
                                            @foreach ($deptos as $key => $value)
                                                <option value="{{ $key }}" {{ $IdDeptoOri == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('IdDeptoOri')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                @if($EditIdDeptoDes)
                                    <div class="col-md-6">
                                        <label for="IdDeptoDes" class="etiBase">Depto Destino</label>
                                        <select id="IdDeptoDes" class="inpBase" wire:model="IdDeptoDes">
                                            <option value=""></option>
                                            @foreach ($deptos as $key => $value)
                                                <option value="{{ $key }}" {{ $IdDeptoDes == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('IdDeptoDes')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                @if($EditIdUserOri)
                                    <div class="col-md-6">
                                        <label for="IdUserOri" class="etiBase">Usuario Origen</label>
                                        <select id="IdUserOri" class="inpBase" wire:model="IdUserOri">
                                            <option value=""></option>
                                            @foreach ($users as $key => $value)
                                                <option value="{{ $key }}" {{ $IdUserOri == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('IdUserOri')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                @if($EditIdUserDes)
                                    <div class="col-md-6">
                                        <label for="IdUserDes" class="etiBase">Usuario Destino</label>
                                        <select id="IdUserDes" class="inpBase" wire:model="IdUserDes">
                                            <option value=""></option>
                                            @foreach ($users as $key => $value)
                                                <option value="{{ $key }}" {{ $IdUserDes == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('IdUserDes')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif                              
                                <div class="col-md-12">
                                    <label for="obs" class="etiBase">Observaciones</label>
                                    <input wire:model="obs" type="text" class="inpBase" id="obs">
                                    @error('obs')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
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

@if ($verModalPresu)
    <div class="modal-overlay">
        <div x-data="{}" x-init="dragModal($el)" class="modal-dialog" style="width: 80%;">
            <div class="modal-content">
                <div class="cardPrin" style="cursor: move;">
                    <div class="cardPrin-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Cargar Presupuesto</h5>
                        <button wire:click="cancel" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>
                    <div class="cardPrin-body" style="padding: 0 20px; max-height: 400px; overflow-y: auto;">
                        <form>
                            <div class="col-md-6">
                                <label for="IdPresupuesto" class="etiBase">Presupuesto</label>
                                <select id="IdPresupuesto" class="inpBase" wire:model="IdPresupuesto">
                                    <option value=""></option>
                                    @foreach ($presupuestos as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ $IdPresupuesto == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('IdPresupuesto')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="obs" class="etiBase">Observaciones</label>
                                <input wire:model="obs" type="text" class="inpBase" id="obs">
                                @error('obs')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                    </div>

                    <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
                        <a wire:click.prevent="cancel()" class="bot botCancel">Cerrar</a>
                        @if ($this->tipo == 'Compra')
                            <a wire:click.prevent="save()" class="bot botVerde">Guardar</a>
                        @else
                            <a wire:click.prevent="generarDets()" class="bot botVerde">Generar Compras</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if ($verModalCortes)
    <div class="modal-overlay-lg">
        <div class="modal-dialog-lg">
            <div class="modal-content">
                <div class="cardPrin">
                    <div class="cardPrin-header d-flex align-items-center"
                        style="display:flex; justify-content:space-between; align-items:center; gap:4px;">
                        <h5 class="m-0">
                            <i class="bi bi-diagram-3"></i> Optimización de Cortes
                        </h5>
                        {{-- centro: ocupa 70% del ancho del header --}}
                        <div style="width:70%; display:flex; gap:8px; align-items:center;">
                            <div style="flex:1; min-width:0; display:flex; align-items:center;">
                                @if($msg)
                                    <span class="badge bg-success">{{ $msg }}</span>
                                @endif
                            </div>
                            <div style="flex:1; min-width:0;">
                                <div class="progress" style="height:20px;">
                                    <div class="progress-bar"
                                        role="progressbar"
                                        style="width: {{ $avance }}%;">
                                        {{ $avance }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button wire:click="cerrarCortes" type="button" class="btn-close" aria-label="Cerrar"></button>
                    </div>

                    <div class="cardPrin-body" style="padding: 10px 20px; max-height: 80vh; overflow-y: auto;">
                        <div class="text-end small">

                        </div>
                        <div class="container-fluid py-2">
                            {{-- === PERFILES === --}}
                            <h5 class="text-primary fw-bold mb-3">
                                <i class="bi bi-justify"></i> Perfiles
                            </h5>

                            <div class="row g-3">
                                @foreach ($perfils ?? [] as $gIndex => $grupo)
                                    <div class="col-12">
                                        <div class="card shadow-sm border-0 mb-3">
                                            <div class="card-body">
                                                <h5 class="mb-3">
                                                    {{ $grupo['matCosto']->referencia ?? '' }}
                                                    {{ $grupo['matCosto']->material->material }}
                                                    {{ $grupo['matCosto']->Color->color ?? '' }}
                                                    {{ $grupo['matCosto']->UbiCodificada ?? '' }}
                                                </h5>
                                                @foreach ($grupo['barras'] as $i => $barra)
                                                    @php
                                                        $existe = $barra['existe'] ?? false;
                                                        $bgColor = $existe ? 'bg-warning-subtle' : 'bg-light';
                                                        $icon    = $existe ? 'bi-tag' : 'bi-box';
                                                        $origen  = $existe ? 'De almacén' : 'Barra nueva (compra)';
                                                    @endphp
                                                    <div class="mb-3 p-2 rounded {{ $bgColor }} border">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <span class="small fw-bold">
                                                                <i class="bi {{ $icon }} me-1 text-secondary"></i>
                                                                Barra {{ $i + 1 }}
                                                                ({{ $barra['longitud'] ?? $grupo['longitudBarra'] }} mm)
                                                                — {{ $origen }}
                                                                | Retal final: {{ $barra['retal'] ?? 0 }} mm
                                                                <span class="text-success">
                                                                    | {{ count($barra['cortes']) }}
                                                                    corte{{ count($barra['cortes']) !== 1 ? 's' : '' }}
                                                                </span>
                                                            </span>
                                                            <a class="bot botNaranja"
                                                            wire:click="cortar('perfil', {{ $gIndex }}, {{ $i }})">
                                                            Cortar
                                                            </a>
                                                        </div>
                                                        <div class="small text-muted mb-1">
                                                            @foreach ($barra['cortes'] as $corte)
                                                                <span class="me-2">
                                                                    <strong>{{ $corte['etiqueta'] }}</strong>
                                                                    ({{ round($corte['dim'], 0) }})
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                        <div class="w-100 border rounded overflow-hidden">
                                                            <svg width="100%" height="30"
                                                                viewBox="0 0 {{ $barra['longitud'] ?? $grupo['longitudBarra'] }} {{ $grupo['longitudBarra'] / 50 }}"
                                                                preserveAspectRatio="xMidYMid meet"
                                                                class="border rounded bg-white">
                                                                <rect x="0" y="0"
                                                                    width="{{ $barra['longitud'] ?? $grupo['longitudBarra'] }}"
                                                                    height="{{ $grupo['longitudBarra'] / 10 }}"
                                                                    fill="#e9ecef" stroke="#aaa" />
                                                                @php $x = 0; @endphp
                                                                @foreach ($barra['cortes'] as $corte)
                                                                    @php
                                                                        if (!empty($corte['hecho'])) {
                                                                            $fill   = '#19875466';   // verde
                                                                            $stroke = '#198754';
                                                                        } else {
                                                                            $fill   = $grupo['matCosto']->Color?->colorRgba ?? '#0d6efd22';
                                                                            $stroke = '#000'; // sin función contraste
                                                                        }
                                                                    @endphp
                                                                    <rect x="{{ $x }}" y="0"
                                                                        width="{{ $corte['dim'] }}"
                                                                        height="{{ $grupo['longitudBarra'] / 30 }}"
                                                                        fill="{{ $fill }}"
                                                                        stroke="{{ $stroke }}" />

                                                                    @php $x += $corte['dim'] + $grupo['merma']; @endphp
                                                                @endforeach
                                                            </svg>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- === VIDRIOS === --}}
                            <h5 class="text-success fw-bold mb-3 mt-4">
                                <i class="bi bi-grid-1x2"></i> Vidrio | # Paneles
                                {{ $optim['vidrios']['paneles']}}, # Cortes {{ $optim['vidrios']['cortes'] }}
                            </h5>
                            <div class="row g-3">
                                @foreach ($vidrios ?? [] as $gIndex => $grupo)
                                    <div class="col-12">
                                        <div class="card shadow-sm border-0 mb-3">
                                            <div class="card-body">
                                                <h5 class="mb-3">
                                                    {{ $grupo['matCosto']->referencia ?? '' }}
                                                    {{ $grupo['matCosto']->material->material }}
                                                    {{ $grupo['matCosto']->Color->color ?? '' }}
                                                    Panel: {{ $grupo['anchoPanel'] }} × {{ $grupo['altoPanel'] }} mm
                                                    {{ $grupo['matCosto']->UbiCodificada ?? '' }}
                                                </h5>

                                                @foreach ($grupo['hojas'] as $i => $hoja)
                                                    @php
                                                        $existe  = $hoja['existe'] ?? false;
                                                        $bgColor = $existe ? 'bg-warning-subtle' : 'bg-light';
                                                        $icon    = $existe ? 'bi-tag' : 'bi-box';
                                                        $origen  = $existe ? 'De almacén' : 'Comprar';
                                                    @endphp

                                                    <div class="mb-3 p-2 rounded {{ $bgColor }} border">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <span class="small fw-bold">
                                                                <i class="bi {{ $icon }} me-1 text-secondary"></i>
                                                                Hoja {{ $i + 1 }} — {{ $origen }} |
                                                                ( {{ $hoja['ancho'] }} × {{ $hoja['alto'] }} mm ) |
                                                                <span class="text-success">
                                                                    {{ count($hoja['cortes']) }}
                                                                    corte{{ count($hoja['cortes']) !== 1 ? 's' : '' }}
                                                                </span>
                                                            </span>
                                                            <a class="bot botNaranja"
                                                            wire:click="cortar('vidrio', {{ $gIndex }}, {{ $i }})">Cortar</a>
                                                        </div>

                                                        <div class="small text-muted mb-1">
                                                            @foreach ($hoja['cortes'] as $corte)
                                                                <span class="me-2">
                                                                    <strong>{{ $corte['etiqueta'] }}</strong>
                                                                    ({{ round($corte['ancho'], 0) }}×{{ round($corte['alto'], 0) }})
                                                                </span>
                                                            @endforeach
                                                        </div>

                                                        <div class="w-100 border rounded overflow-hidden">
                                                            <svg width="100%" height="400"
                                                                viewBox="0 0 {{ $hoja['ancho'] }} {{ $hoja['alto'] }}"
                                                                preserveAspectRatio="xMidYMid meet"
                                                                class="bg-white border rounded">

                                                                <rect width="{{ $hoja['ancho'] }}"
                                                                    height="{{ $hoja['alto'] }}"
                                                                    fill="#e9ecef" stroke="#aaa" />

                                                                @foreach ($hoja['cortes'] as $corte)
                                                                    @php
                                                                        if (!empty($corte['hecho'])) {
                                                                            $fill   = '#19875466';   // verde
                                                                            $stroke = '#198754';
                                                                        } else {
                                                                            $fill   = '#0d6efd22';   // azul tenue (mismo criterio que perfiles)
                                                                            $stroke = '#000';
                                                                        }
                                                                    @endphp

                                                                    <rect x="{{ $corte['x'] }}"
                                                                        y="{{ $corte['y'] }}"
                                                                        width="{{ $corte['ancho'] }}"
                                                                        height="{{ $corte['alto'] }}"
                                                                        fill="{{ $fill }}" stroke="{{ $stroke }}" />
                                                                @endforeach
                                                            </svg>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
                        <a wire:click.prevent="cerrarCortes" class="bot botCancel">Cerrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
