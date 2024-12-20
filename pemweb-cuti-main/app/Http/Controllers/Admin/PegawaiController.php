<?php

// Penanggung jawab : Galih

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\{Pegawai, RiwayatCuti, Departemen};

class PegawaiController extends Controller
{
    public function tambahPegawaiHTML(Request $request)
    {
        
        $departemen = Departemen::get();
        return view('admin.pegawai.tambah',compact('departemen'));
    }

    public function tambahPegawaiDB(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'no_induk' => 'required',
            'jenis_kelamin' => 'required',
            'departemen' => 'required',
            'alamat' => 'required',
            'password' => 'required'
        ]);

        $pegawai = Pegawai::create([
            'nama' => $request['nama'],
            'nik' => $request['nik'],
            'no_induk' => $request['no_induk'],
            'jenis_kelamin'=> $request['jenis_kelamin'],
            'id_departemen'=> $request['departemen'],
            'alamat'=> $request['alamat'],
            'password' => Hash::make($request['password'])
        ]);

        
        return redirect()->route('admin.pegawai.list')->with('status', 'Berhasil Menambah Pegawai!');
    }

    public function listPegawaiHTML(Request $request)
    {
        $pegawai = Pegawai::get();
        $departemen = Departemen::get();
        return view('admin.pegawai.list', compact('pegawai', 'departemen'));
    }

    public function editPegawaiHTML(Request $request, Pegawai $pegawai)
    {
        
        return view('admin.pegawai.edit');
        
    }

    public function editPegawaiDB(Request $request, Pegawai $pegawai, Departemen $departemen)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'no_induk' => 'required',
            'jenis_kelamin' => 'required',
            'departemen' => 'required',
            'alamat' => 'required',
        ]);
        
        
        $pegawai->nama = $request['nama'];
        $pegawai->nik =  $request['nik'];
        $pegawai->no_induk =  $request['no_induk'];
        $pegawai->jenis_kelamin =  $request['jenis_kelamin'];
        $pegawai->id_departemen =  $request['departemen'];
        $pegawai->alamat =  $request['alamat'];
        if ($request['password'] !== '') {
            $pegawai->password = Hash::make($request['password']);
        }
        $pegawai->save();
        
        return redirect()->route('admin.pegawai.list')->with('status', 'Data Berhasil Diperbarui!');
    }

    public function hapusPegawaiDB(Request $request, Pegawai $pegawai, RiwayatCuti $riwayat_cuti)
    {
        RiwayatCuti::where('id_pegawai', $pegawai->id)->delete();
        $pegawai->delete();

        return redirect()->route('admin.pegawai.list')->with('status', 'Data Berhasil Dihapus!');
    }
}
