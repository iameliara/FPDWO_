<?php

// Penanggung jawab : Miko

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RiwayatCuti;
use App\Models\JenisCuti;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexHTML(Request $request)
    {
        $statistik = [];
        $statistik['pending'] = RiwayatCuti::where(['status_cuti' => 'pending'])->count();
        $statistik['approved'] = RiwayatCuti::where(['status_cuti' => 'approved'])->count();
        $statistik['rejected'] = RiwayatCuti::where(['status_cuti' => 'rejected'])->count();

        $daftarJenisCuti = JenisCuti::all();
        foreach ($daftarJenisCuti as &$jenisCuti)
        {
            $jenisCuti->jumlah = RiwayatCuti::where(['id_jenis_cuti' => $jenisCuti->id])->count();
        }

        return view('admin.dashboard', [
            'statistik' => $statistik,
            'daftarJenisCuti' => $daftarJenisCuti
        ]);
    }
}
