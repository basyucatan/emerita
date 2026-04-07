@extends('layouts.app')
@section('title', __('Welcome'))
@section('content')
<style>
    .objeto3D {
        position: relative;
        transform-style: preserve-3d;
        animation: giroGlobal 8s linear infinite;
        will-change: transform;
    }
    .svg3D {
        width: 140px;
        height: 140px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transform-style: preserve-3d;
    }
    .svgCapa {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }
    .svgCapa svg {
        display: block;
        width: 100%;
        height: 100%;
        fill: currentColor !important;
    }
    .svgFrontal {
        filter: drop-shadow(0 0 15px rgba(220, 53, 69, 0.5));
    }
    @keyframes giroGlobal {
        from { transform: rotateY(0deg) }
        to { transform: rotateY(360deg) }
    }
</style>
<div class="container">
    <div class="card text-center overflow-hidden d-flex flex-column" 
        style="background: linear-gradient(135deg, #0f172a, #1e3a8a); min-height: 400px;">
        
        <div id="contLogo" style="height: 180px; position: relative; margin-top: 100px; margin-bottom: -30px;">
            <div id="contSvg" class="d-none">
                @include('logo')
            </div>
        </div>

        <p class="text-white mb-0">Sistema Administrativo</p>
        
        <div class="mt-2">
            @auth
                <a href="/ocompras" class="bot botNegro">Compras</a>
            @else
                <a href="/login" class="bot botVerde">Acceder</a>
            @endauth
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const nodoOrigen = document.getElementById('contSvg');
        const contenedorPadre = document.getElementById('contLogo');
        if (!nodoOrigen || !contenedorPadre) return;
        const totalCapas = 30;
        const contenidoSvg = nodoOrigen.innerHTML;
        const objeto3D = document.createElement('div');
        objeto3D.className = 'objeto3D';
        const contenedorSvg3D = document.createElement('div');
        contenedorSvg3D.className = 'svg3D';
        const capaFrontal = document.createElement('div');
        capaFrontal.className = 'svgCapa svgFrontal';
        capaFrontal.style.color = '#dc3545';
        capaFrontal.innerHTML = contenidoSvg;
        contenedorSvg3D.appendChild(capaFrontal);
        const fragmentoCapas = document.createDocumentFragment();
        for (let i = 1; i <= totalCapas; i++) {
            const capaInterna = document.createElement('div');
            capaInterna.className = 'svgCapa';
            if (i === totalCapas) {
                capaInterna.style.color = '#000000';
            } else {
                capaInterna.style.color = '#f1f5f9';
                capaInterna.style.filter = `brightness(${1 - (i / totalCapas)})`;
            }
            capaInterna.style.transform = `translateZ(${-i * 0.8}px)`;
            capaInterna.innerHTML = contenidoSvg;
            fragmentoCapas.appendChild(capaInterna);
        }
        contenedorSvg3D.appendChild(fragmentoCapas);
        objeto3D.appendChild(contenedorSvg3D);
        contenedorPadre.appendChild(objeto3D);
    });
</script>
@endsection