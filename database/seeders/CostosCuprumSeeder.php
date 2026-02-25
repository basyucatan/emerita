<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CostosCuprumSeeder extends Seeder
{
    public function run()
    {
$Corrediza_3_Cuprum = [
    ['id'=>1,'IdMaterial'=>1,'IdMoneda'=>1,'IdColor'=>1,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>754,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'A','anaquel'=>'1','posicion'=>'1']),'created_at'=>null,'updated_at'=>null],
    ['id'=>2,'IdMaterial'=>1,'IdMoneda'=>1,'IdColor'=>2,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>754,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'A','anaquel'=>'1','posicion'=>'2']),'created_at'=>null,'updated_at'=>null],
    ['id'=>3,'IdMaterial'=>1,'IdMoneda'=>1,'IdColor'=>3,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>790,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'A','anaquel'=>'2','posicion'=>'1']),'created_at'=>null,'updated_at'=>null],
    ['id'=>4,'IdMaterial'=>1,'IdMoneda'=>1,'IdColor'=>4,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>754,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'A','anaquel'=>'2','posicion'=>'2']),'created_at'=>null,'updated_at'=>null],
    ['id'=>5,'IdMaterial'=>2,'IdMoneda'=>1,'IdColor'=>1,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>509.24,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'B','anaquel'=>'1','posicion'=>'1']),'created_at'=>null,'updated_at'=>null],
    ['id'=>6,'IdMaterial'=>2,'IdMoneda'=>1,'IdColor'=>2,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>509.24,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'B','anaquel'=>'1','posicion'=>'2']),'created_at'=>null,'updated_at'=>null],
    ['id'=>7,'IdMaterial'=>2,'IdMoneda'=>1,'IdColor'=>3,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>530.55,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'B','anaquel'=>'2','posicion'=>'1']),'created_at'=>null,'updated_at'=>null],
    ['id'=>8,'IdMaterial'=>2,'IdMoneda'=>1,'IdColor'=>4,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>509.24,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'B','anaquel'=>'2','posicion'=>'2']),'created_at'=>null,'updated_at'=>null],
    ['id'=>9,'IdMaterial'=>3,'IdMoneda'=>1,'IdColor'=>1,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>452.4,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'C','anaquel'=>'1','posicion'=>'1']),'created_at'=>null,'updated_at'=>null],
    ['id'=>10,'IdMaterial'=>3,'IdMoneda'=>1,'IdColor'=>2,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>452.4,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'C','anaquel'=>'1','posicion'=>'2']),'created_at'=>null,'updated_at'=>null],
    ['id'=>11,'IdMaterial'=>3,'IdMoneda'=>1,'IdColor'=>3,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>482.2,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'C','anaquel'=>'2','posicion'=>'1']),'created_at'=>null,'updated_at'=>null],
    ['id'=>12,'IdMaterial'=>3,'IdMoneda'=>1,'IdColor'=>4,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>452.4,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'C','anaquel'=>'2','posicion'=>'2']),'created_at'=>null,'updated_at'=>null],
    ['id'=>13,'IdMaterial'=>4,'IdMoneda'=>1,'IdColor'=>1,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>578.84,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'D','anaquel'=>'1','posicion'=>'1']),'created_at'=>null,'updated_at'=>null],
    ['id'=>14,'IdMaterial'=>4,'IdMoneda'=>1,'IdColor'=>2,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>578.84,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'D','anaquel'=>'1','posicion'=>'2']),'created_at'=>null,'updated_at'=>null],
    ['id'=>15,'IdMaterial'=>4,'IdMoneda'=>1,'IdColor'=>3,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>605.32,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'D','anaquel'=>'2','posicion'=>'1']),'created_at'=>null,'updated_at'=>null],
    ['id'=>16,'IdMaterial'=>4,'IdMoneda'=>1,'IdColor'=>4,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>578.84,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'D','anaquel'=>'2','posicion'=>'2']),'created_at'=>null,'updated_at'=>null],
    ['id'=>17,'IdMaterial'=>5,'IdMoneda'=>1,'IdColor'=>1,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>675,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'E','anaquel'=>'1','posicion'=>'1']),'created_at'=>null,'updated_at'=>null],
    ['id'=>18,'IdMaterial'=>5,'IdMoneda'=>1,'IdColor'=>2,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>675,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'E','anaquel'=>'1','posicion'=>'2']),'created_at'=>null,'updated_at'=>null],
    ['id'=>19,'IdMaterial'=>5,'IdMoneda'=>1,'IdColor'=>3,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>742.5,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'E','anaquel'=>'2','posicion'=>'1']),'created_at'=>null,'updated_at'=>null],
    ['id'=>20,'IdMaterial'=>5,'IdMoneda'=>1,'IdColor'=>4,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>675,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'E','anaquel'=>'2','posicion'=>'2']),'created_at'=>null,'updated_at'=>null],
    ['id'=>21,'IdMaterial'=>6,'IdMoneda'=>1,'IdColor'=>1,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>526.1,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'F','anaquel'=>'1','posicion'=>'1']),'created_at'=>null,'updated_at'=>null],
    ['id'=>22,'IdMaterial'=>6,'IdMoneda'=>1,'IdColor'=>2,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>526.1,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'F','anaquel'=>'1','posicion'=>'2']),'created_at'=>null,'updated_at'=>null],
    ['id'=>23,'IdMaterial'=>6,'IdMoneda'=>1,'IdColor'=>3,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>526.1,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'F','anaquel'=>'2','posicion'=>'1']),'created_at'=>null,'updated_at'=>null],
    ['id'=>24,'IdMaterial'=>6,'IdMoneda'=>1,'IdColor'=>4,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>526.1,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'F','anaquel'=>'2','posicion'=>'2']),'created_at'=>null,'updated_at'=>null],
    ['id'=>25,'IdMaterial'=>19,'IdMoneda'=>1,'IdColor'=>1,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>182,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'G','anaquel'=>'1','posicion'=>'1']),'created_at'=>null,'updated_at'=>null],
    ['id'=>26,'IdMaterial'=>21,'IdMoneda'=>1,'IdColor'=>1,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>89,'ubicacion'=>json_encode(['zona'=>'ALU','pasillo'=>'H','anaquel'=>'1','posicion'=>'1']),'created_at'=>null,'updated_at'=>'2025-07-23 18:45:04'],
];
DB::table('materialscostos')->insert($Corrediza_3_Cuprum);

    }
}
