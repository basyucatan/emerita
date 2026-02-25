
<script>
    let participantes = [];
    let ganadores = [];
    const canvas = document.getElementById('rouletteCanvas');
    const ctx = canvas.getContext('2d');
    const colores = ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6610f2', '#fd7e14', '#20c997', '#0dcaf0'];
    // --- LOGO CONFIGURATION ---
    const logoImg = new Image();
    logoImg.src = "{{ asset('img/logo.png') }}"; // URL de tu imagen
    let imgCargada = false;
    logoImg.onload = () => { imgCargada = true; drawWheel(); };
    
    function changeTab(tabId, btn) {
        document.querySelectorAll('.tab-pane-custom').forEach(p => p.classList.remove('active'));
        document.getElementById('pane-' + tabId).classList.add('active');
        
        document.querySelectorAll('#raffleTabs button').forEach(b => b.classList.remove('active'));
        if(btn) btn.classList.add('active');
        
        if(tabId === 'play') {
            setTimeout(() => drawWheel(), 100);
        }
    }

    function setupRaffle() {
        const min = parseInt(document.getElementById('minN').value) || 1;
        const max = parseInt(document.getElementById('maxN').value) || 20;
        const grid = document.getElementById('participantsGrid');
        
        grid.innerHTML = '';
        participantes = [];
        ganadores = [];
        document.getElementById('winnersHistory').innerHTML = '';
        document.getElementById('statusLabel').innerText = '¡Suerte!';
        document.getElementById('spinBtn').disabled = false;

        for (let i = min; i <= max; i++) {
            participantes.push({ id: i, isWinner: false, isActive: true });
            
            const item = document.createElement('div');
            item.id = `num-box-${i}`;
            item.className = "num-item bg-white rounded p-2 text-center fw-bold shadow-sm";
            item.innerText = i;
            
            // EL CLIC: Usamos una función anónima para pasar el ID
            item.onclick = function() {
                toggleParticipant(i);
            };
            
            grid.appendChild(item);
        }
    }

    function toggleParticipant(id) {
        // Buscamos el objeto en el array
        const p = participantes.find(x => x.id === id);
        if (!p) return;

        // Cambiamos estado
        p.isActive = !p.isActive;
        
        // Cambiamos visualmente el cuadro
        const element = document.getElementById(`num-box-${id}`);
        if (p.isActive) {
            element.classList.remove('disabled-number');
        } else {
            element.classList.add('disabled-number');
        }
        
        console.log(`Número ${id} activo: ${p.isActive}`);
    }

    function drawWheel(rotation = 0) {
        // Filtrar activos
        const activeOnes = participantes.filter(p => p.isActive);
        
        if (activeOnes.length === 0) {
            ctx.clearRect(0, 0, 400, 400);
            ctx.fillStyle = "#666";
            ctx.textAlign = "center";
            ctx.fillText("No hay participantes activos", 200, 200);
            return;
        }

        const total = activeOnes.length;
        const arc = (Math.PI * 2) / total;
        const centerX = 200;
        const centerY = 200;

        ctx.clearRect(0, 0, 400, 400);
        ctx.save();
        ctx.translate(centerX, centerY);
        ctx.rotate(rotation);

        activeOnes.forEach((p, i) => {
            const angle = i * arc;
            ctx.beginPath();
            ctx.fillStyle = p.isWinner ? '#e9ecef' : colores[i % colores.length];
            ctx.strokeStyle = '#ffffff';
            ctx.lineWidth = 2;
            ctx.moveTo(0, 0);
            ctx.arc(0, 0, 190, angle, angle + arc);
            ctx.fill();
            ctx.stroke();

            ctx.save();
            ctx.fillStyle = p.isWinner ? '#6c757d' : '#ffffff';
            ctx.font = "bold 16px Arial";
            ctx.rotate(angle + arc / 2);
            ctx.textAlign = "right";
            ctx.fillText(p.id, 170, 8);
            ctx.restore();
        });
        ctx.restore();

        // --- DRAW CENTER LOGO ---
        // Dibujamos un círculo blanco de fondo para el logo
        ctx.beginPath();
        ctx.arc(centerX, centerY, 40, 0, Math.PI * 2);
        ctx.fillStyle = "white";
        ctx.shadowBlur = 10;
        ctx.shadowColor = "rgba(0,0,0,0.2)";
        ctx.fill();
        ctx.shadowBlur = 0; // Reset shadow

        if (imgCargada) {
            const size = 60; // Tamaño del logo
            ctx.drawImage(logoImg, centerX - size/2, centerY - size/2, size, size);
        }
    }

    function startSpin() {
        const activeOnes = participantes.filter(p => p.isActive);
        const available = activeOnes.filter(p => !p.isWinner);
        const limit = parseInt(document.getElementById('winnersCount').value) || 1;

        if (available.length === 0) {
            alert("¡No quedan números activos disponibles para ganar!");
            return;
        }
        
        if (ganadores.length >= limit) {
            alert("Ya se alcanzó el límite de premiados.");
            return;
        }

        const winner = available[Math.floor(Math.random() * available.length)];
        const winnerIndex = activeOnes.indexOf(winner);
        
        const arc = (Math.PI * 2) / activeOnes.length;
        const extraSpins = (Math.PI * 2) * 8;
        const offsetToTop = (Math.PI / 2);
        const targetRotation = extraSpins - (winnerIndex * arc) - (arc / 2) - offsetToTop;
        
        document.getElementById('spinBtn').disabled = true;
        let start = null;
        const duration = 3500;

        function animation(time) {
            if (!start) start = time;
            const elapsed = time - start;
            const progress = Math.min(elapsed / duration, 1);
            const ease = 1 - Math.pow(1 - progress, 4); // Ease out Quart
            drawWheel(ease * targetRotation);
            
            if (progress < 1) {
                requestAnimationFrame(animation);
            } else {
                finalizeSpin(winner, limit);
            }
        }
        requestAnimationFrame(animation);
    }

    function finalizeSpin(winner, limit) {
        winner.isWinner = true;
        ganadores.push(winner.id);
        
        document.getElementById('statusLabel').innerText = `Felicidades ${winner.id}!`;
        
        const history = document.getElementById('winnersHistory');
        const badge = document.createElement('span');
        badge.className = "badge bg-success winner-badge";
        badge.innerText = `#${winner.id}`;
        history.appendChild(badge);
        
        drawWheel(); 
        
        // Reactivar si aún hay cupo y gente disponible
        const availableNext = participantes.filter(p => p.isActive && !p.isWinner);
        if (ganadores.length < limit && availableNext.length > 0) {
            document.getElementById('spinBtn').disabled = false;
        }
    }

    function resetRaffle() { 
        setupRaffle(); 
        changeTab('config', document.querySelector('#raffleTabs button')); 
    }

    window.onload = setupRaffle;
</script>
