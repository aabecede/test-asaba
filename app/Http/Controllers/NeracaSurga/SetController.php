<?php

namespace App\Http\Controllers\NeracaSurga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SetController extends Controller
{
    public function setHitungNeraca(Request $request){
        /**param wajib1 */
        $nama_orang = $request->nama_orang;
        $jumlah_orang = count($nama_orang);
        $deskripsi  = $request->deskripsi;
        $jumlah     = $request->jumlah;
        $harga      = $request->harga;
        $diskon     = $request->diskon;
        $ongkir     = $request->Ongkir;
        /**end param wajib */

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
                    'jumlah'    => (float)$jumlah_current,
                    'harga'     => (float)$harga_current,
                    'total'     => (float)$total_current
                ]);
            }
            $total_non_diskon += $subtotal;
            $arr_map[] = [
                'name'     => $value,
                'pesanan'  => $arr,
                'subtotal' => (float)$subtotal,
                'ongkir'   => (float)$ongkir_satuan,
                // 'diskon'   => $diskon_satuan,
            ];
        }
        // dd($arr_map);
        //hitung diskonnya
        // dd((float)$diskon, $total_non_diskon, ((float)$diskon / $total_non_diskon));
        $diskon_satuan = (1 - ($diskon / $total_non_diskon));
        $diskon_satuan = $diskon_satuan == 1 ? 0 : $diskon_satuan;
        $total_akhir = 0;
        $map = collect([]);
        foreach ($arr_map as $key => $value) {

            $subtotal_diskon = $value['subtotal'] * $diskon_satuan;
            $diskon = $value['subtotal'] - $subtotal_diskon;
            $total = $subtotal_diskon + $value['ongkir'];
            $total = $total != 0 ? $total : $value['subtotal'];
            $total_akhir += $total;

            $value['diskon'] = (float)$diskon;
            $value['subtotal_diskon'] = (float)$subtotal_diskon;
            $value['total'] = (float)$total;
            $map->push($value);
        }

        $result = [
            'data' => $map,
            'total' => $total_akhir
        ];

        return $result;
    }
}
