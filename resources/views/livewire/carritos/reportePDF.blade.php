<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reporte de Pedidos</title>
    <link href="{{ public_path('css/cssBas.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Encabezado -->
    <img src="{{ public_path('img/encabezado.jpg') }}" alt="Logo" style="width: 100%; margin-bottom: 0;">

    <!-- Título -->
    <table class="table tabEncabezado">
        <tbody>
            <tr><th>Reporte de pedidos</th></tr>
        </tbody>
    </table>                  
    
    <!-- Tabla principal -->
    <table class="table tabImpresion">
        <thead>
            <tr>
                <th>Folio</th>
                <th>Fecha</th>
                <th>Solicitó</th>
                <th>Dist</th>
                <th>Surtió</th>
                <th>Estatus</th>
                <th>Total</th>
                <th>#Art</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ App\Models\Util::formatFecha($pedido->FechaH, 'Larga') }}</td>
                    <td>{{ $pedido->Cliente->nombre }}</td>
                    <td style="text-align: center;">{{ $pedido->Cliente->Distrito->distrito ?? '-' }}</td>
                    <td>{{ $pedido->Levanto->name }}</td>
                    <td>{{ $pedido->estatus }}</td>
                    <td style="text-align: right;">{{ App\Models\Util::Dinero($pedido->total) }}</td>
                    <td style="text-align: right;">{{ $pedido->totalArticulos }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" style="text-align: right; font-weight: bold;">Totales:</td>
                <td style="text-align: right; font-weight: bold;">{{ App\Models\Util::Dinero($totalGeneral) }}</td>
                <td style="text-align: right; font-weight: bold;">{{ $totalArticulos }}</td>
            </tr>
            <tr>
                <td colspan="8">Fecha de impresión: {{ App\Models\Util::formatFecha(now()->tz('America/Mexico_City'), 'Larga') }}</td>
            </tr>
        </tfoot>
    </table>

    <br>

    <!-- 🔹 Nueva tabla: Totales agrupados por clase -->
    <h4 style="margin-top: 20px;">Totales por Clase</h4>
    <table class="table tabImpresion">
        <thead>
            <tr>
                <th>Clase</th>
                <th>Cantidad total</th>
                <th>Total ($)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agrupadoPorClase as $fila)
                <tr>
                    <td>{{ $fila['clase'] }}</td>
                    <td style="text-align: right;">{{ number_format($fila['cantidad'], 2) }}</td>
                    <td style="text-align: right;">{{ App\Models\Util::Dinero($fila['total']) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="text-align: right; font-weight: bold;">Total general:</td>
                <td style="text-align: right; font-weight: bold;">{{ number_format($agrupadoPorClase->sum('cantidad'), 2) }}</td>
                <td style="text-align: right; font-weight: bold;">{{ App\Models\Util::Dinero($agrupadoPorClase->sum('total')) }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
