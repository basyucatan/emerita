@section('title', __('Carrito'))
<div class="tabbar-container">
    @include('livewire.carritos.modals')
    <input type="radio" id="tab1" name="tabs" checked>
    <input type="radio" id="tab2" name="tabs">
    <input type="radio" id="tab3" name="tabs">
    <div class="tabbar">
        <label for="tab1">🧑‍💻 Pedidos</label>
        <label for="tab2">📚 Prod</label>
        <label for="tab3">💵 Resumen</label>
    </div>
    <div class="main tab1">@include('livewire.carritos.pedidos')</div>
    <div class="main tab2">@include('livewire.carritos.productos')</div>
    <div class="main tab3">@include('livewire.carritos.pedido')</div>
</div>