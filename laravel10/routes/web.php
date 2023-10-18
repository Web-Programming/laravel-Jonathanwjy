<?php

use App\Http\Controllers\prodiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//buat route ke halaman profil
Route::get("/profil", function(){
    return view("profil");
});

//route dengan parameter (wajib)
Route::get("/Mahasiswa/{nama?}", function($nama = "Jonathan"){
    echo "<h1>Halo nama saya $nama</h1>";
});

//Route dengan parameter (tidak wajib);
Route::get("Mahasiswa2/(nama?", function($nama = "Jonathan"){
    echo "<h2>Halo nama saya $nama</h2>";
});

//route dengan parameter > 1
Route::get("/profil/{nama?}/{pekerjaan?}",
        function($nama = "Jonathan", $pekerjaan = "Mahasiswa"){
            echo "Halo nama saya $nama dan saya adalah $pekerjaan";
});

//Redirect 
Route::get("/hubungi", function(){
    echo "<h1>Hubungi Kami</h1>";
}) -> name("call");

Route::redirect("/contact", "/hubungi");

Route::get("/halo", function(){
    echo "<a href='" . route('call') . "'>" . route('call') . "</a>";
});

//Memudahkan kit mengelompokan route per modul
Route::prefix("/dosen")->group(function(){
    Route::get("/jadwal", function(){
        echo "<h1>Jadwal dosen </h1>";
    });
    Route::get("/materi", function(){
        echo "<h2>Materi Perkulihahan</h2>";
    });
});

Route::get('/prodi', [prodiController::class,"Index"]);

Route::resource('/kurikulum', KurikulumController::class);

Route::apiResource('/dosen', DosenController::class);