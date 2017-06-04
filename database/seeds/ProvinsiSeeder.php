<?php

use Illuminate\Database\Seeder;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_wilayah')->insert([
            
            ['kode_wilayah'=>1,'name'=>'Wilayah 1'],
            ['kode_wilayah'=>2,'name'=>'Wilayah 2'],
            ['kode_wilayah'=>3,'name'=>'Wilayah 3'],
            ['kode_wilayah'=>4,'name'=>'Wilayah 4'],
        ]);
        DB::table('provinsi')->insert([
            ['kode_provinsi' => 11,'provinsi' => 'ACEH','isactived'=>1],
            ['kode_provinsi' => 12,'provinsi' => 'Sumatera Utara','isactived'=>1],
            ['kode_provinsi' => 13,'provinsi' => 'SUMATERA BARAT','isactived'=>1],
            ['kode_provinsi' => 14,'provinsi' => 'RIAU','isactived'=>1],
            ['kode_provinsi' => 15,'provinsi' => 'JAMBI','isactived'=>1],
            ['kode_provinsi' => 16,'provinsi' => 'SUMATERA SELATAN','isactived'=>1],
            ['kode_provinsi' => 17,'provinsi' => 'BENGKULU','isactived'=>0],
            ['kode_provinsi' => 18,'provinsi' => 'LAMPUNG','isactived'=>0],
            ['kode_provinsi' => 19,'provinsi' => 'KEP. BANGKA BELITUNG','isactived'=>0],
            ['kode_provinsi' => 21,'provinsi' => 'KEP. RIAU','isactived'=>1],
            ['kode_provinsi' => 31,'provinsi' => 'DKI JAKARTA','isactived'=>0],
            ['kode_provinsi' => 32,'provinsi' => 'JAWA BARAT','isactived'=>0],
            ['kode_provinsi' => 33,'provinsi' => 'JAWA TENGAH','isactived'=>0],
            ['kode_provinsi' => 36,'provinsi' => 'BANTEN','isactived'=>0],
            ['kode_provinsi' => 35,'provinsi' => 'JAWA TIMUR','isactived'=>0],
            ['kode_provinsi' => 34,'provinsi' => 'YOGYAKARTA','isactived'=>0],
            ['kode_provinsi' => 51,'provinsi' => 'BALI','isactived'=>0],
            ['kode_provinsi' => 52,'provinsi' => 'NUSA TENGGARA BARAT','isactived'=>0],
            ['kode_provinsi' => 53,'provinsi' => 'NUSA TENGGARA TIMUR','isactived'=>1],

            ['kode_provinsi' => 61,'provinsi' => 'KALIMANTAN BARAT','isactived'=>1],
            ['kode_provinsi' => 62,'provinsi' => 'KALIMANTAN TENGAH','isactived'=>1],
            ['kode_provinsi' => 63,'provinsi' => 'KALIMANTAN SELATAN','isactived'=>1],
            ['kode_provinsi' => 64,'provinsi' => 'KALIMANTAN TIMUR','isactived'=>1],
            ['kode_provinsi' => 65,'provinsi' => 'KALIMANTAN UTARA','isactived'=>1],

            ['kode_provinsi' => 71,'provinsi' => 'SULAWESI UTARA','isactived'=>0],
            ['kode_provinsi' => 72,'provinsi' => 'SULAWESI TENGAH','isactived'=>0],
            ['kode_provinsi' => 73,'provinsi' => 'SULAWESI SELATAN','isactived'=>0],
            ['kode_provinsi' => 74,'provinsi' => 'SULAWESI TENGGARA','isactived'=>0],
            ['kode_provinsi' => 75,'provinsi' => 'GORONTALO','isactived'=>0],
            ['kode_provinsi' => 76,'provinsi' => 'SULAWESI BARAT','isactived'=>0],

            ['kode_provinsi' => 81,'provinsi' => 'MALUKU','isactived'=>1],
            ['kode_provinsi' => 82,'provinsi' => 'MALUKU UTARA','isactived'=>1],
            ['kode_provinsi' => 91,'provinsi' => 'PAPUA','isactived'=>1],
            ['kode_provinsi' => 92,'provinsi' => 'PAPUA BARAT','isactived'=>1],


            
        ]);
    }
}
