@section('title', __('Prendas'))
<div class="container-fluid">
    <div class="cardPrin">
        <div class="cardPrin-header d-flex justify-content-between align-items-center">
            Crear tu cuenta
        </div>
        <div class="cardPrin-body">
            <form>
                <div class="row">
                    <div class="col-12">
                        <label for="name" class="etiBase">Nombre</label>
                        <input wire:model="name" type="text" class="inpBase" id="name">
                        @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="telefono" class="etiBase">Telefono</label>
                        <input wire:model="telefono" type="text" class="inpBase" id="telefono">
                        @error('telefono')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>                  
                </div> 
            </form>
        </div>
        @if (session()->has('message'))
            <div wire:poll.15s class="alert alert-success fade show" >{{ session('message') }}</div>
        @endif
        <div class="cardPrin-footer mt-3 d-flex justify-content-end gap-2">
            <a href="{{ url('/home') }}" class="bot botNegro">
                Cerrar
            </a>            
            <button wire:click.prevent="save()" class="bot botVerde">Guardar</button>
        </div>
    </div>

</div>
