@section('title', __('Miscelanea'))

<div class="tabbar-container">
    <input type="radio" id="tab1" name="tabs">
    <input type="radio" id="tab2" name="tabs">
    <input type="radio" id="tab3" name="tabs">
    <div class="tabbar">
        <label for="tab1">📞 Teléfonos</label>
        <label for="tab2">🗺️ Mapa</label>
        <label for="tab3">🎟️ Rifa</label>
    </div>
    <div class="main tab1">@include('livewire.miscelanea.servidores')</div>
    <div class="main tab2">@include('livewire.miscelanea.mapa')</div>
    <div class="main tab3">@include('livewire.miscelanea.rifa.index')</div>
</div>
@include('livewire.miscelanea.mapaConfig')
