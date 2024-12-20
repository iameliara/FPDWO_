<?php

// Penanggung jawab : Fajar

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    RiwayatCuti,
    JenisCuti,
    Pegawai,
    Departemen
};

class CutiController extends Controller
{
    public function buatCutiHTML(Request $request)
    {
        return view('admin.cuti.buat');
    }

    public function listCutiHTML(Request $request)
    {
        $riwayat_cuti = RiwayatCuti::with('pegawai', 'jenisCuti')->get();


        $warna['pending'] = 'bg-warning';
        $warna['rejected'] = 'bg-danger';
        $warna['approved'] = 'bg-success';

        return view('admin.cuti.list', compact('riwayat_cuti', 'warna'));
    }

    public function detailCutiHTML(Request $request, RiwayatCuti $cuti)
    {
        $riwayat_cuti = $cuti;
        $pegawai = $cuti->pegawai;

        $warna['pending'] = 'bg-warning';
        $warna['rejected'] = 'bg-danger';
        $warna['approved'] = 'bg-success';

        return view('admin.cuti.detail', compact('riwayat_cuti', 'pegawai', 'warna'));
    }

    public function statusCutiBuktiPengajuanPDF(RiwayatCuti $cuti)
    {
        return $cuti->bacaBuktiPengajuan();
    }

    public function statusCutiSuratizinPDF(RiwayatCuti $cuti)
    {
        return $cuti->bacaSuratIzin();
    }

    public function approveCutiDB(Request $request, RiwayatCuti $cuti){
        $cuti->status_cuti = 'approved';
        $cuti->save();

        return redirect()
            ->route('admin.cuti.detail', ['cuti' => $cuti->id])
            ->with([
                'status' => 'Cuti Approved!'
            ]);
    }

    public function rejectCutiDB(Request $request, RiwayatCuti $cuti){
        $cuti->status_cuti = 'rejected';
        $cuti->save();

        return redirect()
            ->route('admin.cuti.detail', ['cuti' => $cuti->id])
            ->with([
                'status' => 'Cuti Rejected!'
            ]);
    }
}
