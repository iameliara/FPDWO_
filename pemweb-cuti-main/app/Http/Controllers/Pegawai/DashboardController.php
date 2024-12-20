<?php

// Penanggung jawab : Miko

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\RiwayatCuti;
use App\Models\JenisCuti;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexHTML(Request $request)
    {
        $statistik = [];
        $statistik['pending'] = RiwayatCuti::where(['status_cuti' => 'pending', 'id_pegawai' => Auth::guard('pegawai')->id()])->count();
        $statistik['approved'] = RiwayatCuti::where(['status_cuti' => 'approved', 'id_pegawai' => Auth::guard('pegawai')->id()])->count();
        $statistik['rejected'] = RiwayatCuti::where(['status_cuti' => 'rejected', 'id_pegawai' => Auth::guard('pegawai')->id()])->count();

        $daftarJenisCuti = JenisCuti::all();
        foreach ($daftarJenisCuti as &$jenisCuti)
        {
            $jenisCuti->jumlah = RiwayatCuti::where(['id_jenis_cuti' => $jenisCuti->id, 'id_pegawai' => Auth::guard('pegawai')->id()])->count();
        }

        return view('pegawai.dashboard', [
            'statistik' => $statistik,
            'daftarJenisCuti' => $daftarJenisCuti
        ]);
    }
}
