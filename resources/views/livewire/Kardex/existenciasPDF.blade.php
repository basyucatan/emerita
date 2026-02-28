<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Existencias Generales por Departamento</title>
    <link rel="stylesheet" href="{{ public_path('css/presuPDF.css') }}">
</head>
<body>
    {{-- Encabezado principal --}}
    <table class="tablaSB">
        <tr>
            <td style="width: 30%; text-align: left;">
                @if(!empty($negocio->logo) && file_exists(public_path('img/' . $negocio->logo)))
                    <img src="{{ public_path('img/' . $negocio->logo) }}" alt="Logo" style="max-width: 100%; height: auto;">
                @endif
            </td>
            <td>
                <div class="subtitulo">Existencias Generales por Departamento</div>
            </td>
        </tr>
    </table>

    {{-- Contenido por departamento --}}
    @forelse($existencias as $deptoId => $grupo)
        <h3 style="margin-top: 15px;">{{ $grupo['nombre'] ?? 'Sin nombre' }}</h3>

        <table class="table-responsive tablaCB" style="margin-top: 5px;">
            <thead>
                <tr>
                    <th>Referencia</th>
                    <th>Material</th>
                    <th>Unidad</th>
                    <th>Existencia</th>
                    <th>Valor/U</th>
                    <th>$ MXN</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grupo['items'] ?? [] as $row)
                    <tr>
                        <td style="text-align:left">{{ $row['referencia'] ?? '' }}</td>
                        <td style="text-align:left">{{ $row['material'] ?? '' }}</td>
                        <td style="text-align:left">{{ $row['unidad'] ?? '' }}</td>
                        <td style="text-align:right">{{ number_format($row['existencia'] ?? 0, 3) }}</td>
                        <td style="text-align:right">
                            {{ number_format($row['valorU'] ?? 0, 2) }}{{ $row['monedaSim'] ?? '$' }}
                        </td>
                        <td style="text-align:right">{{ number_format($row['valorUMXN'] ?? 0, 2) }}</td>
                        <td style="text-align:right">{{ number_format($row['importe'] ?? 0, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;">Sin existencias</td>
                    </tr>
                @endforelse

                <tr>
                    <td colspan="6" style="text-align:right;"><strong>Total Departamento</strong></td>
                    <td style="text-align:right;">
                        <strong>${{ number_format($grupo['total'] ?? 0, 2) }}</strong>
                    </td>
                </tr>
            </tbody>
        </table>
    @empty
        <p style="text-align:center; margin-top: 20px;">No hay existencias registradas en ningún departamento.</p>
    @endforelse
</body>
</html>
