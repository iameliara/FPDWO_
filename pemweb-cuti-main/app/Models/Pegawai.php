<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;

class Pegawai extends Model implements
    Authenticatable
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = [
        'nik',
        'no_induk',
        'password',
        'nama',
        'alamat',
        'jenis_kelamin',
        'id_departemen',
        'created_by',
        'updated_by',
        'deleted_by'
    ];


    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'id_departemen', 'id');
    }

    public function riwayatCuti()
    {
        return $this->hasMany(RiwayatCuti::class, 'id_pegawai', 'id');
    }

    public function bisaCuti($tanggal)
    {
        $tahun = date_parse($tanggal);
        $tahun = $tahun['year'];

        $alokasiCuti = KonfigurasiCuti::where('tahun', $tahun)->first();
        $alokasiCuti = isset($alokasiCuti) ? $alokasiCuti->jml_cuti_maksimum : NULL;

        $cutiTerpakai = DB::table('riwayat_cuti')
            ->where('id_pegawai', $this->id)
            ->where('status_cuti', '!=', 'rejected')
            ->count();

        return !isset($alokasiCuti) || ($cutiTerpakai < $alokasiCuti);
    }

    public function getAuthIdentifierName()
    {
        return $this->primaryKey;
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
        return '';
    }
}
