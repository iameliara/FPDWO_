<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $table = 'departemen';

    protected $fillable = [
        'nama',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_pegawai', 'id');
    }
}
