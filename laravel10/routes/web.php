<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\prodiController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KurikulumController;
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


Route::resource('/kurikulum', KurikulumController::class);

Route::apiResource('/dosen', DosenController::class);

Route::get("/mahasiswa/insert-elq", [MahasiswaController::class, 'InsertElq']);
Route::get("/mahasiswa/update-elq", [MahasiswaController::class, 'UpdateElq']);
Route::get("/mahasiswa/delete-elq", [MahasiswaController::class, 'deleteElq']);
Route::get("/mahasiswa/select-elq", [MahasiswaController::class, 'selectElq']);

Route::get('prodi/all-join-facade', [ProdiController::class, 'allJoinFacade']);
Route::get('prodi/all-join-elq', [ProdiController::class,'allJoinElq']);
Route::get('/mahasiswa/all-join-elq', [MahasiswaController::class, 'allJoinElq']);

Route::get('/prodi/create', [ProdiController::class,'create'])->name('prodi.create');
Route::post('prodi/store', [ProdiController::class,'store']);

 Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
 Route::get('/prodi/{id}', [ProdiController::class, 'show'])->with('prodi.show');

 Route::get('/prodi/{prodi}/edit', [prodiController::class, 'edit'])->name('prodi.edit');
 Route::patch('/prodi/{prodi}', [prodiController::class,'update'])->name('prodi.upate');


