<?php

namespace App\Http\Controllers;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class prodiController extends Controller{

    public function index(){
        $kampus = "Universitas Multi Data Palembang";
        return view("prodi.index")->with("kampus", $kampus);
    }

    public function allJoinFacade(){
        $kampus = "Universitas Multi Data Palembang";
        $result = DB::select('select mahasiswas.*, prodis.nama as nama_prodi from prodis,
        mahasiswas where prodi_id = mahasiswas.prodi_id');
        return view('prodi.index', ['allmahasiswaprodi' => $result, 'kampus' => $kampus]);
    }

    public function allJoinElq(){
        $prodis = Prodi::with('mahasiswas')->get();
        foreach($prodis as $prodi){
            echo "<h3>{$prodi -> nama}";
            echo "<hr>Mahasiswa: ";
            foreach($prodi -> mahasiswas as $mhs){
                echo $mhs->nama . ", ";
            }
            echo "<hr>";
        }
    }

    public function create(){
        return view('prodi.create');
    }
}



