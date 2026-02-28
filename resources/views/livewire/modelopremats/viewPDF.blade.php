<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Materiales del Modelo</title>
    <link rel="stylesheet" href="{{ public_path('css/presuPDF.css') }}">
</head>

<body>
    <table class="tablaSB">
        <thead>
            <tr>
                <td>
                    @php
                        $marca = optional(optional(optional($modelosPre->Modelo)->Linea)->Marca)->marca ?? 'sin_marca';
                        $rutaArchivo = public_path('storage/modelospre/' . $marca . '/' . $modelosPre->foto);
                        $rutaWeb = asset('storage/modelospre/' . $marca . '/' . $modelosPre->foto);
                    @endphp
                    @if(file_exists($rutaArchivo) && is_file($rutaArchivo) )
                        <img src="{{ $rutaArchivo }}" alt="foto" style="max-width:100%; max-height:120px;">
                    @else
                        <span>Sin foto</span>
                    @endif
                </td>

                <td>
                    <div class="titulo" style="padding: 10px;">
                        Materiales del Modelo {{ $modelosPre->Modelo->modelo }}<br>
                        Linea {{ $modelosPre->Modelo->Linea->linea }}
                        {{ $modelosPre->Modelo->Linea->Marca->marca }}
                    </div>
                    @php
                        $factorRec  = $modelosPre->porRecargo/100 ?? 0;
                        $indirectos = $costoMat *  $factorRec;
                        $subtotal = $costoMat + $indirectos;
                        $iva = $subtotal * .16 ;
                        $total    = $subtotal * 1.16;
                    @endphp
                    <h3>
                        Insumos: {{ App\Models\Util::Dinero($costoMat, 2) }}
                        Indirectos: {{ App\Models\Util::Dinero($indirectos, 2) }}
                        Iva: {{ App\Models\Util::Dinero($iva, 2) }}
                        Total: {{ App\Models\Util::Dinero($total, 2) }}
                    </h2>
                    <h5>
                        Ancho: {{ $modelosPre->ancho }} mm Alto: {{ $modelosPre->alto }} mm
                    </h4>
                </td>
            </tr>
        </thead>
    </table>
    <table class="tablaCB" style="font-size: 10px;">
        <thead>
            <tr>
                <th style="text-align: left; width: 2%;">#</th>
                <th style="text-align: center; width: 5%;">Pos</th>
                <th style="text-align: center; width: 5%;">Clase</th>
                <th style="text-align: left; width: 45%;">Material</th>
                <th style="text-align: left; width: 18%;">Formula</th>
                <th style="text-align: right; width: 7%;">Medidas</th>
                <th style="text-align: left; width: 3%;">Cant</th>
                <th style="text-align: right; width: 10%;">Costo</th>
            </tr>
        </thead>

        <tbody>
            @php
                $claseActual = null;
                $subtotal = 0;
            @endphp
            @foreach ($modelopremats as $row)
                @php
                    $imgPos = match ($row->posicion) {
                        'H' => 'horizontal.png',
                        'V' => 'vertical.png',
                        default => null,
                    };
                    $imgClase = match (strtolower($row->material->clase->id ?? '')) {
                        '1' => 'perfil.png',
                        '2' => 'vidrio.png',
                        '3' => 'herraje.png',
                        '4' => 'accesorios.png',
                        '5' => 'consumibles.png',
                        '6' => 'fijacion.png',
                        '7' => 'otro.png',
                        default => null,
                    };
                    $claseNombre = $row->material->clase->clase ?? 'Sin clase';
                    $nombreTablaHerr = '';
                    if (!empty($row->IdTablaHerraje)) {
                        $nombreTablaHerr = \Illuminate\Support\Facades\DB::table('tablaherrajes')
                            ->where('id', $row->IdTablaHerraje)
                            ->value('tablaHerraje') ?? '';
                    }                    
                @endphp
                @if ($claseActual && $claseActual !== $claseNombre)
                    <tr style="font-weight: bold; background-color: #f8f9fa;">
                        <td colspan="7" style="text-align: right;">{{ $claseActual }}:</td>
                        <td style="text-align: right;">{{ App\Models\Util::Miles($subtotal, 0) }}</td>
                    </tr>
                    @php
                        $subtotal = 0;
                    @endphp
                @endif
                @php
                    $claseActual = $claseNombre;
                    $subtotal += $row->costo;
                @endphp
                <tr>
                    <td style="text-align: left;">{{ $loop->iteration }}</td>
                    <td style="text-align: center;">
                        @if ($imgPos)
                            <img src="{{ public_path('img/clases/' . $imgPos) }}" alt="{{ $row->posicion }}"
                                width="14">
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if ($imgClase)
                            <img src="{{ public_path('img/clases/' . $imgClase) }}"
                                alt="{{ $row->material->clase->clase ?? '' }}" width="14">
                        @endif
                    </td>
                    <td style="text-align: left;">
                        {{ $row->material->material ?? '' }}
                        @if (!empty($row->diferenciador))
                            | {{ $row->diferenciador }}
                        @endif
                        @if (!empty($row->referencia_costo))
                            ({{ $row->referencia_costo }})
                        @endif  
                        @if (!empty($row->IdTablaHerraje))
                            [ {{ $row->cantidadHerraje }}
                            <img src="{{ public_path('img/clases/herraje.png') }}" alt="Herr" width="16"
                                style="margin-left: 4px; vertical-align: middle;">
                            {{ $nombreTablaHerr }} ]
                        @endif                                            
                    </td>
                    <td style="text-align: left;">{{ $row->formula }}</td>
                    <td style="text-align: right; {{ $row->errFormula ? 'color: red;' : '' }}">
                        {{ $row->Dims }}
                    </td>
                    <td style="text-align: center; {{ $row->principal ? 'background-color: LightGreen;' : '' }}">
                        {{ $row->cantidad }}
                    </td>
                    <td style="text-align: right;">
                        {{ App\Models\Util::Miles($row->costo, 0) }}
                    </td>
                </tr>
            @endforeach
            @if ($claseActual)
                <tr style="font-weight: bold; background-color: #f8f9fa;">
                    <td colspan="7" style="text-align: right;">{{ $claseActual }}:</td>
                    <td style="text-align: right;">{{ App\Models\Util::Miles($subtotal, 0) }}</td>
                </tr>
            @endif
        </tbody>
    </table>

    <footer>
        <div class="pagina"></div>
    </footer>
</body>

</html>
