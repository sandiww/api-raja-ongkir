<?php

namespace App\Http\Controllers;

use App\City;
use App\Province;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckOngkirController extends Controller
{
    // fungsi ini kita gunakan untuk menampilkan view dari aplikasi kita
    public function index() {
        $provinces = Province::pluck('name', 'province_id');
        return view('ongkir', compact('provinces'));
    }

    // fungsi ini akan kita gunakan untuk mendapatkan data kota berdasarkan kode provinsi dalam bentuk data JSON
    public function getCities($id)
    {
        $city  = City::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }

    // fungsi ini akan kita gunakan untuk menghitung dari ongkos kirim yang mana datanya akan dikembalikan dalam bentuk JSON
    public function check_ongkir(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'            => $request->city_origin, // ID Kota/ Kab Asal
            'destination'       => $request->city_destination, // ID Kota/ Kab Tujuan
            'weight'            => $request->weight, // Berat Barang Dalam Satuan Gram
            'courier'           => $request->courier, // Kode Kurir 
        ])->get();

        return response()->json($cost);
    }
}
