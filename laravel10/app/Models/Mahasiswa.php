<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model{
    use HasFactory;

    //jika nama tabel berbeda
    protected $table = "mahasiswas";

    //untuk mengatur kolom yang boleh diisi saat mass insert
    protected $fillable = ['npm', 'nama'];

    //untuke mengatur kolom yang tidak boleh diiisi
    protected $guarded = [];

    public function prodi(){
        return $this->belongsTo('App\Models\Prodi');
    }
}
