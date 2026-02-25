<img src="{{ public_path('img/encabezado.jpg') }}" style="width:100%;">
<table class="table tablaCB">
    <tbody>
        <tr>
            <th>Distrito</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Fecha</th>
            <th>Folio</th>
        </tr>
        <tr>
            <td>{{ $pedido->Distrito->distrito ?? '' }}</td>
            <td>{{ $pedido->adicionales['nombre'] ?? '' }}</td>
            <td>{{ $pedido->adicionales['telefono'] ?? '' }}</td>
            <td style="text-align:center;">
                {{ App\Models\Util::formatFecha($pedido->FechaH, 'CortaDhm') }}
            </td>
            <td style="text-align:center;">{{ $pedido->id }}</td>
        </tr>
    </tbody>
</table>

<table class="table tablaCB">
    <thead>
        <tr>
            <th>#</th>
            <th>Código</th>
            <th>Producto</th>
            <th>Cant</th>
            <th>Valor/U</th>
            <th>Importe</th>
        </tr>
    </thead>
    <tbody>

        @php $tArt = 0; $tImp = 0; @endphp

        @foreach ($groupedDets as $depto => $dets)
            @foreach ($dets as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->Producto->codigo }}</td>
                    <td style="text-align: left;">{{ mb_substr($row->Producto->producto, 0, 30) }}</td>
                    <td style="text-align:center;">{{ $row->cantidad }}</td>
                    <td style="text-align:right;">{{ App\Models\Util::Dinero($row->precioU) }}</td>
                    <td style="text-align:right;">
                        {{ App\Models\Util::Dinero($row->cantidad * $row->precioU) }}
                    </td>
                </tr>
            @endforeach>
            @php
                $tArt += $deptTotals[$depto]['totalArticulos'];
                $tImp += $deptTotals[$depto]['totalImporte'];
            @endphp
        @endforeach
        <tr>
            <th colspan="3">Totales</th>
            <th>{{ $tArt }}</th>
            <th></th>
            <th style="text-align:right;">{{ App\Models\Util::Dinero($tImp) }}</th>
        </tr>

    </tbody>
</table>
