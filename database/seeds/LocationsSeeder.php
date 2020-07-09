<?php

use Illuminate\Database\Seeder;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Province;
use App\City;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listProvince = RajaOngkir::provinsi()->all();
            foreach($listProvince as $provinceRow) {
                Province::create([
                    'province_id' => $provinceRow['province_id'],
                    'name' => $provinceRow['province'],
                ]);
                
                $listCity = RajaOngkir::kota()->dariProvinsi($provinceRow['province_id'])->get();
                foreach ($listCity as $cityRow) {
                    City::create([
                        'province_id' => $provinceRow['province_id'],
                        'city_id' => $cityRow['city_id'],
                        'name' => $cityRow['city_name'],
                    ]);
                }
            }
    }
}
