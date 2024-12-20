<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
    use HasFactory;

    protected $table = 'jenis_cuti';

    protected $fillable = [
        'nama',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function riwayatCuti()
    {
        return $this->hasMany(RiwayatCuti::class, 'id_jenis_cuti', 'id');
    }
}
