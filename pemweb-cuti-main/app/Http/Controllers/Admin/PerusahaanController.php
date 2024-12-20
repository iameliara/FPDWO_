<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konfigurasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerusahaanController extends Controller
{
    public function identitasPerusahaanHTML()
    {
        $identitas = [];
        $identitas['nama'] = Konfigurasi::valueOf('identitas.nama');
        $identitas['alamat'] = Konfigurasi::valueOf('identitas.alamat');
        $identitas['telepon'] = Konfigurasi::valueOf('identitas.telepon');

        return view('admin.perusahaan.identitas', ['identitas' => $identitas]);
    }

    public function identitasPerusahaanDB(Request $request)
    {
        Konfigurasi::valueOf('identitas.nama', $request->input('nama'));
        Konfigurasi::valueOf('identitas.alamat', $request->input('alamat'));
        Konfigurasi::valueOf('identitas.telepon', $request->input('telepon'));

        return redirect()->route('admin.perusahaan.identitas')->with('status', 'Berhasil memperbarui identitas perusahaan');
    }

    public function logoPerusahaanHTML()
    {
        $logo = [];
        $logo['gambar'] = Konfigurasi::valueOf('logo.gambar');
        $logo['ada'] = Storage::exists($logo['gambar']);

        return view('admin.perusahaan.logo', ['logo' => $logo]);
    }

    public function logoPerusahaanDB(Request $request)
    {
        $path = $request->file('logo')->store('logo_perusahaan');
        Konfigurasi::valueOf('logo.gambar', $path);

        return redirect()->route('admin.perusahaan.logo');
    }

    public function logoPerusahaanIMG()
    {
        return response()->file(Storage::path(Konfigurasi::valueOf('logo.gambar')));
    }

    public function pejabatPerusahaanHTML()
    {
        $pejabat = [];
        $pejabat['nama'] = Konfigurasi::valueOf('pejabat.nama');
        $pejabat['jabatan'] = Konfigurasi::valueOf('pejabat.jabatan');

        return view('admin.perusahaan.pejabat', ['pejabat' => $pejabat]);
    }

    public function pejabatPerusahaanDB(Request $request)
    {
        Konfigurasi::valueOf('pejabat.nama', $request->input('nama'));
        Konfigurasi::valueOf('pejabat.jabatan', $request->input('jabatan'));

        return redirect()->route('admin.perusahaan.pejabat')->with('status', 'Berhasil memperbarui pejabat perusahaan');
    }
}
