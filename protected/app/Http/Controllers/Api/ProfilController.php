<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelurahan;
use App\InfoKelurahan;
use App\Penduduk;
use App\KegiatanKelurahan;
use App\Wilayah;
use App\Struktur_Kelurahan;
use Validator;

class ProfilController extends Controller
{
    public function beranda(Request $request)
    {
       $req = $request->all();
       $messsages = ['kelurahan_id.required' => 'kelurahan_id Tidak Bisa Kosong'];
       $rules = ['kelurahan_id' => 'required'];

       $validator = Validator::make($req, $rules,$messsages);
       if($validator->fails()){
            $success = 0;
            $msg = $validator->messages()->all();
            $kr = 400;
       }else{
            
            $kelurahan = Kelurahan::findOrFail($req['kelurahan_id']);
            $info = InfoKelurahan::where('kelurahan_id', $req['kelurahan_id'])->first();
            $pendtotal = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['status', 1]])->count();
            $pendlaki = Penduduk::where([['kelurahan_id', $req['kelurahan_id']], ['jenis_kelamin', 1],['status', 1]])->count();
            $pendwanita = Penduduk::where([['kelurahan_id', $req['kelurahan_id']], ['jenis_kelamin', 2],['status', 1]])->count();
            $pendanak = Penduduk::where([['kelurahan_id', $req['kelurahan_id']], ['umur', '<=' , 17],['status', 1]])->count();

            // $success = 1;
            // $msg = $select;
            $penduduk = [
                 'penduduk_total' => $pendtotal,
                 'penduduk_pria' => $pendlaki, 
                 'penduduk_wanita' => $pendwanita, 
                 'penduduk_anak' => $pendanak,
               ];
            $kegiatanterbaru = KegiatanKelurahan::where('kelurahan_id', $req['kelurahan_id'])->orderBy('id', 'DESC')->first();
            $kegiatan = KegiatanKelurahan::where('kelurahan_id', $req['kelurahan_id'])->orderBy('id', 'DESC')->paginate(5);
            $struktur = [
               'lurah' => Struktur_Kelurahan::where([['kelurahan_id', $req['kelurahan_id']], ['level_jabatan', '0']])->first(),
               'sek' => Struktur_Kelurahan::where([['kelurahan_id', $req['kelurahan_id']], ['level_jabatan', '1']])->first(),
               'ks1' => Struktur_Kelurahan::where([['kelurahan_id', $req['kelurahan_id']], ['level_jabatan', '2']])->first(),
               'ks2' => Struktur_Kelurahan::where([['kelurahan_id', $req['kelurahan_id']], ['level_jabatan', '3']])->first(),
               'ks3' => Struktur_Kelurahan::where([['kelurahan_id', $req['kelurahan_id']], ['level_jabatan', '4']])->first(),
               'ks4' => Struktur_Kelurahan::where([['kelurahan_id', $req['kelurahan_id']], ['level_jabatan', '5']])->first(),
            ];

       }
       return response()->json(['kelurahan' => $kelurahan, 'info' => $info, 'penduduk' => $penduduk, 'kegiatan_terbaru' => $kegiatanterbaru, 'kegiatan' => $kegiatan, 'struktur' => $struktur], 200);
    }

    public function info(Request $request)
    {
       $req = $request->all();
       $messsages = ['kelurahan_id.required' => 'kelurahan_id Tidak Bisa Kosong'];
       $rules = ['kelurahan_id' => 'required'];

       $validator = Validator::make($req, $rules,$messsages);
       if($validator->fails()){
            $success = 0;
            $msg = $validator->messages()->all();
            $kr = 400;
       }else{
            
            $kelurahan = Kelurahan::findOrFail($req['kelurahan_id']);
            $info = InfoKelurahan::where('kelurahan_id', $req['kelurahan_id'])->first();

       }
       return response()->json(['kelurahan' => $kelurahan, 'info' => $info], 200);
    }

    public function wilayah(Request $request)
    {
       $req = $request->all();
       $messsages = ['kelurahan_id.required' => 'kelurahan_id Tidak Bisa Kosong'];
       $rules = ['kelurahan_id' => 'required'];

       $validator = Validator::make($req, $rules,$messsages);
       if($validator->fails()){
            $success = 0;
            $msg = $validator->messages()->all();
            $kr = 400;
       }else{
            
            $kelurahan = Kelurahan::findOrFail($req['kelurahan_id']);
            $info = InfoKelurahan::where('kelurahan_id', $req['kelurahan_id'])->first();
            $wilayah = [
                 'utara' => Wilayah::where([['kelurahan_id', $req['kelurahan_id']], ['bagian', 1]])->first(),
                 'timur' => Wilayah::where([['kelurahan_id', $req['kelurahan_id']], ['bagian', 2]])->first(),
                 'selatan' => Wilayah::where([['kelurahan_id', $req['kelurahan_id']], ['bagian', 3]])->first(),
                 'barat' => Wilayah::where([['kelurahan_id', $req['kelurahan_id']], ['bagian', 4]])->first(),
                    ];

       }
       return response()->json(['kelurahan' => $kelurahan, 'info' => $info, 'wilayah' => $wilayah], 200);
    }

    public function statistik_pendidikan(Request $request)
    {
     $req = $request->all();
     $messsages = ['kelurahan_id.required' => 'kelurahan_id Tidak Bisa Kosong'];
     $rules = ['kelurahan_id' => 'required'];

     $validator = Validator::make($req, $rules,$messsages);
     if($validator->fails()){
          $success = 0;
          $msg = $validator->messages()->all();
          $kr = 400;
     }else{
          
          $kelurahan = Kelurahan::findOrFail($req['kelurahan_id']);
          $info = InfoKelurahan::where('kelurahan_id', $req['kelurahan_id'])->first();
          $total = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['status', 1]])->count();
            if($total != 0){
                // Data
                $satu = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['pendidikan', 1],['status', 1]])->count();
                $dua = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['pendidikan', 2],['status', 1]])->count();
                $tiga = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['pendidikan', 3],['status', 1]])->count();
                $empat = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['pendidikan', 4],['status', 1]])->count();
                $lima = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['pendidikan', 5],['status', 1]])->count();
                $enam = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['pendidikan', 6],['status', 1]])->count();
                $tujuh = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['pendidikan', 7],['status', 1]])->count();
                $delapan = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['pendidikan', 8],['status', 1]])->count();
                $sembilan = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['pendidikan', 9],['status', 1]])->count();
                $sepuluh = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['pendidikan', 10],['status', 1]])->count();

                // persen
                $tdksklh = number_format(($satu / $total) * 100, 2);
                $blmsd = number_format(( $dua / $total) * 100, 2);
                $sd = number_format(( $tiga / $total) * 100, 2);
                $sltp = number_format(( $empat / $total) * 100, 2); 
                $slta = number_format(( $lima / $total) * 100, 2);
                $d1 = number_format(( $enam / $total) * 100, 2);
                $d3 = number_format(( $tujuh / $total) * 100, 2);
                $s1 = number_format(( $delapan / $total) * 100, 2);
                $s2 = number_format(( $sembilan / $total) * 100, 2);
                $s3 = number_format(( $sepuluh / $total) *100, 2);
                
            
          }
            else{
                // Data
                $satu = 0;
                $dua = 0;
                $tiga = 0;
                $empat = 0;
                $lima = 0;
                $enam = 0;
                $tujuh = 0;
                $delapan = 0;
                $sembilan = 0;
                $sepuluh = 0;

                // persen
                $tdksklh = 0;
                $blmsd = 0;
                $sd = 0;
                $sltp = 0;
                $slta = 0;
                $d1 = 0;
                $d3 = 0;
                $s1 = 0;
                $s2 = 0;
                $s3 = 0;
               
            }
            $statistik = [
               'tdksklh' => $tdksklh,
               'blmsd' => $blmsd,
               'sd' => $sd,
               'sltp' => $sltp,
               'slta' => $slta,
               'd1' => $d1,
               'd3' => $d3,
               's1' => $s1,
               's2' => $s2,
               's3' => $s3
            ];
            $data = [
                 'total' => $total,
                 'satu' => $satu,
                 'dua' => $dua,
                 'tiga' => $tiga,
                 'empat' => $empat,
                 'lima' => $lima,
                 'enam' => $enam,
                 'tujuh' => $tujuh,
                 'delapan' => $delapan,
                 'sembilan' => $sembilan,
                 'sepuluh' => $sepuluh,
                 'statistik' => $statistik
            ];

     }
     return response()->json(['kelurahan' => $kelurahan, 'info' => $info, 'data' => $data], 200);
    }


    public function statistik_usia(Request $request)
    {
     $req = $request->all();
     $messsages = ['kelurahan_id.required' => 'kelurahan_id Tidak Bisa Kosong'];
     $rules = ['kelurahan_id' => 'required'];

     $validator = Validator::make($req, $rules,$messsages);
     if($validator->fails()){
          $success = 0;
          $msg = $validator->messages()->all();
          $kr = 400;
     }else{
          
          $kelurahan = Kelurahan::findOrFail($req['kelurahan_id']);
          $info = InfoKelurahan::where('kelurahan_id', $req['kelurahan_id'])->first();
          $total = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['status', 1]])->count();
          if($total != 0){
               //Data
               $dsatu = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['umur', '<=', 17],['status', 1]])->count();
               $ddua = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['umur', '>', 17],['umur', '<=', 35],['status', 1]])->count();
               $dtiga = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['umur', '>', 35],['umur', '<=', 50],['status', 1]])->count();
               $dempat = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['umur', '>', 50],['umur', '<=', 65],['status', 1]])->count();
               $dlima = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['umur', '>', 65],['status', 1]])->count();
               //Persen
               $satu = number_format(( $dsatu / $total) * 100, 2);
               $dua = number_format(( $ddua / $total) * 100, 2);
               $tiga = number_format(( $dtiga / $total) * 100, 2);
               $empat = number_format(( $dempat / $total) * 100, 2);
               $lima = number_format(( $dlima / $total) * 100, 2);
          }
           else{
               $dsatu = 0;
               $ddua = 0;
               $dtiga = 0;
               $dempat = 0;
               $dlima = 0;
               
               $satu = 0;
               $dua = 0;
               $tiga = 0;
               $empat = 0;
               $lima = 0;
           }
            $statistik = [
               'satu' => $satu,
               'dua' => $dua,
               'tiga' => $tiga,
               'empat' => $empat,
               'lima' => $lima,
            ];
            $data = [
                 'total' => $total,
                 'dsatu' => $dsatu,
                 'ddua' => $ddua,
                 'dtiga' => $dtiga,
                 'dempat' => $dempat,
                 'dlima' => $dlima,
                 'statistik' => $statistik
            ];

     }
     return response()->json(['kelurahan' => $kelurahan, 'info' => $info, 'data' => $data], 200);
    }

    public function statistik_agama(Request $request)
    {
     $req = $request->all();
     $messsages = ['kelurahan_id.required' => 'kelurahan_id Tidak Bisa Kosong'];
     $rules = ['kelurahan_id' => 'required'];

     $validator = Validator::make($req, $rules,$messsages);
     if($validator->fails()){
          $success = 0;
          $msg = $validator->messages()->all();
          $kr = 400;
     }else{
          
          $kelurahan = Kelurahan::findOrFail($req['kelurahan_id']);
          $info = InfoKelurahan::where('kelurahan_id', $req['kelurahan_id'])->first();
          $total = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['status', 1]])->count();
          if($total != 0){
               $dislam = Penduduk::where([['agama', 1],['kelurahan_id', $req['kelurahan_id']],['status', 1]])->count();
               $dkristen = Penduduk::where([['agama', 2],['kelurahan_id', $req['kelurahan_id']],['status', 1]])->count();
               $dkatolik = Penduduk::where([['agama', 3],['kelurahan_id', $req['kelurahan_id']],['status', 1]])->count();
               $dbudha = Penduduk::where([['agama', 4],['kelurahan_id', $req['kelurahan_id']],['status', 1]])->count();
               $dhindu = Penduduk::where([['agama', 5],['kelurahan_id', $req['kelurahan_id']],['status', 1]])->count();
               // 
               $islam = number_format(( $dislam / $total) * 100, 2);
               $kristen = number_format(( $dkristen / $total) * 100, 2);
               $katolik = number_format(( $dkatolik / $total) * 100, 2);
               $budha = number_format(( $dbudha / $total) * 100, 2);
               $hindu = number_format(( $dhindu / $total) * 100, 2);
          }
           else{
               $dislam = 0;
               $dkristen = 0;
               $dkatolik = 0;
               $dbudha = 0;
               $dhindu = 0;
               // 
               $islam = 0;
               $kristen = 0;
               $katolik = 0;
               $budha = 0;
               $hindu = 0;
          }
            $statistik = [
               'satu' => $islam,
               'dua' => $kristen,
               'tiga' => $katolik,
               'empat' => $budha,
               'lima' => $hindu,
            ];
            $data = [
                 'total' => $total,
                 'dsatu' => $dislam,
                 'ddua' => $dkristen,
                 'dtiga' => $dkatolik,
                 'dempat' => $dbudha,
                 'dlima' => $dhindu,
                 'statistik' => $statistik
            ];

     }
     return response()->json(['kelurahan' => $kelurahan, 'info' => $info, 'data' => $data], 200);
    }

    public function statistik_jk(Request $request)
    {
     $req = $request->all();
     $messsages = ['kelurahan_id.required' => 'kelurahan_id Tidak Bisa Kosong'];
     $rules = ['kelurahan_id' => 'required'];

     $validator = Validator::make($req, $rules,$messsages);
     if($validator->fails()){
          $success = 0;
          $msg = $validator->messages()->all();
          $kr = 400;
     }else{
          
          $kelurahan = Kelurahan::findOrFail($req['kelurahan_id']);
          $info = InfoKelurahan::where('kelurahan_id', $req['kelurahan_id'])->first();
          $total = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['status', 1]])->count();
          if($total != 0){
               $dsatu = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['jenis_kelamin', 1],['status', 1]])->count();
               $ddua = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['jenis_kelamin', 2],['status', 1]])->count();

               $satu = number_format(( $dsatu / $total) * 100, 2);
               $dua = number_format(( $ddua / $total) * 100, 2);
           }
           else{
               $dsatu = 0;
               $ddua = 0;

               $satu = 0;
               $dua = 0;
               // return $empat;
           }
            $statistik = [
               'satu' => $satu,
               'dua' => $dua,
            ];
            $data = [
                 'total' => $total,
                 'dsatu' => $dsatu,
                 'ddua' => $ddua,
                 'statistik' => $statistik
            ];

     }
     return response()->json(['kelurahan' => $kelurahan, 'info' => $info, 'data' => $data], 200);
    }

    public function statistik_kawin(Request $request)
    {
     $req = $request->all();
     $messsages = ['kelurahan_id.required' => 'kelurahan_id Tidak Bisa Kosong'];
     $rules = ['kelurahan_id' => 'required'];

     $validator = Validator::make($req, $rules,$messsages);
     if($validator->fails()){
          $success = 0;
          $msg = $validator->messages()->all();
          $kr = 400;
     }else{
          
          $kelurahan = Kelurahan::findOrFail($req['kelurahan_id']);
          $info = InfoKelurahan::where('kelurahan_id', $req['kelurahan_id'])->first();
          $total = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['status', 1]])->count();
          if($total != 0){
               $dnol = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['status_kawin', 0],['status', 1]])->count();
               $dsatu = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['status_kawin', 1],['status', 1]])->count();
               $ddua = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['status_kawin', 2],['status', 1]])->count();
               $dtiga = Penduduk::where([['kelurahan_id', $req['kelurahan_id']],['status_kawin', 3],['status', 1]])->count();
               // 
               $nol = number_format(( $dnol / $total) * 100, 2);
               $satu = number_format(( $dsatu / $total) * 100, 2);
               $dua = number_format(( $ddua / $total) * 100, 2);
               $tiga = number_format(( $dtiga / $total) * 100, 2);
          }
           else{
               $dnol = 0;
               $dsatu = 0;
               $ddua = 0;
               $dtiga = 0;
               
               $nol = 0;
               $satu = 0;
               $dua = 0;
               $tiga = 0; 
          }
            $statistik = [
               'satu' => $nol,
               'dua' => $satu,
               'tiga' => $dua,
               'empat' => $tiga,
            ];
            $data = [
                 'total' => $total,
                 'dsatu' => $dnol,
                 'ddua' => $dsatu,
                 'dtiga' => $ddua,
                 'dempat' => $dtiga,
                 'statistik' => $statistik
            ];

     }
     return response()->json(['kelurahan' => $kelurahan, 'info' => $info, 'data' => $data], 200);
    }

    public function kegiatan(Request $request)
    {
     $req = $request->all();
     $messsages = ['kelurahan_id.required' => 'kelurahan_id Tidak Bisa Kosong'];
     $rules = ['kelurahan_id' => 'required'];

     $validator = Validator::make($req, $rules,$messsages);
     if($validator->fails()){
          $success = 0;
          $msg = $validator->messages()->all();
          $kr = 400;
     }else{
          
          $kelurahan = Kelurahan::findOrFail($req['kelurahan_id']);
          $info = InfoKelurahan::where('kelurahan_id', $req['kelurahan_id'])->first();
          $data = KegiatanKelurahan::where('kelurahan_id', $req['kelurahan_id'])->orderBy('id', 'DESC')->get();

     }
     return response()->json(['kelurahan' => $kelurahan, 'info' => $info, 'data' => $data], 200);
    }

    public function detail_kegiatan(Request $request)
    {
     $req = $request->all();
     $messsages = ['kelurahan_id.required' => 'kelurahan_id Tidak Bisa Kosong', 
                   'kegiatan_id.required' => 'kegiatan_id Tidak Bisa Kosong'];
     $rules = ['kelurahan_id' => 'required', 'kegiatan_id' => 'required'];

     $validator = Validator::make($req, $rules,$messsages);
     if($validator->fails()){
          $success = 0;
          $msg = $validator->messages()->all();
          $kr = 400;
     }else{
          
          $kelurahan = Kelurahan::findOrFail($req['kelurahan_id']);
          $info = InfoKelurahan::where('kelurahan_id', $req['kelurahan_id'])->first();
          $data = KegiatanKelurahan::findOrFail($req['kegiatan_id']);

     }
     return response()->json(['kelurahan' => $kelurahan, 'info' => $info, 'data' => $data], 200);
    }

    public function galeri(Request $request)
    {
     $req = $request->all();
     $messsages = ['kelurahan_id.required' => 'kelurahan_id Tidak Bisa Kosong'];
     $rules = ['kelurahan_id' => 'required'];

     $validator = Validator::make($req, $rules,$messsages);
     if($validator->fails()){
          $success = 0;
          $msg = $validator->messages()->all();
          $kr = 400;
     }else{
          
          $kelurahan = Kelurahan::findOrFail($req['kelurahan_id']);
          $info = InfoKelurahan::where('kelurahan_id', $req['kelurahan_id'])->first();
          $data = KegiatanKelurahan::select('gambar', 'judul', 'tgl')->where('kelurahan_id',$req['kelurahan_id'])->get();

     }
     return response()->json(['kelurahan' => $kelurahan, 'info' => $info, 'data' => $data], 200);
    }
}
