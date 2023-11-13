<?php

namespace App\Http\Controllers;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class prodiController extends Controller{

    public function index(){
        $prodis = Prodi::all();
        return view('prodi.index')->with('prodis',$prodis);
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

    public function store(Request $request){
        //dump($request);
        //echo $request->nama;

        $validateData = $request->validate([
            'nama' => 'required|min:5|max:20',
        ]);
        //dump($validateData);
        //echo $validateData['nama'];

        $prodi = new Prodi();
        $prodi->nama = $validateData['nama'];
        $prodi -> save();

        $request->session()->flash('info',"Data prodi $prodi->nama berhasil disimpan ke database");
        return redirect()->route('prodi.create');
    }

     public function show(Prodi $prodi){
        return view('prodi.show', ['prodi' => $prodi]);
     }

     public function update(Request $request, Prodi $prodi){
        $validateData = $request->validate([
            'nama'=> 'required|min:5|max:20',
        ]);

        Prodi::where('id', $prodi->id)->update($validateData);
        $request->session()->flash('info',"Data Prodi $prodi->nama berhasil diubah");;
        return redirect()->route('prodi.index');
     }
}



