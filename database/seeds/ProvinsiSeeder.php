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
            ['kode_provinsi' => 11,'provinsi' => 'ACEH'],
            ['kode_provinsi' => 12,'provinsi' => 'Sumatera Utara'],
            ['kode_provinsi' => 13,'provinsi' => 'SUMATERA BARAT'],
            ['kode_provinsi' => 14,'provinsi' => 'RIAU'],
            ['kode_provinsi' => 15,'provinsi' => 'JAMBI'],
            ['kode_provinsi' => 16,'provinsi' => 'SUMATERA SELATAN'],
            ['kode_provinsi' => 17,'provinsi' => 'BENGKULU'],
            ['kode_provinsi' => 18,'provinsi' => 'LAMPUNG'],
            ['kode_provinsi' => 19,'provinsi' => 'KEP. BANGKA BELITUNG'],
            ['kode_provinsi' => 21,'provinsi' => 'KEP. RIAU'],
            ['kode_provinsi' => 31,'provinsi' => 'DKI JAKARTA'],
            ['kode_provinsi' => 32,'provinsi' => 'JAWA BARAT'],
            ['kode_provinsi' => 33,'provinsi' => 'JAWA TENGAH'],
            ['kode_provinsi' => 36,'provinsi' => 'BANTEN'],
            ['kode_provinsi' => 35,'provinsi' => 'JAWA TIMUR'],
            ['kode_provinsi' => 34,'provinsi' => 'YOGYAKARTA'],
            ['kode_provinsi' => 51,'provinsi' => 'BALI'],
            ['kode_provinsi' => 52,'provinsi' => 'NUSA TENGGARA BARAT'],
            ['kode_provinsi' => 53,'provinsi' => 'NUSA TENGGARA TIMUR'],

            ['kode_provinsi' => 61,'provinsi' => 'KALIMANTAN BARAT'],
            ['kode_provinsi' => 62,'provinsi' => 'KALIMANTAN TENGAH'],
            ['kode_provinsi' => 63,'provinsi' => 'KALIMANTAN SELATAN'],
            ['kode_provinsi' => 64,'provinsi' => 'KALIMANTAN TIMUR'],
            ['kode_provinsi' => 65,'provinsi' => 'KALIMANTAN UTARA'],

            ['kode_provinsi' => 71,'provinsi' => 'SULAWESI UTARA'],
            ['kode_provinsi' => 72,'provinsi' => 'SULAWESI TENGAH'],
            ['kode_provinsi' => 73,'provinsi' => 'SULAWESI SELATAN'],
            ['kode_provinsi' => 74,'provinsi' => 'SULAWESI TENGGARA'],
            ['kode_provinsi' => 75,'provinsi' => 'GORONTALO'],
            ['kode_provinsi' => 76,'provinsi' => 'SULAWESI BARAT'],

            ['kode_provinsi' => 81,'provinsi' => 'MALUKU'],
            ['kode_provinsi' => 82,'provinsi' => 'MALUKU UTARA'],
            ['kode_provinsi' => 91,'provinsi' => 'PAPUA'],
            ['kode_provinsi' => 92,'provinsi' => 'PAPUA BARAT'],


            
        ]);
    }
}
