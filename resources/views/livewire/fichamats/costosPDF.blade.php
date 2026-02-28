<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Materiales sin costo</title>
    <link rel="stylesheet" href="{{ public_path('css/presuPDF.css') }}">
</head>

<body class="container my-4 text-secondary">
    <div class="container-fluid mt-3">
        <div class="cardPrin">
            <div class="cardPrin-body">
                <table class="tablaSB">
                    <tr>
                        <td>
                            <img src="{{ public_path('img/' . $negocio->logo) }}" alt="Logo"
                                style="max-width: 30%; height: auto;"><br>
                        </td>
                        <td>
                            <h4>Listado de Materiales</h4>
                            <h4>Total ({{ $totalGeneral }})</h4>
                        </td>
                    </tr>
                </table>
                <hr>
                <table class="tablaCB" style="margin-top: 8px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Material</th>
                            <th>Referencia</th>
                            <th>Ubicación</th>
                            <th>Color</th>
                            <th>Barra</th>
                            <th>Panel</th>
                            <th style="text-align:right;">Costo</th>
                            <th style="text-align:center;">Moneda</th>
                            <th style="text-align:right;">$MXN</th>
                        </tr>
                    </thead>

                    <tbody>

                        {{-- NIVEL 1 → CLASE --}}
                        @php $contador = 1; @endphp
                        @forelse($agrupados as $idClase => $marcasGroup)
                            @php
                                $claseNombre =
                                    $marcasGroup->first()->first()->first()?->material?->Clase?->clase ?? 'Sin clase';
                            @endphp

                            <tr style="background:#e6f141; font-weight:bold;">
                                <td colspan="10">{{ $claseNombre }} ({{ $totales[$idClase]['totalClase'] }})</td>
                            </tr>

                            {{-- NIVEL 2 → MARCA --}}
                            @foreach ($marcasGroup as $idMarca => $lineasGroup)
                                @php
                                    $marcaNombre =
                                        $lineasGroup->first()->first()?->material?->Linea?->Marca?->marca ??
                                        'Sin marca';
                                @endphp

                                <tr style="background:#eeeeee; font-weight:bold;">
                                    <td colspan="10">{{ $marcaNombre }} ({{ $totales[$idClase]['marcas'][$idMarca]['totalMarca'] }})</td>
                                </tr>

                                {{-- NIVEL 3 → LINEA --}}
                                @foreach ($lineasGroup as $idLinea => $items)
                                    @php
                                        $lineaNombre = $items->first()?->material?->Linea?->linea ?? 'Sin línea';
                                    @endphp

                                    <tr style="background:#f7f7f7; font-weight:bold;">
                                        <td colspan="10" style="padding-left: 20px;">
                                            {{ $lineaNombre }} ({{ $totales[$idClase]['marcas'][$idMarca]['lineas'][$idLinea] }})
                                        </td>
                                    </tr>

                                    {{-- ITEMS --}}
                                    @foreach ($items as $row)
                                        <tr>
                                            <td>{{ $contador++ }}</td>

                                            <td style="text-align:left;">{{ $row->material?->material }}</td>
                                            <td style="text-align:left;">{{ $row->referencia }}</td>
                                            <td style="text-align:left;">{{ $row->ubiCodificada }}</td>
                                            <td style="text-align:center;">
                                                @if ($row->Color)
                                                    <span class="cuadroColor"
                                                        style="background:{{ $row->Color->colorRgba }}"></span>
                                                @else
                                                    <span style="color:red;">✕</span>
                                                @endif
                                            </td>

                                            <td>{{ $row->Barra->logitud ?? '' }}</td>
                                            <td>{{ $row->Panel->panel ?? '' }}</td>

                                            <td style="text-align:right;">
                                                {{ \App\Models\Util::Dinero($row->costo, 2) }}
                                            </td>

                                            <td style="text-align:center;">
                                                {{ $row->Moneda->abreviatura ?? '' }}
                                            </td>

                                            <td style="text-align:right;">
                                                {{ number_format($row->valores['valorURealMXN'] ?? 0, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach

                        @empty
                            <tr>
                                <td colspan="100%" style="text-align:center;">No se encontraron registros.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>

</html>
