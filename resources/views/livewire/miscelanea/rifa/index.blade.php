@include('livewire.miscelanea.rifa.estilos')
<div class="container">
        <div class="cardPrin-header">
            <h3 class="mb-0 text-center fw-bold">Rifa</h3>
            <ul class="nav nav-pills nav-fill" id="raffleTabs">
                <li class="nav-item">
                    <button class="bot botVerde botPill" onclick="changeTab('config', this)">
                        <i class="bi bi-gear-fill"></i> 1. Config
                    </button>
                </li>
                <li class="nav-item border-start">
                    <button class="bot botVerde botPill" onclick="changeTab('play', this)">
                        <i class="bi bi-trophy-fill"></i> 2. Rifa
                    </button>
                </li>
            </ul>
        </div>
        <div class="cardPrin-body">
            <!-- SECCIÓN 1: CONFIGURACIÓN -->
            <div id="pane-config" class="tab-pane-custom active">
                <div class="row g-2">
                    <div class="col-4">
                        <label class="etiBase">De</label>
                        <input type="number" id="minN" class="inpBase" value="1">
                    </div>
                    <div class="col-4">
                        <label class="etiBase">A</label>
                        <input type="number" id="maxN" class="inpBase" value="20">
                    </div>
                    <div class="col-4">
                        <label class="etiBase">Premiados</label>
                        <input type="number" id="winnersCount" class="inpBase" value="3">
                    </div>
                    <div class="col-12">
                        <button onclick="setupRaffle()" class="bot botVerde shadow-sm">
                            <i class="bi bi-people-fill"></i> Generar Participantes
                        </button>
                        <p class="text-muted small text-center">Haz clic en un número para desactivarlo/activarlo</p>
                    </div>
                </div>
                <div id="participantsGrid" class="grid-numbers rounded-3 border"></div>
            </div>

            <!-- SECCIÓN 2: EL SORTEO -->
            <div id="pane-play" class="tab-pane-custom text-center">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="roulette-container">
                            <canvas id="rouletteCanvas" width="400" height="400"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div id="statusLabel" class="h4 fw-bold text-success mb-1">¡Suerte!</div>
                        <div class="col-12">
                            <button id="spinBtn" onclick="startSpin()" class="bot botVerde">¡ Girar !</button>
                            <button onclick="resetRaffle()" class="bot botRojo">Reiniciar</button>
                        </div>
                        <div id="winnersHistory" class="d-flex flex-wrap justify-content-center border rounded bg-white"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('livewire.miscelanea.rifa.script')