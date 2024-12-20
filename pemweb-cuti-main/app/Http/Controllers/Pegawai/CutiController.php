<?php

// Penanggung jawab : Odi

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    RiwayatCuti,
    JenisCuti,
    Pegawai,
    Departemen
};
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    public function ajukanCutiHTML(Request $request)
    {
        $pegawai = Pegawai::where('id', Auth::guard('pegawai')->id())->first();
        $departemen = Departemen::where('id', Auth::guard('pegawai')->user()->id_departemen)->first();
        $jenis_cuti = JenisCuti::all();
        // Auth::guard('pegawai')->user()->bisaCuti('tanggal_awl_cuti');
        
        return view('pegawai.cuti.ajukan', compact('pegawai', 'jenis_cuti', 'departemen'));
    }

    public function ajukanCutiDB(Request $request){
        $this->validate($request, [
            'tgl_awal_cuti' => 'required',
            'tgl_akhir_cuti' => 'required',
            'id_jenis_cuti' => 'required|integer',
        ]);

        if (Auth::guard('pegawai')->user()->bisaCuti($request->tgl_awal_cuti)){
            $ajukan = RiwayatCuti::create([
                'id_pegawai' => Auth::guard('pegawai')->id(),       
                'tgl_awal_cuti' => $request->tgl_awal_cuti,
                'tgl_akhir_cuti' => $request->tgl_akhir_cuti,
                'id_jenis_cuti' => $request->id_jenis_cuti,
                'status_cuti' => 'pending',
                'path_bukti_pengajuan' => ''
            ]);
            $ajukan->simpanBuktiPengajuan($request, 'surat-pengajuan');

            return redirect()
                ->route('pegawai.cuti.ajukan')
                ->with([
                    'status' => 'Cuti berhasil diajukan! Cek status pengajuan Anda secara berkala!'
                ]);
        }
        else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'error' => 'Pengajuan cuti gagal! Coba lagi!'
                ]);
        }
    
    }

    public function riwayatCutiHTML(Request $request)
    {
        $riwayat_cuti = RiwayatCuti::where('id_pegawai', Auth::guard('pegawai')->id())->orderBy('created_at', 'desc')->get();
        return view('pegawai.cuti.riwayat', compact('riwayat_cuti'));
    }

    public function statusCutiHTML(RiwayatCuti $cuti)
    {
        $pegawai = Pegawai::where('id', Auth::guard('pegawai')->id())->first();
        $riwayat_cuti = RiwayatCuti::where('id_pegawai', Auth::guard('pegawai')->id())->first();
        $departemen = Departemen::where('id', Auth::guard('pegawai')->user()->id_departemen)->first();



        $warna['pending'] = 'bg-warning';
        $warna['rejected'] = 'bg-danger';
        $warna['approved'] = 'bg-success';

        return view('pegawai.cuti.status', compact('cuti', 'warna', 'pegawai', 'riwayat_cuti', 'departemen'));
    }

    public function statusCutiBuktiPengajuanPDF(RiwayatCuti $cuti)
    {
        return $cuti->bacaBuktiPengajuan();
    }

    public function statusCutiSuratizinPDF(RiwayatCuti $cuti)
    {
        return $cuti->bacaSuratIzin();
    }
}
