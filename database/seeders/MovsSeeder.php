<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class MovsSeeder extends Seeder
{
	public function run()
	{

$presupuestos = array(
  array('id' => '1','IdCliente' => '1','IdObra' => '1','IdColorable' => '3','IdColorPerfil' => '28','IdVidrio' => NULL,'IdColorVidrio' => NULL,'fecha' => '2025-06-17','porDescuento' => '0.00','porRecargo' => '0.00','descripcion' => 'Cancelería de Acero Blanco','obs' => 'casa san román','estatus' => 'edicion','adicionales' => NULL,'created_at' => NULL,'updated_at' => '2026-01-29 23:02:20')
);
DB::table('presupuestos')->insert($presupuestos);

$modelospre = array(
  array('id' => '1','consecutivo' => '1','foto' => NULL,'IdPresupuesto' => '1','IdModelo' => '7','IdColorable' => NULL,'IdColorPerfil' => '28','IdVidrio' => NULL,'IdColorVidrio' => NULL,'tipo' => 'otro','descripcion' => 'Cortina de Acero','ubicacion' => 'xd','cantidad' => '1.00','ancho' => '2000.00','alto' => '3000.00','direccion' => NULL,'precioManual' => '0','actualizado' => '1','precioU' => '0','costoU' => '0','porDescuento' => '0.00','porRecargo' => '0.00','costeo' => '{"costoMat":0,"indirectos":0,"costoMOxMC":3000}','divisiones' => NULL,'svg' => NULL,'created_at' => '2026-01-29 23:02:09','updated_at' => '2026-01-29 23:03:02')
);
DB::table('modelospre')->insert($modelospre);

	}
}
