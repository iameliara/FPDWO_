<?php

namespace App\Http\Controllers\Admin\Cuti;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\JenisCuti;
use App\Models\RiwayatCuti;
use Illuminate\Http\Request;

class BuatController extends Controller
{
    public function buatCutiHTML()
    {
        //$pegawai = Pegawai::where('id', Auth::guard('pegawai')->id())->first();
        //$departemen = Departemen::where('id', Auth::guard('pegawai')->user()->id_departemen)->first();
        $jenis_cuti = JenisCuti::all();
        // Auth::guard('pegawai')->user()->bisaCuti('tanggal_awl_cuti');
        
        return view('admin.cuti.buat', compact('jenis_cuti'));
    }

    public function buatCutiDB(Request $request)
    {
        $this->validate($request, [
            'nik' => 'required',
            'tgl_awal_cuti' => 'required',
            'tgl_akhir_cuti' => 'required',
            'id_jenis_cuti' => 'required|integer',
        ]);

        $pegawai = Pegawai::where('nik', $request->nik)->first();

        if ($pegawai->bisaCuti($request->tgl_awal_cuti)){
            $ajukan = RiwayatCuti::create([
                'id_pegawai' => $pegawai->id,       
                'tgl_awal_cuti' => $request->tgl_awal_cuti,
                'tgl_akhir_cuti' => $request->tgl_akhir_cuti,
                'id_jenis_cuti' => $request->id_jenis_cuti,
                'status_cuti' => 'pending',
                'path_bukti_pengajuan' => ''
            ]);
            $ajukan->simpanBuktiPengajuan($request, 'surat-pengajuan');

            return redirect()
                ->route('admin.cuti.list')
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
}
