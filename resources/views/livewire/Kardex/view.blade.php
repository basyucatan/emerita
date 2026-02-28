@section('title', __('Kardex'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header" 
                    style="display: grid; grid-template-columns: 35% 35% 20% 5%; align-items: center; gap: 5px;">
                    
                    <div>
                        Kardex <span style="font-family: Times;"> | {{ $matCosto->material->material ?? ''}} 
                            {{ $matCosto->referencia ?? ''}}</span>
                    </div>
                    <div style="display: flex; align-items: left; gap: 2px;">
                        <select id="IdDepto" class="inpSolo"
                            wire:model="IdDepto" wire:change="calcularMovs({{ $matCosto?->id }})">
                            <option value=""></option>
                            @foreach ($deptos as $key => $value)
                                <option value="{{ $key }}" {{ $IdDepto == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>    
                        <span style="color: black;">
                            ({{ number_format($existencia, 3) }})
                        </span>  
                    </div>
                    <div style="text-align: right;">
                        <a wire:click="exisDepto({{ $IdDepto }})" 
                            class="bot botNaranja" title="Existencias del departamento seleccionado">
                            <i class="bi-box-seam"></i>
                        </a>  
                        <a wire:click="existencias()" 
                            class="bot botVerde" title="Existencias totales">
                            <i class="bi-box"></i>
                        </a>                        
                    </div>
                </div>
                <div class="cardPrin-body">
                    <div  class="row g-1">
                        <div class="col-md-4">
                            @livewire('materialsarbol', ['nivel' => 4])                                
                        </div>
                        <div class="col-md-8">
                            <div class="cardSec" style="overflow-y: auto; height: 70vh; min-height: 200px;">
                                @if($movs && $movs->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered tabBase">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Tipo</th>
                                                    <th>Unidad</th>
                                                    <th>E/S</th>
                                                    <th>Envió</th>
                                                    <th>Recibió</th>
                                                    <th style="text-align: right;">Cantidad</th>
                                                    <th style="text-align: right;">Valor/U</th>
                                                    <th style="text-align: right;">Saldo</th>
                                                    <th style="text-align: right;">$ MXN</th>
                                                    <th>Adicionales</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($movs as $row)
                                                    <tr>
                                                        <td>{{ App\Models\Util::formatFecha($row->fechaH ?? '-','CortaDhm') }}</td>
                                                        <td>{{ substr($row->tipo ?? '-', 0, 3) }}</td>
                                                        <td>{{$row->Valores['unidad'] }}</td>
                                                        <td>
                                                            @if($row->sentido === 'Entrada')
                                                                <i class="bi bi-box-arrow-in-down text-success"></i>
                                                            @else
                                                                <i class="bi bi-box-arrow-up text-danger"></i>
                                                            @endif
                                                        </td>
                                                        <td>{{ $row->UserOri?->name ?? '-' }}</td>
                                                        <td>{{ $row->UserDes?->name ?? '-' }}</td>
                                                        <td style="text-align: right;" class="{{ $row->sentido == 'Entrada' ? 'text-success' : 
                                                            ($row->sentido == 'Salida' ? 'text-danger' : 'text-dark') }}">
                                                            {{ $row->cantidad }}
                                                        </td>
                                                    
                                                        <td style="text-align: right;">{{ number_format($row->valorU ?? '-',2) }}</td>
                                                        <td style="text-align: right;">
                                                            {{ is_numeric($row->saldo) ? number_format($row->saldo, 3) : '-' }}
                                                        </td>
                                                        <td style="text-align: right;">
                                                            {{ number_format( $row->saldo * $row->Valores['valorURealMXN'], 2) }}
                                                        </td>                                                        
                                                        <td style = "color: red; font-weight: bold">
                                                            {{ $row->adicionalesTexto }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted">No hay movimientos de inventario.</p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
