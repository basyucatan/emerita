@section('title', __('Inquietuds'))

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">

                <div class="cardPrin-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Inquietudes ({{ $inquietuds->count() }})</div>
                        <div>
                            <input wire:model.live="keyWord" type="text" class="form-control" placeholder="Buscar">
                        </div>
                        <div class="bot botVerde" wire:click="create" title="Nueva Inquietud">
                            Nueva
                        </div>
                    </div>
                </div>
                <div class="cardPrin-body">
                    @include('livewire.inquietuds.modals')
                    <div class="row g-1">
                        @forelse($inquietuds as $row)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="cardSec">
                                    <div class="cardSec-header">
                                        <div style="display:flex; flex-direction:column;">
                                            <div>
                                                {{ $row->titulo }}
                                                ({{ $row->Comite->abreviatura }})
                                                @if ($row->estatus == 'edicion')
                                                    <div class="bot botBlanco">🧑‍💻</div>
                                                @endif
                                                @if ($row->estatus == 'atendido')
                                                    <div class="bot botVerde">✔️</div>
                                                @endif
                                                @if ($row->estatus == 'nocivo')
                                                    <div class="bot botRojo">⚠️</div>
                                                @endif
                                            </div>
                                            <div style="font-size: 12px;">
                                                {{ explode(' ', trim($row?->nombre))[0] }},
                                                {{ \App\Models\Util::formatFecha($row->fecha, 'D/MMM/AA') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cardSec-body">
                                        <strong>
                                            {{ $row->inquietud }}
                                        </strong>
                                        <div class="table-responsive">
                                            <table class="table tabBase ch">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Usuario</th>
                                                        <th>Cambios</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($row->adicionales ?? [] as $h)
                                                        <tr>
                                                            <td>
                                                                <span>
                                                                    {{ \App\Models\Util::formatFecha($h['Fecha'], 'abreviada') ?? '-' }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span>
                                                                    {{explode(' ', $h['Usuario'] ?? '-')[0] }}
                                                                </span>
                                                            </td>
                                                            <td >
                                                                @if (!empty($h['Cambios']))
                                                                    <ul>
                                                                        @foreach ($h['Cambios'] as $campo => $c)
                                                                        <li title="{{ $c['despues'] }}">
                                                                            <strong>{{ $campo }}:</strong>
                                                                            → “{{ \Illuminate\Support\Str::limit($c['despues'], 18, '...') }}”
                                                                        </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @else
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3" class="text-center">Sin historial.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>                                        
                                    </div>
                                    <div class="cardSec-footer">
                                        @if ($row->estatus == 'edicion')
                                            <button wire:click="cambiarEstatus({{ $row->id }}, 'aprobar')"
                                                class="bot botAzul">
                                                ✅ Enviar
                                            </button>
                                            <button wire:click="edit({{ $row->id }})" class="bot botNaranja"
                                                title="Editar">
                                                <i class="bi-pencil-square"></i>
                                            </button>
                                            <button wire:click="destroy({{ $row->id }})" class="bot botRojo"
                                                onclick="confirm('¿Seguro?') || event.stopImmediatePropagation()">
                                                <i class="bi-trash3-fill"></i>
                                            </button>
                                        @endif
                                        @if ($row->estatus != 'edicion')
                                            @can('admin')
                                                <button wire:click="edit({{ $row->id }})" class="bot botNaranja"
                                                    title="Editar">
                                                    <i class="bi-pencil-square"></i>
                                                </button>
                                                @if ($row->estatus == 'aprobado')
                                                    <button wire:click="cambiarEstatus({{ $row->id }}, 'atender')"
                                                        class="bot botVerde">
                                                        ☎ Atender
                                                    </button>
                                                @endif
                                                @if ($row->estatus != 'nocivo')
                                                    <button wire:click="cambiarEstatus({{ $row->id }}, 'nocivo')"
                                                        class="bot botRojo"
                                                        onclick="confirm('¿Marcar como nocivo?') || event.stopImmediatePropagation()">
                                                        ⚠️ Funar
                                                    </button>
                                                @endif
                                            @endcan
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <div class="mt-2 float-end">
                        {{ $inquietuds->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
