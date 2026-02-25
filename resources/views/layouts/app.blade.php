<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('img/logo.ico') }}" type="image/x-icon">
    <title>{{ config('app.name', 'Laravel') }} | @hasSection('title')
            @yield('title')
        @endif
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/js/app.js'])
    @livewireStyles
    <link href="{{ asset('css/cssBase.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body style="overflow-y: hidden; height: 100%; margin: 0;">
    <div id="app">
        @include('layouts.sidebar')
        <div id="vistaPrin">
            <div id="contenido">
                @yield('content')
            </div>
        </div>
    </div>

<!-- Leaflet -->
<link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
{{-- chart js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @livewireScripts    
    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/jsBase.js') }}"></script>
    
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<link rel="stylesheet" href="https://unpkg.com/tippy.js@6/themes/light.css"/>

</body>

</html>
