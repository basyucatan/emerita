<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Traspaso</title>
    <link rel="stylesheet" href="{{ public_path('css/presuPDF.css') }}">
</head>
<body class="container my-4 text-secondary">
    <div class="container-fluid mt-3">
        <div class="cardPrin">
            <div class="cardPrin-body">
                @php
                    $info = $traspaso->adicionales ?? [];
                @endphp
                <table class="tablaSB">
                    <tr>
                        <td>
                            <img src="{{ public_path('img/' . $negocio->logo) }}" alt="Logo"
                                style="max-width: 30%; height: auto;"><br>
                            Origen <strong>{{ $traspaso->deptoOri->depto ?? ''}}</strong><br>
                            Destino <strong>{{ $traspaso->deptoDes->depto ?? ''}}</strong><br>
                            Usuario Origen <strong>{{ $traspaso->userOri->name ?? ''}}</strong><br>
                            Usuario Destino <strong>{{ $traspaso->userDes->name ?? ''}}</strong><br>
                            {{ $negocio->email }}<br>
                        </td>
                        <td>
                            <span style="font-size: 14px;">#<strong>{{ $traspaso->id }} | {{ $traspaso->tipo }} ( {{ $traspaso->estatus }} )</strong></span><br>
                            Fecha <strong>{{ \App\Models\Util::formatFecha($traspaso->fecha, 'D/MMM/AA')}}</strong><br> 
                            Marca: <strong>{{ $info['marca'] ?? '-' }} </strong><br>
                            Presupuesto: <strong>{{ $info['IdPresupuesto'] ?? '-' }} </strong><br>
                            Tipo C€: <strong>{{ $info['tipoCEuro'] ?? '-' }} </strong><br>
                            Total <strong>${{ number_format($traspaso?->Total,2) ?? ''}}</strong><br>
                        </td>
                    </tr>
                </table>
                <hr>
                <table class="tablaCB" style="margin-top: 8px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cant</th>
                            <th>U</th>
                            <th>Referencia</th>
                            <th>Material</th>
                            <th>Color</th>
                            <th>Valor/U</th>
                            {{-- <th>Importe</th> --}}
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($traspaso->traspasosdets as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->cantidad }}</td>
                                <td style="text-align: left;">{{ $row->Unidad }}</td>
                                <td style="text-align: left;">{{ $row->Referencia }}</td>
                                <td style="text-align: left;">{{ $row->Material }}</td>
                                <td>
                                    @if($row->Color)
                                        <span class="cuadroColor"
                                        style="background-color: {{ $row->Color->colorRgba }}"></span>
                                        {{ $row->Color->color }}
                                    @else
                                        <span class="cuadroColor sinColor" style="color: red;">X</span>
                                    @endif
                                </td> 
                                <td style="text-align: right;"> {{number_format($row->valorU,2) }} {{ $row->valores['simbolo'] }}</td>
                                {{-- <td style="text-align: right;">{{ number_format($row->Importe,0) ?? 0 }}</td> --}}
                                <td style="text-align: right;">{{ number_format($row->valores['importeMXN'] ?? 0,0) }}</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Sin detalles</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            {{-- <div class="cardPrin-footer d-flex justify-content-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
            </div> --}}
        </div>
    </div>
</body>
</html>