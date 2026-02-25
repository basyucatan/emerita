<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CostosVariosSeeder extends Seeder
{
    public function run()
    {
        $VidrioMillet = [
            ['id'=>27,'IdMaterial'=>7,'IdMoneda'=>1,'IdColor'=>5,'IdVidrio'=>4,'IdBarra'=>null,'IdPanel'=>1,'costo'=>5070,'ubicacion'=>json_encode(['zona'=>'VID','pasillo'=>'A','anaquel'=>'1','posicion'=>'1'])],
            ['id'=>28,'IdMaterial'=>7,'IdMoneda'=>1,'IdColor'=>6,'IdVidrio'=>4,'IdBarra'=>null,'IdPanel'=>1,'costo'=>5070,'ubicacion'=>json_encode(['zona'=>'VID','pasillo'=>'A','anaquel'=>'1','posicion'=>'2'])],
            ['id'=>29,'IdMaterial'=>7,'IdMoneda'=>1,'IdColor'=>7,'IdVidrio'=>4,'IdBarra'=>null,'IdPanel'=>1,'costo'=>5370,'ubicacion'=>json_encode(['zona'=>'VID','pasillo'=>'A','anaquel'=>'2','posicion'=>'1'])],
            ['id'=>30,'IdMaterial'=>7,'IdMoneda'=>1,'IdColor'=>6,'IdVidrio'=>6,'IdBarra'=>null,'IdPanel'=>1,'costo'=>7500,'ubicacion'=>json_encode(['zona'=>'VID','pasillo'=>'A','anaquel'=>'2','posicion'=>'2'])],
        ];
        DB::table('materialscostos')->insert($VidrioMillet);

        $Herrajes_y_accesorios = [
            ['id'=>31,'IdMaterial'=>8,'IdMoneda'=>1,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>85,'ubicacion'=>json_encode(['zona'=>'HER','pasillo'=>'A','anaquel'=>'1','posicion'=>'1'])],
            ['id'=>32,'IdMaterial'=>9,'IdMoneda'=>1,'IdColor'=>11,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>125,'ubicacion'=>json_encode(['zona'=>'HER','pasillo'=>'A','anaquel'=>'1','posicion'=>'2'])],
            ['id'=>33,'IdMaterial'=>10,'IdMoneda'=>1,'IdColor'=>9,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>9.3,'ubicacion'=>json_encode(['zona'=>'HER','pasillo'=>'A','anaquel'=>'2','posicion'=>'1'])],
            ['id'=>34,'IdMaterial'=>11,'IdMoneda'=>1,'IdColor'=>9,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>13.5,'ubicacion'=>json_encode(['zona'=>'HER','pasillo'=>'A','anaquel'=>'2','posicion'=>'2'])],
            ['id'=>35,'IdMaterial'=>12,'IdMoneda'=>1,'IdColor'=>8,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>75,'ubicacion'=>json_encode(['zona'=>'HER','pasillo'=>'A','anaquel'=>'3','posicion'=>'1'])],
            ['id'=>36,'IdMaterial'=>12,'IdMoneda'=>1,'IdColor'=>9,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>75,'ubicacion'=>json_encode(['zona'=>'HER','pasillo'=>'A','anaquel'=>'3','posicion'=>'2'])],
        ];
        DB::table('materialscostos')->insert($Herrajes_y_accesorios);

        $Herrajes_y_accesoriosDMT = [
            ['id'=>37,'IdMaterial'=>13,'IdMoneda'=>1,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>1.25,'ubicacion'=>json_encode(['zona'=>'HER','pasillo'=>'C','anaquel'=>'1','posicion'=>'1'])],
            ['id'=>38,'IdMaterial'=>14,'IdMoneda'=>1,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>1.1,'ubicacion'=>json_encode(['zona'=>'HER','pasillo'=>'C','anaquel'=>'1','posicion'=>'2'])],
            ['id'=>39,'IdMaterial'=>15,'IdMoneda'=>1,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>1.3,'ubicacion'=>json_encode(['zona'=>'HER','pasillo'=>'C','anaquel'=>'2','posicion'=>'1'])],
            ['id'=>40,'IdMaterial'=>16,'IdMoneda'=>1,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>1.2,'ubicacion'=>json_encode(['zona'=>'HER','pasillo'=>'C','anaquel'=>'2','posicion'=>'2'])],
        ];
        DB::table('materialscostos')->insert($Herrajes_y_accesoriosDMT);
    }
}
