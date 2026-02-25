@section('title', __('Inquietuds'))

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cardPrin">
                <div class="cardPrin-header">
                    Distritos y Grupos
                </div>
                <div class="cardPrin-body row g-0">
                    <div class="col-12 col-md-4">
                        @livewire('Arboldistritos')
                    </div>
                    <div class="col-12 col-md-8">
                        @livewire('Estructuradistrito')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
