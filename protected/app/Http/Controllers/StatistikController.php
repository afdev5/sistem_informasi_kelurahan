<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penduduk;
use App\Kelurahan;
use Auth;
use DataTables;

class StatistikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Statistik Pendidikan
    public function pendidikan()
    {
        $kel = Kelurahan::all();
        if(Auth::user()->level == 1){
            $total = Penduduk::where('status', 1)->count();
            if($total != 0){
                // Data
                $satu = Penduduk::where([['pendidikan', 1],['status', 1]])->count();
                $dua = Penduduk::where([['pendidikan', 2],['status', 1]])->count();
                $tiga = Penduduk::where([['pendidikan', 3],['status', 1]])->count();
                $empat = Penduduk::where([['pendidikan', 4],['status', 1]])->count();
                $lima = Penduduk::where([['pendidikan', 5],['status', 1]])->count();
                $enam = Penduduk::where([['pendidikan', 6],['status', 1]])->count();
                $tujuh = Penduduk::where([['pendidikan', 7],['status', 1]])->count();
                $delapan = Penduduk::where([['pendidikan', 8],['status', 1]])->count();
                $sembilan = Penduduk::where([['pendidikan', 9],['status', 1]])->count();
                $sepuluh = Penduduk::where([['pendidikan', 10],['status', 1]])->count();

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
                
                return view('statistik.pendidikan', compact('tdksklh', 'blmsd', 'sd', 'sltp', 'slta', 'd1', 'd3', 's1', 's2', 's3', 'total', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'kel'));
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
                
                return view('statistik.pendidikan', compact('tdksklh', 'blmsd', 'sd', 'sltp', 'slta', 'd1', 'd3', 's1', 's2', 's3', 'total', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'kel'));
            }
        }
        else{
            $total = Penduduk::where('kelurahan_id', Auth::user()->kelurahan_id)->count();
            if($total != 0){
                // Data
                $satu = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['pendidikan', 1],['status', 1]])->count();
                $dua = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['pendidikan', 2],['status', 1]])->count();
                $tiga = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['pendidikan', 3],['status', 1]])->count();
                $empat = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['pendidikan', 4],['status', 1]])->count();
                $lima = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['pendidikan', 5],['status', 1]])->count();
                $enam = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['pendidikan', 6],['status', 1]])->count();
                $tujuh = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['pendidikan', 7],['status', 1]])->count();
                $delapan = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['pendidikan', 8],['status', 1]])->count();
                $sembilan = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['pendidikan', 9],['status', 1]])->count();
                $sepuluh = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['pendidikan', 10],['status', 1]])->count();

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
                
                return view('statistik.pendidikan', compact('tdksklh', 'blmsd', 'sd', 'sltp', 'slta', 'd1', 'd3', 's1', 's2', 's3', 'total', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh'));
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
                
                return view('statistik.pendidikan', compact('tdksklh', 'blmsd', 'sd', 'sltp', 'slta', 'd1', 'd3', 's1', 's2', 's3', 'total', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh'));
            }
        }
    }
    
    // Statistik Usia
    public function usia()
    {
        $kel = Kelurahan::all();
        if(Auth::user()->level == 1){
            $total = Penduduk::count();
            if($total != 0){
                //Data
                $dsatu = Penduduk::where([['umur', '<=', 17],['status', 1]])->count();
                $ddua = Penduduk::where([['umur', '>', 17],['umur', '<=', 35],['status', 1]])->count();
                $dtiga = Penduduk::where([['umur', '>', 35],['umur', '<=', 50],['status', 1]])->count();
                $dempat = Penduduk::where([['umur', '>', 50],['umur', '<=', 65],['status', 1]])->count();
                $dlima = Penduduk::where([['umur', '>', 65],['status', 1]])->count();
                //Persen
                $satu = number_format(( $dsatu / $total) * 100, 2);
                $dua = number_format(( $ddua / $total) * 100, 2);
                $tiga = number_format(( $dtiga / $total) * 100, 2);
                $empat = number_format(( $dempat / $total) * 100, 2);
                $lima = number_format(( $dlima / $total) * 100, 2);
                // return $empat;
                return view('statistik.umur', compact('satu', 'dua', 'tiga', 'empat', 'lima', 'total', 'dsatu', 'ddua', 'dtiga', 'dempat', 'dlima', 'kel'));
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
                // return $empat;
                return view('statistik.umur', compact('satu', 'dua', 'tiga', 'empat', 'lima', 'total', 'dsatu', 'ddua', 'dtiga', 'dempat', 'dlima', 'kel'));
            }
        }
        else{
            $total = Penduduk::where('kelurahan_id', Auth::user()->kelurahan_id)->count();
            if($total != 0){
                //Data
                $dsatu = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['umur', '<=', 17],['status', 1]])->count();
                $ddua = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['umur', '>', 17],['umur', '<=', 35],['status', 1]])->count();
                $dtiga = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['umur', '>', 35],['umur', '<=', 50],['status', 1]])->count();
                $dempat = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['umur', '>', 50],['umur', '<=', 65],['status', 1]])->count();
                $dlima = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['umur', '>', 65],['status', 1]])->count();
                //Persen
                $satu = number_format(( $dsatu / $total) * 100, 2);
                $dua = number_format(( $ddua / $total) * 100, 2);
                $tiga = number_format(( $dtiga / $total) * 100, 2);
                $empat = number_format(( $dempat / $total) * 100, 2);
                $lima = number_format(( $dlima / $total) * 100, 2);
                // return $empat;
                return view('statistik.umur', compact('satu', 'dua', 'tiga', 'empat', 'lima', 'total', 'dsatu', 'ddua', 'dtiga', 'dempat', 'dlima'));
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
                // return $empat;
                return view('statistik.umur', compact('satu', 'dua', 'tiga', 'empat', 'lima', 'total', 'dsatu', 'ddua', 'dtiga', 'dempat', 'dlima'));
            }
        }
    }

    public function jk()
    {
        $kel = Kelurahan::all();
        if(Auth::user()->level == 1){
            $total = Penduduk::count();
            if($total != 0){
                $dsatu = Penduduk::where([['jenis_kelamin', 1],['status', 1]])->count();
                $ddua = Penduduk::where([['jenis_kelamin', 2],['status', 1]])->count();

                $satu = number_format(( $dsatu / $total) * 100, 2);
                $dua = number_format(( $ddua / $total) * 100, 2);
                return view('statistik.jk', compact('satu', 'dua','total', 'dsatu', 'ddua', 'kel'));
            }
            else{
                $dsatu = 0;
                $ddua = 0;

                $satu = 0;
                $dua = 0;
                // return $empat;
                return view('statistik.jk', compact('satu', 'dua','total', 'dsatu', 'ddua', 'kel'));
            }
        }
        else{
            $total = Penduduk::where('kelurahan_id', Auth::user()->kelurahan_id)->count();
            if($total != 0){
                $dsatu = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['jenis_kelamin', 1],['status', 1]])->count();
                $ddua = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['jenis_kelamin', 2],['status', 1]])->count();

                $satu = number_format(( $dsatu / $total) * 100, 2);
                $dua = number_format(( $ddua / $total) * 100, 2);
                return view('statistik.jk', compact('satu', 'dua','total', 'dsatu', 'ddua'));
            }
            else{
                $dsatu = 0;
                $ddua = 0;

                $satu = 0;
                $dua = 0;
                // return $empat;
                return view('statistik.jk', compact('satu', 'dua','total', 'dsatu', 'ddua'));
            }
        }
    }

    public function kawin()
    {
        $kel = Kelurahan::all();
        if(Auth::user()->level == 1){
            $total = Penduduk::count();
            if($total != 0){
                $dnol = Penduduk::where([['status_kawin', 0],['status', 1]])->count();
                $dsatu = Penduduk::where([['status_kawin', 1],['status', 1]])->count();
                $ddua = Penduduk::where([['status_kawin', 2],['status', 1]])->count();
                $dtiga = Penduduk::where([['status_kawin', 3],['status', 1]])->count();
                // 
                $nol = number_format(( $dnol / $total) * 100, 2);
                $satu = number_format(( $dsatu / $total) * 100, 2);
                $dua = number_format(( $ddua / $total) * 100, 2);
                $tiga = number_format(( $dtiga / $total) * 100, 2);
                return view('statistik.kawin', compact('satu', 'dua', 'nol', 'tiga', 'total', 'dnol', 'dsatu', 'ddua', 'dtiga', 'kel'));
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
                // return $empat;
                return view('statistik.kawin', compact('satu', 'dua', 'nol', 'tiga', 'total', 'dnol', 'dsatu', 'ddua', 'dtiga', 'kel'));
            }
        }
        else{
            $total = Penduduk::where('kelurahan_id', Auth::user()->kelurahan_id)->count();
            if($total != 0){
                $dnol = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['status_kawin', 0],['status', 1]])->count();
                $dsatu = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['status_kawin', 1],['status', 1]])->count();
                $ddua = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['status_kawin', 2],['status', 1]])->count();
                $dtiga = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['status_kawin', 3],['status', 1]])->count();
                // 
                $nol = number_format(( $dnol / $total) * 100, 2);
                $satu = number_format(( $dsatu / $total) * 100, 2);
                $dua = number_format(( $ddua / $total) * 100, 2);
                $tiga = number_format(( $dtiga / $total) * 100, 2);
                return view('statistik.kawin', compact('satu', 'dua', 'nol', 'tiga', 'total', 'dnol', 'dsatu', 'ddua', 'dtiga'));
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
                // return $empat;
                return view('statistik.kawin', compact('satu', 'dua', 'nol', 'tiga', 'total', 'dnol', 'dsatu', 'ddua', 'dtiga'));
            }
        }
    }

    public function agama()
    {
        $kel = Kelurahan::all();
        if(Auth::user()->level == 1){
            $total = Penduduk::count();
            if($total != 0){
                $dislam = Penduduk::where([['agama', 1],['status', 1]])->count();
                $dkristen = Penduduk::where([['agama', 2],['status', 1]])->count();
                $dkatolik = Penduduk::where([['agama', 3],['status', 1]])->count();
                $dbudha = Penduduk::where([['agama', 4],['status', 1]])->count();
                $dhindu = Penduduk::where([['agama', 5],['status', 1]])->count();
                // 
                $islam = number_format(( $dislam / $total) * 100, 2);
                $kristen = number_format(( $dkristen / $total) * 100, 2);
                $katolik = number_format(( $dkatolik / $total) * 100, 2);
                $budha = number_format(( $dbudha / $total) * 100, 2);
                $hindu = number_format(( $dhindu / $total) * 100, 2);
                return view('statistik.agama', compact('dislam', 'dkristen', 'dkatolik', 'dbudha', 'total', 'dhindu', 'islam', 'kristen', 'katolik', 'budha', 'hindu', 'kel'));
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
                return view('statistik.agama', compact('dislam', 'dkristen', 'dkatolik', 'dbudha', 'total', 'dhindu', 'islam', 'kristen', 'katolik', 'budha', 'hindu', 'kel'));
            }
        }
        else{
            $total = Penduduk::where('kelurahan_id', Auth::user()->kelurahan_id)->count();
            if($total != 0){
                $dislam = Penduduk::where([['agama', 1],['kelurahan_id', Auth::user()->kelurahan_id],['status', 1]])->count();
                $dkristen = Penduduk::where([['agama', 2],['kelurahan_id', Auth::user()->kelurahan_id],['status', 1]])->count();
                $dkatolik = Penduduk::where([['agama', 3],['kelurahan_id', Auth::user()->kelurahan_id],['status', 1]])->count();
                $dbudha = Penduduk::where([['agama', 4],['kelurahan_id', Auth::user()->kelurahan_id],['status', 1]])->count();
                $dhindu = Penduduk::where([['agama', 5],['kelurahan_id', Auth::user()->kelurahan_id],['status', 1]])->count();
                // 
                $islam = number_format(( $dislam / $total) * 100, 2);
                $kristen = number_format(( $dkristen / $total) * 100, 2);
                $katolik = number_format(( $dkatolik / $total) * 100, 2);
                $budha = number_format(( $dbudha / $total) * 100, 2);
                $hindu = number_format(( $dhindu / $total) * 100, 2);
                return view('statistik.agama', compact('dislam', 'dkristen', 'dkatolik', 'dbudha', 'total', 'dhindu', 'islam', 'kristen', 'katolik', 'budha', 'hindu'));
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
                return view('statistik.agama', compact('dislam', 'dkristen', 'dkatolik', 'dbudha', 'total', 'dhindu', 'islam', 'kristen', 'katolik', 'budha', 'hindu'));
            }
        }
    }

    // Fungsi Untuk Statistik Sesuai Kelurahan Di SuperAdmin
    public function agamaa(Request $request)
    {
        $kel = Kelurahan::all();
        $total = Penduduk::where('kelurahan_id', $request->kelurahan_id)->count();
            if($total != 0){
                $dislam = Penduduk::where([['agama', 1],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
                $dkristen = Penduduk::where([['agama', 2],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
                $dkatolik = Penduduk::where([['agama', 3],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
                $dbudha = Penduduk::where([['agama', 4],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
                $dhindu = Penduduk::where([['agama', 5],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
                // 
                $islam = number_format(( $dislam / $total) * 100, 2);
                $kristen = number_format(( $dkristen / $total) * 100, 2);
                $katolik = number_format(( $dkatolik / $total) * 100, 2);
                $budha = number_format(( $dbudha / $total) * 100, 2);
                $hindu = number_format(( $dhindu / $total) * 100, 2);
                return view('statistik.kelurahan.agama', compact('dislam', 'dkristen', 'dkatolik', 'dbudha', 'total', 'dhindu', 'islam', 'kristen', 'katolik', 'budha', 'hindu', 'kel'));
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
                return view('statistik.kelurahan.agama', compact('dislam', 'dkristen', 'dkatolik', 'dbudha', 'total', 'dhindu', 'islam', 'kristen', 'katolik', 'budha', 'hindu', 'kel'));
            }
    }

    public function pendidikann(Request $request)
    {
        $kel = Kelurahan::all();
        $total = Penduduk::where('kelurahan_id', $request->kelurahan_id)->count();
        if($total != 0){
            // Data
            $satu = Penduduk::where([['pendidikan', 1],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $dua = Penduduk::where([['pendidikan', 2],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $tiga = Penduduk::where([['pendidikan', 3],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $empat = Penduduk::where([['pendidikan', 4],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $lima = Penduduk::where([['pendidikan', 5],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $enam = Penduduk::where([['pendidikan', 6],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $tujuh = Penduduk::where([['pendidikan', 7],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $delapan = Penduduk::where([['pendidikan', 8],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $sembilan = Penduduk::where([['pendidikan', 9],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $sepuluh = Penduduk::where([['pendidikan', 10],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();

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
            
            return view('statistik.kelurahan.pendidikan', compact('tdksklh', 'blmsd', 'sd', 'sltp', 'slta', 'd1', 'd3', 's1', 's2', 's3', 'total', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'kel'));
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
            
            return view('statistik.kelurahan.pendidikan', compact('tdksklh', 'blmsd', 'sd', 'sltp', 'slta', 'd1', 'd3', 's1', 's2', 's3', 'total', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'kel'));
        }
    }

    public function jkk(Request $request)
    {
        $kel = Kelurahan::all();
        $total = Penduduk::where('kelurahan_id', $request->kelurahan_id)->count();
        if($total != 0){
            $dsatu = Penduduk::where([['jenis_kelamin', 1],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $ddua = Penduduk::where([['jenis_kelamin', 2],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();

            $satu = number_format(( $dsatu / $total) * 100, 2);
            $dua = number_format(( $ddua / $total) * 100, 2);
            return view('statistik.kelurahan.jk', compact('satu', 'dua','total', 'dsatu', 'ddua', 'kel'));
        }
        else{
            $dsatu = 0;
            $ddua = 0;

            $satu = 0;
            $dua = 0;
            // return $empat;
            return view('statistik.kelurahan.jk', compact('satu', 'dua','total', 'dsatu', 'ddua', 'kel'));
        }

    }

    public function kawinn(Request $request)
    {
        $kel = Kelurahan::all();
        $total = Penduduk::where('kelurahan_id', $request->kelurahan_id)->count();
        if($total != 0){
            $dnol = Penduduk::where([['status_kawin', 0],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $dsatu = Penduduk::where([['status_kawin', 1],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $ddua = Penduduk::where([['status_kawin', 2],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $dtiga = Penduduk::where([['status_kawin', 3],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            // 
            $nol = number_format(( $dnol / $total) * 100, 2);
            $satu = number_format(( $dsatu / $total) * 100, 2);
            $dua = number_format(( $ddua / $total) * 100, 2);
            $tiga = number_format(( $dtiga / $total) * 100, 2);
            return view('statistik.kelurahan.kawin', compact('satu', 'dua', 'nol', 'tiga', 'total', 'dnol', 'dsatu', 'ddua', 'dtiga', 'kel'));
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
            // return $empat;
            return view('statistik.kelurahan.kawin', compact('satu', 'dua', 'nol', 'tiga', 'total', 'dnol', 'dsatu', 'ddua', 'dtiga', 'kel'));
        }
    }

    public function usiaa(Request $request)
    {
        $kel = Kelurahan::all();
        $total = Penduduk::where('kelurahan_id', $request->kelurahan_id)->count();
        if($total != 0){
            //Data
            $dsatu = Penduduk::where([['umur', '<=', 17],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $ddua = Penduduk::where([['umur', '>', 17],['umur', '<=', 35],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $dtiga = Penduduk::where([['umur', '>', 35],['umur', '<=', 50],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $dempat = Penduduk::where([['umur', '>', 50],['umur', '<=', 65],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            $dlima = Penduduk::where([['umur', '>', 65],['status', 1],['kelurahan_id', $request->kelurahan_id]])->count();
            //Persen
            $satu = number_format(( $dsatu / $total) * 100, 2);
            $dua = number_format(( $ddua / $total) * 100, 2);
            $tiga = number_format(( $dtiga / $total) * 100, 2);
            $empat = number_format(( $dempat / $total) * 100, 2);
            $lima = number_format(( $dlima / $total) * 100, 2);
            // return $empat;
            return view('statistik.kelurahan.umur', compact('satu', 'dua', 'tiga', 'empat', 'lima', 'total', 'dsatu', 'ddua', 'dtiga', 'dempat', 'dlima', 'kel'));
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
            // return $empat;
            return view('statistik.kelurahan.umur', compact('satu', 'dua', 'tiga', 'empat', 'lima', 'total', 'dsatu', 'ddua', 'dtiga', 'dempat', 'dlima', 'kel'));
        }
    }
}
