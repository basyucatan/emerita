@section('title', __('Unidads'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Unidads</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="form-control" placeholder="Buscar">
                        </div>
                        <div class="bot botVerde" wire:click="create" title="Nuevo Unidad">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="cardPrin-body">
                    @include('livewire.unidads.modals')
                    <div class="table-responsive">
                        <table class="table tabBase">
<thead>
    <tr>
        <th>id</th>
        <th>Tipo</th>
        <th>Unidad</th>
        <th>Abreviatura</th>
        <th>Factorconversion</th>
        <th>Prueba Conversión</th> {{-- Nueva columna --}}
        <th>Acciones</th>
    </tr>
</thead>
<tbody>
    @forelse($unidads as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->tipo }}</td>
            <td>{{ $row->unidad }}</td>
            <td>{{ $row->abreviatura }}</td>
            <td>{{ $row->factorConversion }}</td>
            {{-- COLUMNA DE PRUEBA --}}
            <td>
                @php
                    try {
                        // Buscar la unidad destino (la fila actual)
                        $destino = \App\Models\Unidad::find($row->id);
                        if (!$destino) {
                            throw new \Exception("Unidad destino no encontrada (ID: $row->id)");
                        }
                        // Buscar la unidad base para ese tipo
                        $base = \App\Models\Unidad::where('tipo', $destino->tipo)
                                    ->where('factorConversion', 1)
                                    ->first();
                        if (!$base) {
                            throw new \Exception("Unidad base no encontrada para tipo {$destino->tipo}");
                        }
                        // Determinar si es "pieza" o no
                        if (strtolower($destino->tipo) === 'pieza') {
                            // Usar valores fijos para pieza por ejemplo un tubo de silicon = 11,000 mm (11m)
                            $res = \App\Models\Unidad::Convertir(
                                18000,         // Para 18 metros de sellado
                                2,    //fila del milimetro
                                $row->id,     // unidad destino debe ser 'pieza'
                                11,           // 1 tubo silicon da 11m
                                3,            // fila del metro
                                "id $row->id m->pz"
                            );
                        } else {
                            // Conversión simple para los demás tipos
                            $res = \App\Models\Unidad::Convertir(
                                1.55,         // 1.55 m o 1.55 m²
                                $base->id,    // unidad origen
                                $row->id,     // unidad destino
                                null,
                                null,
                                "id $row->id normal"
                            );
                        }
                        // Formatear y comparar con valor actual en columna prueba
                        $resultadoTexto = number_format($res['valor'], 2) . ' ' . $res['unidad'];

                        if ($row->prueba !== $resultadoTexto) {
                            $row->update(['prueba' => $resultadoTexto]);
                        }
                        echo $resultadoTexto;
                    } catch (\Exception $e) {
                        echo '<span class="text-danger" title="' . e($e->getMessage()) . '">Error</span>';
                    }
                @endphp
            </td>
            <td width="120">
                <div class="d-flex justify-content-around align-items-center gap-1">
                    <a wire:click="edit({{ $row->id }})" class="bot botNaranja" title="Editar">
                        <i class="bi-pencil-square"></i>
                    </a>
                    <a wire:click="destroy({{ $row->id }})" class="bot botRojo" onclick="confirm('¿Estás seguro de eliminar este registro?') || event.stopImmediatePropagation()">
                        <i class="bi-trash3-fill"></i>
                    </a>
                </div>
            </td>
        </tr>
    @empty
        <tr><td colspan="100%" class="text-center">No se encontraron datos.</td></tr>
    @endforelse
</tbody>

                        </table>
                        <div class="float-end">
                            {{ $unidads->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
