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
    </style>

</head>
<body>

<table class="layout">
    <tr>
        <td class="half corte">
            @include('livewire.carritos.pedidoPDFDets')
        </td>
        <td class="half">
            @include('livewire.carritos.pedidoPDFDets')
        </td>
    </tr>
</table>

</body>
</html>
