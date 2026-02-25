<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class CostosAluplastSeeder extends Seeder
{
        public function run()
    {
$Corrediza_60Aluplast = [
    ['id'=>41,'IdMaterial'=>22,'referencia'=>'100069|Blanco','IdMoneda'=>2,'IdColor'=>8,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>3.21,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'A','anaquel'=>'1','posicion'=>'1']),'created_at'=>'2025-07-28 20:32:27','updated_at'=>'2025-07-28 22:45:59'],
    ['id'=>42,'IdMaterial'=>22,'referencia'=>'101069127','IdMoneda'=>2,'IdColor'=>13,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>4.67,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'A','anaquel'=>'1','posicion'=>'2']),'created_at'=>'2025-07-28 20:32:27','updated_at'=>'2025-07-28 22:45:39'],
    ['id'=>43,'IdMaterial'=>22,'referencia'=>'101069123','IdMoneda'=>2,'IdColor'=>14,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>4.67,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'A','anaquel'=>'2','posicion'=>'1']),'created_at'=>'2025-07-28 20:32:27','updated_at'=>'2025-07-28 22:46:14'],
    ['id'=>44,'IdMaterial'=>22,'referencia'=>'100069|Bronce','IdMoneda'=>2,'IdColor'=>15,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>4.67,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'A','anaquel'=>'2','posicion'=>'2']),'created_at'=>'2025-07-28 20:32:27','updated_at'=>'2025-07-28 22:57:27'],
    ['id'=>45,'IdMaterial'=>22,'referencia'=>'100069|Turner Oak','IdMoneda'=>2,'IdColor'=>16,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>4.67,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'A','anaquel'=>'3','posicion'=>'1']),'created_at'=>'2025-07-28 20:32:27','updated_at'=>'2025-07-28 22:57:40'],
    ['id'=>46,'IdMaterial'=>24,'referencia'=>'258018','IdMoneda'=>2,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>1.44,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'B','anaquel'=>'1','posicion'=>'1']),'created_at'=>'2025-07-28 22:37:36','updated_at'=>'2025-07-28 22:37:36'],
    ['id'=>52,'IdMaterial'=>25,'referencia'=>'229005','IdMoneda'=>2,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>5.85,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'B','anaquel'=>'2','posicion'=>'1']),'created_at'=>'2025-07-28 23:17:33','updated_at'=>'2025-07-29 05:12:59'],
    ['id'=>53,'IdMaterial'=>26,'referencia'=>'100286|Blanco','IdMoneda'=>2,'IdColor'=>8,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>1.1,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'C','anaquel'=>'1','posicion'=>'1']),'created_at'=>'2025-07-29 05:44:47','updated_at'=>'2025-07-29 05:45:16'],
    ['id'=>54,'IdMaterial'=>26,'referencia'=>'100286|Nussbaum','IdMoneda'=>2,'IdColor'=>13,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>1.6,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'C','anaquel'=>'1','posicion'=>'2']),'created_at'=>'2025-07-29 05:44:47','updated_at'=>'2025-07-29 05:45:30'],
    ['id'=>55,'IdMaterial'=>26,'referencia'=>'100286|Golden Oak','IdMoneda'=>2,'IdColor'=>14,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>1.6,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'C','anaquel'=>'2','posicion'=>'1']),'created_at'=>'2025-07-29 05:44:47','updated_at'=>'2025-07-29 05:45:38'],
    ['id'=>56,'IdMaterial'=>26,'referencia'=>'100286|Bronce','IdMoneda'=>2,'IdColor'=>15,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>1.6,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'C','anaquel'=>'2','posicion'=>'2']),'created_at'=>'2025-07-29 05:44:47','updated_at'=>'2025-07-29 05:45:47'],
    ['id'=>57,'IdMaterial'=>26,'referencia'=>'100286|Turner Oak','IdMoneda'=>2,'IdColor'=>16,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>1.6,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'C','anaquel'=>'3','posicion'=>'1']),'created_at'=>'2025-07-29 05:44:47','updated_at'=>'2025-07-29 05:45:55'],
    ['id'=>58,'IdMaterial'=>27,'referencia'=>'120835','IdMoneda'=>2,'IdColor'=>8,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>1.42,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'D','anaquel'=>'1','posicion'=>'1']),'created_at'=>'2025-07-29 20:23:19','updated_at'=>'2025-07-29 20:24:03'],
    ['id'=>59,'IdMaterial'=>27,'referencia'=>'121835227','IdMoneda'=>2,'IdColor'=>13,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>2.77,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'D','anaquel'=>'1','posicion'=>'2']),'created_at'=>'2025-07-29 20:23:19','updated_at'=>'2025-07-29 20:24:35'],
    ['id'=>60,'IdMaterial'=>27,'referencia'=>'121835223','IdMoneda'=>2,'IdColor'=>14,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>2.77,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'D','anaquel'=>'2','posicion'=>'1']),'created_at'=>'2025-07-29 20:23:19','updated_at'=>'2025-07-29 20:24:54'],
    ['id'=>61,'IdMaterial'=>27,'referencia'=>'120835|Bronce','IdMoneda'=>2,'IdColor'=>15,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>2.77,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'D','anaquel'=>'2','posicion'=>'2']),'created_at'=>'2025-07-29 20:23:19','updated_at'=>'2025-07-29 20:25:14'],
    ['id'=>62,'IdMaterial'=>27,'referencia'=>'120835|Turner Oak','IdMoneda'=>2,'IdColor'=>16,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>2.77,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'D','anaquel'=>'3','posicion'=>'1']),'created_at'=>'2025-07-29 20:23:19','updated_at'=>'2025-07-29 20:25:23'],
    ['id'=>63,'IdMaterial'=>28,'referencia'=>'207175','IdMoneda'=>2,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>10.95,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'E','anaquel'=>'1','posicion'=>'1']),'created_at'=>'2025-07-29 20:53:57','updated_at'=>'2025-07-29 20:53:57'],
    ['id'=>64,'IdMaterial'=>29,'referencia'=>'250072','IdMoneda'=>2,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>1.55,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'E','anaquel'=>'2','posicion'=>'1']),'created_at'=>'2025-07-29 21:07:49','updated_at'=>'2025-07-29 21:07:49'],
    ['id'=>65,'IdMaterial'=>30,'referencia'=>'7260822607','IdMoneda'=>2,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>0.06,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'E','anaquel'=>'3','posicion'=>'1']),'created_at'=>'2025-07-29 21:33:06','updated_at'=>'2025-08-01 05:03:00'],
    ['id'=>66,'IdMaterial'=>31,'referencia'=>'669919','IdMoneda'=>2,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>0.06,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'E','anaquel'=>'4','posicion'=>'1']),'created_at'=>'2025-07-29 21:43:47','updated_at'=>'2025-07-29 21:43:47'],
    ['id'=>67,'IdMaterial'=>32,'referencia'=>'650070','IdMoneda'=>2,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>0.44,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'E','anaquel'=>'5','posicion'=>'1']),'created_at'=>'2025-07-29 22:03:40','updated_at'=>'2025-07-29 22:03:40'],
    ['id'=>68,'IdMaterial'=>33,'referencia'=>'459932','IdMoneda'=>2,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>0.26,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'E','anaquel'=>'6','posicion'=>'1']),'created_at'=>'2025-07-29 22:21:04','updated_at'=>'2025-07-29 22:21:04'],
    ['id'=>73,'IdMaterial'=>23,'referencia'=>'100372','IdMoneda'=>2,'IdColor'=>8,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>3.26,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'F','anaquel'=>'1','posicion'=>'1']),'created_at'=>'2025-07-30 03:14:26','updated_at'=>'2025-07-30 03:15:03'],
    ['id'=>74,'IdMaterial'=>23,'referencia'=>'101372127','IdMoneda'=>2,'IdColor'=>13,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>5.38,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'F','anaquel'=>'1','posicion'=>'2']),'created_at'=>'2025-07-30 03:14:26','updated_at'=>'2025-07-30 03:15:33'],
    ['id'=>75,'IdMaterial'=>23,'referencia'=>'101372123','IdMoneda'=>2,'IdColor'=>14,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>5.38,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'F','anaquel'=>'2','posicion'=>'1']),'created_at'=>'2025-07-30 03:14:26','updated_at'=>'2025-07-30 03:15:54'],
    ['id'=>76,'IdMaterial'=>23,'referencia'=>'100372|Bronce','IdMoneda'=>2,'IdColor'=>15,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>5.38,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'F','anaquel'=>'2','posicion'=>'2']),'created_at'=>'2025-07-30 03:14:26','updated_at'=>'2025-07-30 03:16:05'],
    ['id'=>77,'IdMaterial'=>23,'referencia'=>'100372|Turner Oak','IdMoneda'=>2,'IdColor'=>16,'IdVidrio'=>null,'IdBarra'=>1,'IdPanel'=>null,'costo'=>5.38,'ubicacion'=>json_encode(['zona'=>'PVC','pasillo'=>'F','anaquel'=>'3','posicion'=>'1']),'created_at'=>'2025-07-30 03:14:26','updated_at'=>'2025-07-30 03:16:13'],
];
DB::table('materialscostos')->insert($Corrediza_60Aluplast);

$Herrajes_VariosHerrajes_Aluplast = [
    ['id'=>69,'IdMaterial'=>34,'referencia'=>null,'IdMoneda'=>1,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>23.27,'ubicacion'=>json_encode(['zona'=>'HER','pasillo'=>'B','anaquel'=>'1','posicion'=>'1']),'created_at'=>'2025-07-29 22:26:51','updated_at'=>'2025-07-29 22:29:16'],
    ['id'=>70,'IdMaterial'=>35,'referencia'=>null,'IdMoneda'=>1,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>112.54,'ubicacion'=>json_encode(['zona'=>'HER','pasillo'=>'B','anaquel'=>'1','posicion'=>'2']),'created_at'=>'2025-07-29 22:28:35','updated_at'=>'2025-07-29 22:28:35'],
    ['id'=>71,'IdMaterial'=>36,'referencia'=>null,'IdMoneda'=>1,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>78.23,'ubicacion'=>json_encode(['zona'=>'HER','pasillo'=>'B','anaquel'=>'2','posicion'=>'1']),'created_at'=>'2025-07-29 22:30:33','updated_at'=>'2025-07-29 22:30:33'],
    ['id'=>72,'IdMaterial'=>37,'referencia'=>null,'IdMoneda'=>1,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>47.14,'ubicacion'=>json_encode(['zona'=>'HER','pasillo'=>'B','anaquel'=>'2','posicion'=>'2']),'created_at'=>'2025-07-29 22:31:29','updated_at'=>'2025-07-29 22:31:29'],
    ['id'=>78,'IdMaterial'=>38,'referencia'=>'650947','IdMoneda'=>2,'IdColor'=>null,'IdVidrio'=>null,'IdBarra'=>null,'IdPanel'=>null,'costo'=>2.05,'ubicacion'=>json_encode(['zona'=>'HER','pasillo'=>'B','anaquel'=>'1','posicion'=>'1']),'created_at'=>'2025-07-30 04:00:57','updated_at'=>'2025-07-30 04:00:57'],
];
DB::table('materialscostos')->insert($Herrajes_VariosHerrajes_Aluplast);

    }
}