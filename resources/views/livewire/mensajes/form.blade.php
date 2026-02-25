<form>
    <div class="form-group">
        <label for="titulo" class="etiBase">Título</label>
        <input wire:model="titulo" type="text" class="inpBase" id="titulo">
        @error('titulo') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="fechaIni" class="etiBase">Fecha Inicio</label>
            <input wire:model="fechaIni" type="date" class="inpBase" id="fechaIni">
            @error('fechaIni') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6">
            <label for="fechaFin" class="etiBase">Fecha Fin</label>
            <input wire:model="fechaFin" type="date" class="inpBase" id="fechaFin">
            @error('fechaFin') <span class="error text-danger">{{ $message }}</span> @enderror            
        </div>
    </div>
    <div class="form-group">
        <label for="contenido" class="etiBase">Contenido</label>
        <textarea wire:model="contenido" class="inpBase" id="contenido" rows="2"></textarea>
        @error('contenido') <span class="error text-danger">{{ $message }}</span> @enderror
    </div> 
    <div class="row">
        <div class="col-md-6">
            @if ($foto)
                @php
                    $extension = pathinfo($foto, PATHINFO_EXTENSION);
                @endphp             
            @endif
            <div class="form-group">
                <div class="row">
                    <label class="etiBase" for="fotoSubida"><i class="fas fa-camera"></i> Subir Foto</label>
                    <input wire:model="fotoSubida" type="file"  id="fotoSubida" accept="image/*">
                    @error('fotoSubida') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
        
                <div wire:loading wire:target="fotoSubida" class="text-center mt-2">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p>Cargando Foto...</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">           
            @if ($documento)
                @php
                    $extension = pathinfo($documento, PATHINFO_EXTENSION);
                @endphp             
            @endif
            <div class="form-group">
                <div class="row">
                    <label class="etiBase" for="docSubido"><i class="fas fa-file"></i> Subir Documento</label>
                    <input wire:model="docSubido" type="file" id="docSubido">
                    @error('docSubido') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
        
                <div wire:loading wire:target="docSubido" class="text-center mt-2">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p>Cargando Documento...</p>
                </div>
            </div>
        </div> 
        <div class="form-group">
            <label for="urlLink" class="etiBase">URL Link</label>
            <input wire:model="urlLink" type="text" class="inpBase" id="urlLink">
            @error('urlLink') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>                       
    </div>   
</form>
