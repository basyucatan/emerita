
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    let map;

    function activarTab() {
        const hash = location.hash || '#servidores';
        const tab = {
            '#servidores': 'tab1',
            '#mapa': 'tab2',
            '#rifa': 'tab3'
        }[hash] || 'tab1';
        document.getElementById(tab).checked = true;
        if (tab === 'tab2') setTimeout(initMap, 100);
    }

    function initMap() {
        if (map) return;
        const el = document.getElementById('map');
        if (!el) return;
        map = L.map(el).setView([20.967120, -89.624285], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
            .addTo(map);
        const distritos = @json($distritos);
        const distritoColors = { 
            1: '#ffcc33', 2: '#9B59B6', 3: '#66CC33', 4: '#FF33F6', 5: '#00A533',
            6: '#99aa20', 7: '#3498DB', 8: '#F4D03F', 9: '#F35577', 10: '#D35400',
            11: '#ff00B9', 12: '#ff40B9', 13: '#9B59B6', 14: '#E74C3C', 15: '#2ECC71',
            16: '#E67E22', 17: '#1F618D', 18: '#00A533', 19: '#ff0000', 20: '#ff0000',
            21: '#F4D03F', 22: '#3498DB', 23: '#45B39D', 24: '#1F618D', 25: '#5DADE2'
        };
        distritos.forEach(d => {
            if (!d.porcionGeo) return;
            try {
                const coords = JSON.parse(d.porcionGeo);
                const color = distritoColors[d.distrito] || '#666';
                L.polygon(coords, {
                    color: color,
                    weight: 2,
                    fillColor: color,
                    fillOpacity: 0.25
                })
                .addTo(map)
                .bindPopup(
                    `<strong>Distrito ${d.distrito}</strong><br>${d.direccion ?? ''}`
                );
            } catch (e) {
                console.error('Error en porcionGeo distrito', d.distrito, e);
            }
        });
        distritos.forEach(d => {
            if (!d.ubicacion) return;
            const c = d.ubicacion.split(',').map(Number);
            if (c.length !== 2) return;
            L.circleMarker(c, { radius: 6, color: 'red' })
                .addTo(map)
                .bindPopup(
                    `<strong>Distrito ${d.distrito}</strong><br>
                    MCD: ${d.mcd?.servidor ?? ''}<br>
                    T: ${d.mcd?.telefono ?? ''}`
                );
        });
        @json($grupos).forEach(g => {
            if (!g.ubicacion) return;
            const c = g.ubicacion.split(',').map(Number);
            if (c.length !== 2) return;
            L.circleMarker(c, { radius: 6, color: 'blue' })
                .addTo(map)
                .bindPopup(
                    `<strong>${g.grupo}</strong>
                    <br>${g.direccion ?? ''}
                    ${g.RSG ? `<br>RSG: ${g.RSG}` : ''}`
                );
        });
        setTimeout(() => map.invalidateSize(), 200);
    }
    activarTab();
    window.addEventListener('hashchange', activarTab);
    const offcanvas = document.getElementById('offcanvasMenu');
    offcanvas?.querySelectorAll('a[href*="/miscelanea#"]').forEach(a => {
        a.onclick = () => bootstrap.Offcanvas.getInstance(offcanvas)?.hide();
    });
});
</script>
@endpush
