<!DOCTYPE html>
<html>
<head>
    <title>Pedido</title>
    <link href="{{ public_path('css/cssPdf.css') }}" rel="stylesheet">

    <style>
        table.layout {
            width: 100%;
            border-collapse: collapse;
        }
        td.half {
            width: 50%;
            vertical-align: top;
            padding: 5mm;
        }
        td.corte {
            border-right: 2px dotted #000;
        }
        .page-break {
            page-break-after: always;
        }
    </style>

</head>
<body>
    @include('livewire.carritos.pedidoPDFDets')
    <div class="page-break"></div>
    @include('livewire.carritos.pedidoPDFDets')
</body>
</html>
