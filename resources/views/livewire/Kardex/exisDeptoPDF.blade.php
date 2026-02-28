<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Existencias del Departamento #{{ $depto->depto }}</title>
    <link rel="stylesheet" href="{{ public_path('css/presuPDF.css') }}">
</head>
<body>
    <table class="tablaSB">
        <tr>
            <td style="width: 30%; text-align: left;">
                <img src="{{ public_path('img/' . $negocio->logo) }}" alt="Logo"
                    style="max-width: 100%; height: auto;"> 
            </td>
            <td>
                Existencias del Departamento
                <div class="subtitulo">
                    {{ $depto->depto }}
                </div>
            </td>
        </tr>
    </table>
    @php
        // Como solo se pasa un depto, obtenemos el primero del array
        $datosDepto = $existencias->first();
        $items = $datosDepto['items'] ?? collect();
    @endphp

    <table class="table-responsive tablaCB" style="margin-top: 8px;">
        <thead>
            <tr>
                <th>Referencia</th>
                <th>Material</th>
                <th>Unidad</th>
                <th>Existencia</th>
                <th>ValorU</th>
                <th>ValorMXN</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $row)
                <tr>
                    <td style="text-align:left">{{ $row['referencia'] }}</td>
                    <td style="text-align:left">{{ $row['material'] }}</td>
                    <td style="text-align:left">{{ $row['unidad'] }}</td>
                    <td style="text-align:right">{{ number_format($row['existencia'], 3) }}</td>
                    <td style="text-align:right">{{ number_format($row['valorU'], 2).$row['monedaSim'] }}</td>
                    <td style="text-align:right">{{ number_format($row['valorUMXN'], 2) }}</td>
                    <td style="text-align:right">{{ number_format($row['importe'], 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay existencias registradas.</td>
                </tr>
            @endforelse
            <tr>
                <td colspan="6" style="text-align:right;"><strong>Total Departamento</strong></td>
                <td style="text-align:right;">
                    <strong>${{ number_format($datosDepto['total'] ?? 0, 2) }}</strong>
                </td>
            </tr>            
        </tbody>
    </table>

</body>
</html>

