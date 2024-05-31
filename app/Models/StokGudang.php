<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokGudang extends Model
{
    use HasFactory;
    protected $table = 'stok_gudang';
    protected $primaryKey = 'id_stokgudang';
    protected $guarded = [];

}
