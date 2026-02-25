<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Producto;
use App\Models\productosmeta;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CatsSeeder extends Seeder
{
    public function run()
    {
$negocios = array(
  array('id' => '1','negocio' => 'PRACTISUR S.A. DE C.V.','rfc' => 'R.F.C. PRA-1703132A4',
'direccion' => 'CALLE 37 No. 280 x 16 y 16-A C.P. 97147',
'ciudad' => 'MÉRIDA, YUCATÁN ','telefono' => '999-986-7777 / 78',
'logo' => 'logoNegocio.png','cuenta' => 'Banco: Inbursa
Cuenta: 500 437 343 71 
CLABE: 0369 1050 0437 3437 16 
Sucursal: Mérida Altabrisa','email' => 'practisur2018@gmail.com',

'margenUtilidad' => '30',
'toleranciaClaro' => '0',
'toleranciaAluminio' => '100',
'toleranciaPVC' => '50',
'sobrecostoVidrio' => '10',
'mermaCorte' => 4,
'costoMOmc' => '500',
'costoMOmat' => '30')
);
DB::table('negocios')->insert($negocios);

$unidads = array(
  array('id' => '1','tipo' => 'pieza','unidad' => 'pieza','abreviatura' => 'pz','prueba' => '1.50 pz (18m, 1 tubo/11m)','factorConversion' => '1'),
  array('id' => '2','tipo' => 'longitud','unidad' => 'milímetro','abreviatura' => 'mm','prueba' => '1,550.00 mm (1.55)','factorConversion' => '1000'),
  array('id' => '3','tipo' => 'longitud','unidad' => 'metro','abreviatura' => 'm','prueba' => '1.55 m (1.55)','factorConversion' => '1'),
  array('id' => '4','tipo' => 'longitud','unidad' => 'centímetro','abreviatura' => 'cm','prueba' => '155.00 cm (1.55)','factorConversion' => '100'),
  array('id' => '5','tipo' => 'longitud','unidad' => 'pie','abreviatura' => 'ft','prueba' => '5.09 ft (1.55)','factorConversion' => '3.281'),
  array('id' => '6','tipo' => 'longitud','unidad' => 'pulgada','abreviatura' => 'in','prueba' => '61.02 in (1.55)','factorConversion' => '39.37'),
  array('id' => '7','tipo' => 'area','unidad' => 'milímetros cuadrados','abreviatura' => 'mm²','prueba' => '1,550,000.00 mm² (1.55)','factorConversion' => '1000000'),
  array('id' => '8','tipo' => 'area','unidad' => 'metro cuadrado','abreviatura' => 'm²','prueba' => '1.55 m² (1.55)','factorConversion' => '1')
);
DB::table('unidads')->insert($unidads);

$monedas = array(
  array('id' => '1','moneda' => 'Peso Mexicano','centavos' => 'centavos','simbolo' => '$','abreviatura' => 'MXN','tipoCambio' => '1'),
  array('id' => '2','moneda' => 'Euro','centavos' => 'centavos','simbolo' => '€','abreviatura' => 'EUR','tipoCambio' => '22'),
  array('id' => '3','moneda' => 'Dólar Americano','centavos' => 'cents','simbolo' => '$','abreviatura' => 'USD','tipoCambio' => '19')
);
DB::table('monedas')->insert($monedas);

$aperturas = array(
  array('id' => '1','apertura' => 'Fijo','d' => 'M-3-5-3 5-1 5-1 1 2 1 2-1-1-1-1-3 3-3 3-5-3-5Z','emoji' => '🔳'),
  array('id' => '2','apertura' => 'corredizoDer','d' => 'M-5-2-5 2 2 2 2 5 9 0 2-5 2-2-5-2','emoji' => '➡️'),
  array('id' => '3','apertura' => 'corredizoIzq','d' => 'M6 2 6-2-1-2-1-5-8 0-1 5-1 2 6 2','emoji' => '⬅️'),
  array('id' => '4','apertura' => 'Practicable Interior','d' => 'M-5 5Q-2.5 5.5-2 3-2-1-7-8L6-8Q8 3 1 7-2 9-5 8L-5 10-10 6-5 3-5 5','emoji' => '↪️'),
  array('id' => '5','apertura' => 'Practicable Exterior','d' => 'M-5-3Q-2.5-3.5-2-1-2 3-7 10L6 10Q8-1 1-5-2-7-5-6L-5-8-10-4-5-1-5-3','emoji' => '↩️'),
  array('id' => '6','apertura' => 'OsciloBatiente','d' => 'M0 0 20 20M0 0 20-20M20-20 0 13M0 13-20-20','emoji' => '🔄'),
  array('id' => '7','apertura' => 'Proyectante','d' => 'M20-24 0 0M0 0-20-24','emoji' => '🔼'),
  array('id' => '8','apertura' => 'Abatible','d' => 'M-20 9 0-15M0-15 20 9','emoji' => '🔽'),
  array('id' => '9','apertura' => 'Basculante','d' => 'M-20 0 0-24 20 0 0 24Z','emoji' => '🔷'),
  array('id' => '10','apertura' => 'corrdizoDoble','d' => 'M-12,0 L-5,-5 L-5,-2 L2,-2 L2,-5 L9,0 L2,5 L2,2 L-5,2 L-5,5 L-12,0','emoji' => '↔️'),
  array('id' => '11','apertura' => 'Sin Apertura','d' => 'M 10 10','emoji' => '⛔'),
  array('id' => '12','apertura' => 'CorredizoAbajo','d' => 'M 2 -5 L -2 -5 L -2 2 L -5 2 L 0 9 L 5 2 L 2 2 L 2 -5','emoji' => '⬇️'),
  array('id' => '13','apertura' => 'CorredizoArriba','d' => 'M -2 5 L 2 5 L 2 -2 L 5 -2 L -0 -9 L -5 -2 L -2 -2 L -2 5','emoji' => '⬆️')
);
DB::table('aperturas')->insert($aperturas);

$empresas = array(
  array('id' => '1', 'tipo' => 'cliente', 'nombre' => 'CLIENTE GENERAL', 'direccion' => 'Calle 100 #123, Centro', 'ubicacion' => 'Mérida, Yucatán', 'telefono' => '9991234567')
);
DB::table('empresas')->insert($empresas);  
$obras = array(
  array('id' => '1','IdEmpresa' => '1','obra' => 'Obra Global','direccion' => '','ubicacion' => '')
);
DB::table('obras')->insert($obras); 
$colorables = array(
  array('id' => '1','colorable' => 'Aluminio','tipo' => 'Perfil'),
  array('id' => '2','colorable' => 'PVC','tipo' => 'Perfil'),
  array('id' => '3','colorable' => 'Acero','tipo' => 'Perfil'),
  array('id' => '4','colorable' => 'Vidrio','tipo' => 'Vidrio'),
  array('id' => '5','colorable' => 'Herraje','tipo' => 'Herraje')
);
DB::table('colorables')->insert($colorables);

$colors = [
    ['id' => '5', 'IdColorable' => '4', 'IdColorHerraje' => null, 'color' => 'Transparente', 'colorHex' => '#ffffff', 'colorRgba' => 'rgba(255, 255, 255, 0)'],
    ['id' => '6', 'IdColorable' => '4', 'IdColorHerraje' => null, 'color' => 'Tintex', 'colorHex' => '#196c34', 'colorRgba' => 'rgba(25, 108, 52, 0.2)'],
    ['id' => '7', 'IdColorable' => '4', 'IdColorHerraje' => null, 'color' => 'Filtrasol', 'colorHex' => '#524128', 'colorRgba' => 'rgba(82, 65, 40, 0.3)'],
    ['id' => '9', 'IdColorable' => '3', 'IdColorHerraje' => null, 'color' => 'Negro', 'colorHex' => '#000000', 'colorRgba' => 'rgba(0, 0, 0, 1)'],
    ['id' => '10', 'IdColorable' => '5', 'IdColorHerraje' => null, 'color' => 'Blanco', 'colorHex' => '#ffffff', 'colorRgba' => 'rgba(255, 255, 255, 1)'],
    ['id' => '11', 'IdColorable' => '5', 'IdColorHerraje' => null, 'color' => 'Negro', 'colorHex' => '#000000', 'colorRgba' => 'rgba(0, 0, 0, 1)'],
    ['id' => '12', 'IdColorable' => '5', 'IdColorHerraje' => null, 'color' => 'café', 'colorHex' => '#6e3e07', 'colorRgba' => 'rgba(110, 62, 7, 1)'],
    ['id' => '1', 'IdColorable' => '1', 'IdColorHerraje' => '10', 'color' => 'Blanco', 'colorHex' => '#ffffff', 'colorRgba' => 'rgba(255, 255, 255, 1)'],
    ['id' => '2', 'IdColorable' => '1', 'IdColorHerraje' => '11', 'color' => 'Aluminio natural', 'colorHex' => '#cbcdd7', 'colorRgba' => 'rgba(203, 205, 215, 1)'],
    ['id' => '3', 'IdColorable' => '1', 'IdColorHerraje' => '11', 'color' => 'Champagne', 'colorHex' => '#ece9a2', 'colorRgba' => 'rgba(236, 233, 162, 1)'],
    ['id' => '4', 'IdColorable' => '1', 'IdColorHerraje' => '11', 'color' => 'Bronce', 'colorHex' => '#46360c', 'colorRgba' => 'rgba(70, 54, 12, 1)'],
    ['id' => '8', 'IdColorable' => '2', 'IdColorHerraje' => '10', 'color' => 'Blanco', 'colorHex' => '#ffffff', 'colorRgba' => 'rgba(255, 255, 255, 1)'],
    ['id' => '13', 'IdColorable' => '2', 'IdColorHerraje' => '11', 'color' => 'Nussbaum', 'colorHex' => '#4e2b04', 'colorRgba' => 'rgba(78, 43, 4, 1)'],
    ['id' => '14', 'IdColorable' => '2', 'IdColorHerraje' => '12', 'color' => 'Golden Oak', 'colorHex' => '#b07003', 'colorRgba' => 'rgba(176, 112, 3, 1)'],
    ['id' => '15', 'IdColorable' => '2', 'IdColorHerraje' => '11', 'color' => 'Bronce', 'colorHex' => '#342a0f', 'colorRgba' => 'rgba(52, 42, 15, 1)'],
    ['id' => '16', 'IdColorable' => '2', 'IdColorHerraje' => '12', 'color' => 'Woodec Turner Oak Malt', 'colorHex' => '#d8bf46', 'colorRgba' => 'rgba(216, 191, 70, 1)'],
    ['id' => '17', 'IdColorable' => '2', 'IdColorHerraje' => '10', 'color' => 'Silver', 'colorHex' => '#d5dcda', 'colorRgba' => 'rgba(213, 220, 218, 1)'],
    ['id' => '18', 'IdColorable' => '2', 'IdColorHerraje' => '11', 'color' => 'Mahagoni', 'colorHex' => '#af5f1d', 'colorRgba' => 'rgba(175, 95, 29, 1)'],
    ['id' => '19', 'IdColorable' => '2', 'IdColorHerraje' => '11', 'color' => 'Nusbaun', 'colorHex' => '#8e5310', 'colorRgba' => 'rgba(142, 83, 16, 1)'],
    ['id' => '20', 'IdColorable' => '2', 'IdColorHerraje' => '12', 'color' => 'Brown Dekor', 'colorHex' => '#2b1503', 'colorRgba' => 'rgba(43, 21, 3, 1)'],
    ['id' => '21', 'IdColorable' => '2', 'IdColorHerraje' => '11', 'color' => 'Woodec Sheffield Oak Alpine', 'colorHex' => '#eabc57', 'colorRgba' => 'rgba(234, 188, 87, 1)'],
    ['id' => '23', 'IdColorable' => '2', 'IdColorHerraje' => '11', 'color' => 'Woodec Sheffield Oak Concrete', 'colorHex' => '#a69164', 'colorRgba' => 'rgba(166, 145, 100, 1)'],
    ['id' => '24', 'IdColorable' => '2', 'IdColorHerraje' => '11', 'color' => 'Jet Black Matt', 'colorHex' => '#1b1d1d', 'colorRgba' => 'rgba(27, 29, 29, 1)'],
    ['id' => '25', 'IdColorable' => '2', 'IdColorHerraje' => '11', 'color' => 'Gris Antracita', 'colorHex' => '#464444', 'colorRgba' => 'rgba(70, 68, 68, 1)'],
    ['id' => '26', 'IdColorable' => '2', 'IdColorHerraje' => '11', 'color' => 'Dark Chocolatte Ceylon', 'colorHex' => '#241c05', 'colorRgba' => 'rgba(36, 28, 5, 1)'],
    ['id' => '27', 'IdColorable' => '2', 'IdColorHerraje' => '12', 'color' => 'Sheffield', 'colorHex' => '#e6cb6b', 'colorRgba' => 'rgba(230, 203, 107, 1)'],
    ['id' => '28', 'IdColorable' => '3', 'IdColorHerraje' => '10', 'color' => 'Blanco', 'colorHex' => '#ffffff', 'colorRgba' => 'rgba(255, 255, 255, 1)']
];
DB::table('colors')->insert($colors);

$vidrios = array(
  array('id' => '1','vidrio' => 'Vidrio flotado','grosor' => '3.00'),
  array('id' => '2','vidrio' => 'Vidrio flotado','grosor' => '4.00'),
  array('id' => '3','vidrio' => 'Vidrio flotado','grosor' => '5.00'),
  array('id' => '4','vidrio' => 'Vidrio flotado','grosor' => '6.00'),
  array('id' => '5','vidrio' => 'Vidrio flotado','grosor' => '9.00'),
  array('id' => '6','vidrio' => 'Vidrio flotado','grosor' => '12.00')
);
DB::table('vidrios')->insert($vidrios);

$barras = array(
  array('id' => '1','longitud' => '6100.00','descripcion' => 'Barra 6m'),
  array('id' => '2','longitud' => '4400.00','descripcion' => 'Barra 4.4m'),
  array('id' => '3','longitud' => '5850.00','descripcion' => 'Barra 5.85m'),
  array('id' => '4','longitud' => '6050.00','descripcion' => 'Barra 6.05m'),
  array('id' => '5','longitud' => '6500.00','descripcion' => 'Barra 6.5m')
);
DB::table('barras')->insert($barras);

$panels = array(
    array('id' => 1, 'panel' => 'Panel 3x2.60m', 'ancho' => 3.00, 'alto' => 2.60),
    array('id' => 2, 'panel' => 'Panel de 3.60x2.60m', 'ancho' => 3.60, 'alto' => 2.60),
    array('id' => 3, 'panel' => 'Panel de 2.60x1.80m', 'ancho' => 2.60, 'alto' => 1.80),
    array('id' => 4, 'panel' => 'Panel de 2.60x1.50m', 'ancho' => 2.60, 'alto' => 1.50),
    array('id' => 5, 'panel' => 'Panel de 2.60x1.20m', 'ancho' => 2.60, 'alto' => 1.20),
);
DB::table('panels')->insert($panels);

$divisions = array(
  array('id' => '1','division' => 'Ventanas'),
  array('id' => '2','division' => 'Cortinas'),
  array('id' => '3','division' => 'Herrería')
);
DB::table('divisions')->insert($divisions);

$marcas = array(
  array('id' => '1','marca' => 'Cuprum','IdColorable' => '1','foto' => 'cuprum.jpg'),
  array('id' => '2','marca' => 'Aluplast','IdColorable' => '2','foto' => 'aluplast.jpg'),
  array('id' => '3','marca' => 'Millet','IdColorable' => '4','foto' => 'millet.jpg'),
  array('id' => '4','marca' => 'Robin - Fernandez','IdColorable' => '5','foto' => 'robinFernandez.jpg'),
  array('id' => '5','marca' => 'DMT','IdColorable' => NULL,'foto' => 'dmt.jpg'),
  array('id' => '6','marca' => 'Herrajes Aluplast','IdColorable' => NULL,'foto' => 'roto.jpg'),
  array('id' => '7','marca' => 'Emerita','IdColorable' => NULL,'foto' => NULL)
);
DB::table('marcas')->insert($marcas);   

$clases = array(
  array('id' => '1','clase' => 'Perfiles','orden' => '10'),
  array('id' => '2','clase' => 'Paneles','orden' => '20'),
  array('id' => '3','clase' => 'Herrajes','orden' => '30'),
  array('id' => '4','clase' => 'Accesorios','orden' => '40'),
  array('id' => '5','clase' => 'Consumibles','orden' => '50'),
  array('id' => '6','clase' => 'Fijación','orden' => '60'),
  array('id' => '7','clase' => 'Otros','orden' => '70')
);
DB::table('clases')->insert($clases);

$tipos = array(
  array('id' => '1','tipo' => 'Marco','orden' => '10'),
  array('id' => '2','tipo' => 'Hoja','orden' => '20'),
  array('id' => '3','tipo' => 'Junquillo','orden' => '30'),
  array('id' => '4','tipo' => 'Refuerzo','orden' => '40')
);
DB::table('tipos')->insert($tipos);

$laminas = array(
    array('id' => 1, 'lamina' => 'EUROPEA 22', 'codigo' => 'E22', 'codigoCinta' => 'M2165', 'pesoML' => 0.96, 'calibre' => '22', 'dUtil' => 0.09),
    array('id' => 2, 'lamina' => 'EUROPEA 22 L', 'codigo' => 'E22L', 'codigoCinta' => 'M854', 'pesoML' => 0.86, 'calibre' => '22', 'dUtil' => 0.09),
    array('id' => 3, 'lamina' => 'EUROPEA 24 LIGERA', 'codigo' => 'E24L', 'codigoCinta' => '', 'pesoML' => 0.686, 'calibre' => '24', 'dUtil' => 0.09),
    array('id' => 4, 'lamina' => 'EUROPEA 24', 'codigo' => 'E24', 'codigoCinta' => 'M2157', 'pesoML' => 0.744, 'calibre' => '24', 'dUtil' => 0.09),
    array('id' => 5, 'lamina' => 'EUROPEA', 'codigo' => 'E25', 'codigoCinta' => 'GZ3555', 'pesoML' => 0.6, 'calibre' => '25', 'dUtil' => 0.09),
    array('id' => 6, 'lamina' => 'EUROPEA', 'codigo' => 'E26', 'codigoCinta' => 'Y858', 'pesoML' => 0.55, 'calibre' => '26', 'dUtil' => 0.09),
    array('id' => 7, 'lamina' => 'EUROPEA MULTIPERFORADA', 'codigo' => 'E24M', 'codigoCinta' => '', 'pesoML' => 0.744, 'calibre' => '24', 'dUtil' => 0.07),
    array('id' => 8, 'lamina' => 'TABLETA MULTIPERFORADA 22', 'codigo' => 'T22M', 'codigoCinta' => 'M2166', 'pesoML' => 0.84, 'calibre' => '22', 'dUtil' => 0.07),
    array('id' => 9, 'lamina' => 'TABLETA 24', 'codigo' => 'T24', 'codigoCinta' => '', 'pesoML' => 0.684, 'calibre' => '24', 'dUtil' => 0.07),
    array('id' => 10, 'lamina' => 'TABLETA 22', 'codigo' => 'T22', 'codigoCinta' => 'GZ3555', 'pesoML' => 0.82, 'calibre' => '22', 'dUtil' => 0.07),
    array('id' => 11, 'lamina' => 'SECCION TUBULAR IMPULSO KIT', 'codigo' => 'TUB', 'codigoCinta' => '', 'pesoML' => 0, 'calibre' => '18', 'dUtil' => 0.085)
);
DB::table('laminas')->insert($laminas);

$guias = array(
    array('id' => 1, 'guia' => 'CARRILERA TIPO EUROPEA C-16 5CM', 'idMaterial' => null),
    array('id' => 2, 'guia' => 'CARRILERA TIPO PLANA C-16 3.05CM', 'idMaterial' => null),
    array('id' => 3, 'guia' => 'CARRILERA TIPO MECANISMO C-16 7CM 6', 'idMaterial' => null),
    array('id' => 4, 'guia' => 'CARRILERA TIPO EUROPEA C-14 10 CM', 'idMaterial' => null),
    array('id' => 5, 'guia' => 'CARRILERA TIPO PLANA C-14 10 CM', 'idMaterial' => null)
);
DB::table('guias')->insert($guias);
    }
}
