@section('title', __('Catálogos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
        <div class="cardPrin-header">
            <div>Catálogos</div>
            <div>
                <select wire:model.live="catalogo" class="inpSolo">
                    @foreach($catalogos as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button class="bot botVerde" wire:click="create">+</button>
            </div>
        </div>
                <div class="cardPrin-body">
                    <div class="table-responsive">
                        <table class="table tabBase">
                            <thead>
                                <tr>
                                    @foreach($cols as $col)
                                        <th>{{ ucwords(preg_replace('/(?<!^)[A-Z]/', ' $0', $col)) }}</th>
                                    @endforeach
                                    <th width="100" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                    <tr>
                                        @foreach($cols as $col)
                                            <td>{{ $item[$col] ?? '' }}</td>
                                        @endforeach
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a wire:click="edit({{ $item['id'] }})" class="bot botNaranja" title="Editar">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a wire:click="destroy({{ $item['id'] }})" class="bot botRojo" onclick="confirm('¿Eliminar registro?') || event.stopImmediatePropagation()" title="Eliminar">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">No se encontraron datos en este catálogo.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.catalogos.modals')
</div>
