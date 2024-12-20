<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Departemen;
use App\Models\Pegawai;
use App\Models\JenisCuti;
use App\Models\RiwayatCuti;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $departemen = [];
        $departemen['marketing'] = Departemen::create([
            'nama' => 'Marketing',
            'created_by' => 'seeder'
        ]);
        $departemen['humas'] = Departemen::create([
            'nama' => 'Humas',
            'created_by' => 'seeder'
        ]);

        $pegawai = [];
        $pegawai['alice'] = Pegawai::create([
            'nik' => $this->randomNik(),
            'no_induk' => $this->randomNoInduk(),
            'password' => Hash::make('alice'),
            'nama' => 'Alice',
            'alamat' => 'Rumah Alice',
            'jenis_kelamin' => 'P',
            'id_departemen' => $departemen['humas']->id,
            'created_by' => 'seeder'
        ]);
        $pegawai['bob'] = Pegawai::create([
            'nik' => $this->randomNik(),
            'no_induk' => $this->randomNoInduk(),
            'password' => Hash::make('bob'),
            'nama' => 'Bob',
            'alamat' => 'Rumah Bob',
            'jenis_kelamin' => 'L',
            'id_departemen' => $departemen['marketing']->id,
            'created_by' => 'seeder'
        ]);
        $pegawai['charlie'] = Pegawai::create([
            'nik' => $this->randomNik(),
            'no_induk' => $this->randomNoInduk(),
            'password' => Hash::make('charlie'),
            'nama' => 'Charlie',
            'alamat' => 'Rumah Charlie',
            'jenis_kelamin' => 'L',
            'id_departemen' => $departemen['marketing']->id,
            'created_by' => 'seeder'
        ]);

        $jenisCuti = [];
        $jenisCuti['cuti_tahunan'] = JenisCuti::create([
            'nama' => 'Cuti Tahunan',
            'created_by' => 'seeder'
        ]);
        $jenisCuti['cuti_krn_alasan_penting'] = JenisCuti::create([
            'nama' => 'Cuti Karena Alasan Penting',
            'created_by' => 'seeder'
        ]);
        $jenisCuti['cuti_sakit'] = JenisCuti::create([
            'nama' => 'Cuti Sakit',
            'created_by' => 'seeder'
        ]);
        $jenisCuti['cuti_melahirkan'] = JenisCuti::create([
            'nama' => 'Cuti Melahirkan',
            'created_by' => 'seeder'
        ]);
        $jenisCuti['cuti_besar'] = JenisCuti::create([
            'nama' => 'Cuti Besar',
            'created_by' => 'seeder'
        ]);
        $jenisCuti['cuti_di_luar_tanggungan_perusahaan'] = JenisCuti::create([
            'nama' => 'Cuti Di Luar Tanggungan Perusahaan',
            'created_by' => 'seeder'
        ]);

        RiwayatCuti::create([
            'id_pegawai' => $pegawai['alice']->id,
            'id_jenis_cuti' => $jenisCuti['cuti_tahunan']->id,
            'status_cuti' => 'approved',
            'path_bukti_pengajuan' => '',
            'tgl_awal_cuti' => date('Y-m-d H:i:s', time() - 5 * 86400),
            'tgl_akhir_cuti' => date('Y-m-d H:i:s', time() - 4 * 86400),
            'created_by' => 'pegawai'
        ]);

        RiwayatCuti::create([
            'id_pegawai' => $pegawai['alice']->id,
            'id_jenis_cuti' => $jenisCuti['cuti_krn_alasan_penting']->id,
            'status_cuti' => 'pending',
            'path_bukti_pengajuan' => '',
            'tgl_awal_cuti' => date('Y-m-d H:i:s'),
            'tgl_akhir_cuti' => date('Y-m-d H:i:s', time() + 86400),
            'created_by' => 'pegawai'
        ]);

        RiwayatCuti::create([
            'id_pegawai' => $pegawai['bob']->id,
            'id_jenis_cuti' => $jenisCuti['cuti_krn_alasan_penting']->id,
            'status_cuti' => 'approved',
            'path_bukti_pengajuan' => '',
            'tgl_awal_cuti' => date('Y-m-d H:i:s', time() - 10 * 86400),
            'tgl_akhir_cuti' => date('Y-m-d H:i:s', time() + 3 * 86400),
            'created_by' => 'admin'
        ]);

        Admin::create([
            'email' => 'root@localhost.localdomain',
            'password' => Hash::make('root'),
            'nama' => 'Superuser'
        ]);

        $this->call([ConfigSeeder::class]);
    }

    protected function randomNik()
    {
        return random_int(1000000000000000, 9000000000000000);
    }

    protected function randomNoInduk()
    {
        return random_int(10000000, 90000000);
    }
}
