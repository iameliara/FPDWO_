<?php

namespace App\Objects;

use App\Models\RiwayatCuti;
use App\Models\Konfigurasi;
use Illuminate\Support\Facades\Storage;
use TCPDF;

define('NAMA_PERUSAHAAN', 'PT Solusi Informatika Nusantara');
define('ALAMAT_PERUSAHAAN', 'Jl. Kantil 2, Kec. Mojolaban, Kab. Sukoharjo, Jawa Tengah, Indonesia 57554');
define('TELEPON_PERUSAHAAN', '0895-3438-45423');

class SuratIzinCuti extends TCPDF
{
    public $cuti;

    protected $drawX;
    protected $drawY;
    protected $spacing;

    protected $namaPerusahaan;
    protected $alamatPerusahaan;
    protected $teleponPerusahaan;

    protected $gambarLogo;

    protected $namaPejabat;
    protected $jabatanPejabat;

    public function __construct(RiwayatCuti $cuti)
    {
        parent::__construct('P', 'cm', 'A4');

        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor(NAMA_PERUSAHAAN);
        $this->SetTitle('Surat Izin Cuti');
        $this->SetSubject('Atas nama '.$cuti->pegawai->nama);

        $this->setMargins(1, 1, 1);

        $this->cuti = $cuti;

        $this->namaPerusahaan = Konfigurasi::valueOf('identitas.nama');
        $this->alamatPerusahaan = Konfigurasi::valueOf('identitas.alamat');
        $this->teleponPerusahaan = Konfigurasi::valueOf('identitas.telepon');

        $this->gambarLogo = Konfigurasi::valueOf('logo.gambar');

        $this->namaPejabat = Konfigurasi::valueOf('pejabat.nama');
        $this->jabatanPejabat = Konfigurasi::valueOf('pejabat.jabatan');
    }

    public function Header()
    {
        $cellWidth = 12;
        $logoSize = 3;

        $this->drawX = 1;
        $this->drawY = 0.25;
        $this->spacing = 0.1;

        $logoY = $this->drawY;
        $this->Image(Storage::path($this->gambarLogo), $this->drawX, $logoY, $logoSize, $logoSize, '', '', '', true);

        $this->drawX = ($this->getPageWidth() - $cellWidth) / 2;

        $this->setFontSize(18);
        $this->setXY($this->drawX, $this->drawY);
        $this->MultiCell($cellWidth, 0, $this->namaPerusahaan, 0, 'C');
        $this->drawY += $this->getLastH() + $this->spacing;

        $this->setFontSize(10);
        $this->setXY($this->drawX, $this->drawY);
        $this->MultiCell($cellWidth, 0, $this->alamatPerusahaan, 0, 'C');
        $this->drawY += $this->getLastH() + $this->spacing;

        $this->setXY($this->drawX, $this->drawY);
        $this->MultiCell($cellWidth, 0, 'Tel. '.$this->teleponPerusahaan, 0, 'C');
        $this->drawY += $this->getLastH() + $this->spacing;

        $this->spacing = 0.5;
        $this->drawX = 1;
        $this->drawY = max($this->drawY + $this->spacing, $logoY + $logoSize + $this->spacing);

        $this->setFontSize(12);
    }

    public function Footer()
    {
    }

    public function Render()
    {
        $pegawai = $this->cuti->pegawai;

        $this->AddPage();

        $this->Paragraf('Kepada Yth.'.PHP_EOL.$pegawai->nama);
        $this->Paragraf('Kami telah melakukan peninjauan terhadap permohonan cuti yang Bapak/Ibu ajukan dengan keterangan sebagai berikut:', 0, 'L');

        $this->Entri('NIK', $pegawai->nik);
        $this->Entri('Nama', $pegawai->nama);
        $this->Entri('Departemen', $pegawai->departemen->nama);
        $this->Entri('Tanggal Awal Cuti', $this->cuti->tgl_awal_cuti);
        $this->Entri('Tanggal Akhir Cuti', $this->cuti->tgl_akhir_cuti);

        $this->Paragraf('Dengan ini kami telah memutuskan untuk menerima permohonan cuti yang Bapak/Ibu ajukan.');
        $this->Paragraf('Demikian yang bisa kami sampaikan, terima kasih atas perhatiannya.');

        $this->Tertanda('John Doe', 'Kepala Divisi HRD');

        $this->Output('IZINCUTI_'.$this->cuti->id.'.pdf');
    }

    public function Paragraf($teks)
    {
        $this->drawY += $this->spacing;
        $this->setXY($this->drawX, $this->drawY);
        $this->MultiCell(0, 0, $teks, 0, 'L');
        $this->drawY += $this->getLastH() + $this->spacing;
    }

    public function Entri($key, $value)
    {
        $hspace = 10;

        $this->setXY($this->drawX + $this->spacing, $this->drawY);
        $this->MultiCell(($hspace - 1) * $this->spacing, 0, $key, 0, 'L');
        $keyLastH = $this->getLastH();

        $this->setXY($this->drawX + $hspace * $this->spacing, $this->drawY);
        $this->MultiCell(0, 0, ':', 0, 'L');

        $this->setXY($this->drawX + ($hspace + 1) * $this->spacing, $this->drawY);
        $this->MultiCell(0, 0, $value, 0, 'L');
        $valueLastH = $this->getLastH();

        $this->drawY += max($keyLastH, $valueLastH) + 0.5 * $this->spacing;
    }

    public function Tertanda()
    {
        $align = 23;

        $this->drawY += 2 * $this->spacing;

        $this->setXY($this->drawX + $align * $this->spacing, $this->drawY);
        $this->MultiCell(5, 0, 'Tertanda,'.PHP_EOL.$this->jabatanPejabat, 0, 'C');
        $this->drawY += $this->getLastH() + 4 * $this->spacing;

        $this->setXY($this->drawX + $align * $this->spacing, $this->drawY);
        $this->MultiCell(5, 0, $this->namaPejabat, 0, 'C');
        $this->drawY += $this->getLastH() + $this->spacing;
    }
}

