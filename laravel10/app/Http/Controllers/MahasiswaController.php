<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller{

    public function insertElq(){
        //Single Assignment
        $mhs = new Mahasiswa();
        $mhs->nama = "Jonathan Wijaya";
        $mhs ->npm = "2226250009";
        $mhs->tempat_lahir = "Tokyo";
        $mhs->tanggal_lahir = date("Y-m-d");
        $mhs->save();
        dump($mhs);

        //mass alignment
        $mhs = Mahasiswa::insert(
            [   
                [
                'nama' => 'Jonathan Wijaya', 'npm' => '2226250009', 'tempat_lahir' => 'Palembang',
                'tanggal_lahir' => date('Y-m-d')
                ]
        ]);
        dump($mhs);
    }

    public function updateElq(){
        $mhs = Mahasiswa::where('npm', '2226250009')->first();
        $mhs->nama_mahasiswa = 'Jonathan Wijaya';
        $mhs->save();
        dump($mhs);
    }

    public function deleteElq(){
        $result = DB::delete('Delete from mahasiswas where npm = ?', ['2226250009']);
        dump($result);
    }

    public function selectElq(){
        $result = DB::select('select * from mahasiswas');
        dump($result);
    }

}