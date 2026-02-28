<div class="col-12 etiBase" style="text-align: center">Destino</div>
<div class="col-12">
    <label class="etiBase">Zona</label>
    <input type="text" list="zonas" 
        wire:model.defer="destino.zona" class="inpBase" >
    <datalist id="zonas">
        @foreach ($zonas as $value)
            <option value="{{ $value }}"></option>
        @endforeach
    </datalist>
    @error('destino.zona') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="col-12">
    <label class="etiBase">Pasillo</label>
    <input type="text" list="pasillos" 
        wire:model.defer="destino.pasillo" class="inpBase" >
    <datalist id="pasillos">
        @foreach ($pasillos as $value)
            <option value="{{ $value }}"></option>
        @endforeach
    </datalist>
    @error('destino.zona') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="col-12">
    <label class="etiBase">Anaquel</label>
    <input type="text" list="anaqueles" 
        wire:model.defer="destino.anaquel" class="inpBase" >
    <datalist id="anaqueles">
        @foreach ($anaqueles as $value)
            <option value="{{ $value }}"></option>
        @endforeach
    </datalist>
    @error('destino.anaquel') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="col-12">
    <label class="etiBase">Nivel</label>
    <input type="text" list="posiciones" 
        wire:model.defer="destino.posicion" class="inpBase" >
    <datalist id="posiciones">
        @foreach ($posiciones as $value)
            <option value="{{ $value }}"></option>
        @endforeach
    </datalist>
    @error('destino.posicion') <span class="text-danger">{{ $message }}</span> @enderror
</div>

