<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Konfigurasi;
use App\Models\KonfigurasiCuti;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Konfigurasi::create(['code' => 'identitas.nama', 'value' => 'PT Rifan Financindo Berjangka']);
        Konfigurasi::create(['code' => 'identitas.alamat', 'value' => 'AXA Tower Kuningan City Lt. 30, Jl. Prof. DR. Satrio Kav.18, Kuningan Setia Budi, Jakarta 12940']);
        Konfigurasi::create(['code' => 'identitas.telepon', 'value' => '(021) 3005 6300']);

        Konfigurasi::create(['code' => 'logo.gambar', 'value' => '']);

        Konfigurasi::create(['code' => 'pejabat.nama', 'value' => 'Abdul Azis Ikhwani']);
        Konfigurasi::create(['code' => 'pejabat.jabatan', 'value' => 'Direktur HRD']);
    }
}
