<?php

namespace App\Http\Controllers\NeracaSurga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function ajaxHitungNeraca(Request $request){
        try {
            // dd($request->all());
            $nama_orang = $request->nama_orang;
            $jumlah_orang = count($nama_orang);
            $deskripsi  = $request->deskripsi;
            $jumlah     = $request->jumlah;
            $harga      = $request->harga;
            $diskon     = $request->diskon;
            $ongkir     = $request->Ongkir;
            $ongkir_satuan = customRound($ongkir / $jumlah_orang);
            $total_non_diskon = 0;
            $arr_map = [];
            //mapping
            foreach ($nama_orang as $key => $value) {
                $arr = collect([]);
                $subtotal = 0;
                foreach ($deskripsi[$key] as $index_arr => $item) {
                    $jumlah_current = $jumlah[$key][$index_arr];
                    $harga_current = $harga[$key][$index_arr];
                    $total_current = $jumlah_current * $harga_current;
                    $subtotal += $total_current;
                    // $arr[$index_arr][] = [
                    //     'deskripsi' => $item,
                    //     'jumlah'    => $jumlah_current,
                    //     'harga'     => $harga_current,
                    //     'total'     => $total_current
                    // ];
                    $arr->push([
                        'deskripsi' => $item,
                        'jumlah'    => $jumlah_current,
                        'harga'     => $harga_current,
                        'total'     => $total_current
                    ]);
                }
                $total_non_diskon += $subtotal;
                $arr_map[] = [
                    'name'     => $value,
                    'pesanan'  => $arr,
                    'subtotal' => $subtotal,
                    'ongkir'   => $ongkir_satuan,
                    // 'diskon'   => $diskon_satuan,
                ];

            }
            // dd($arr_map);
            //hitung diskonnya
            $diskon_satuan = customRound(1 - ($diskon/$total_non_diskon));
            $total_akhir = 0;
            $map = collect([]);
            foreach ($arr_map as $key => $value) {

                $subtotal_diskon = $value['subtotal'] * $diskon_satuan;
                $total = $subtotal_diskon + $value['ongkir'];
                $total_akhir += $total;
                $value['subtotal_diskon'] = $subtotal_diskon;
                $value['total'] = $total;
                $map->push($value);
            }

            $result = [
                'data' => $map
            ];
            return $this->successJson(
                $result
            );
        } catch (\Throwable $th) {
            return $this->exceptionJson($th);
        }
    }
}
