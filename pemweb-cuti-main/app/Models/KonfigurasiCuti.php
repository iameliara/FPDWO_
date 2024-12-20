<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonfigurasiCuti extends Model
{
    use HasFactory;

    protected $table = 'konfigurasi_cuti';

    protected $fillable = [
        'tahun',
        'jml_cuti_maksimum',
        'jml_cuti_bersama',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
