<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;
use Turahe\Master\Models\State;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return void
     */
    public function run()
    {
//        $this->call(\Turahe\Master\Seeds\CountriesTableSeeder::class);
//        $idCountry = Country::where('name', 'Indonesia')->first();
//
//        $ro = new RajaOngkir();
//
//        foreach ($ro->getProvince() as $province) {
//            Province::create([
//                'country_id' => $idCountry->id,
//                'name' => $province->province,
//            ]);
//        }
//        foreach ($ro->getCity() as $city) {
//            City::create([
//                'state_id' => $city->province_id,
//                'type' => $city->type === 'Kabupaten' ? 'subdistrict' : 'city',
//                'name' => $city->city_name,
//            ]);
//        }


        $file = __DIR__.'./csv/provinces.csv';
        $header = ['id', 'name', 'lat', 'long'];
        $data = csv_to_array($file, $header);
        $provinces = array_map(function ($arr) {
            return [
                 'name' => $arr['name'],
                 'latitude' => $arr['lat'],
                 'longitude' => $arr['long'],
             ];
        }, $data);

        foreach ($provinces as $province) {
            $state = State::where('name', 'like', '%'.$province['name'].'%')->first();
            if ($state) {
                $state->update([
                    'latitude' => $province['latitude'],
                    'longitude' => $province['longitude'],
                ]);
            }
        }

//        $file_cities = __DIR__.'./csv/cities.csv';
//        $header = ['id', 'province_id', 'name', 'lat', 'long'];
//        $data_cities = $Csv->csv_to_array($file_cities, $header);
//        $cities = array_map(function ($arr) {
//            $names = explode(' ', trim($arr['name']));
//            $a = array_slice($names, 1);
//            $name = implode(' ', $a);
//
//            $type = strtok($arr['name'], ' ') === 'KABUPATEN' ? 'subdistrict' : 'city';
//
//            return [
//                'state_id' => $arr['province_id'],
//                'name' => $name,
//                'type' => $type,
//                'latitude' => $arr['lat'],
//                'longitude' => $arr['long'],
//            ];
//        }, $data_cities);

//        dd(array_slice($cities, 0,10, true));

//        foreach ($cities as $city) {
//            $kota = City::where('type', $city['type'])->where('name', 'like', '%'.$city['name'].'%')->first();
//            if ($kota) {
//                $kota->update([
//                    'latitude' => $city['latitude'],
//                    'longitude' => $city['longitude'],
//                ]);
//            }
//        }
    }
}
