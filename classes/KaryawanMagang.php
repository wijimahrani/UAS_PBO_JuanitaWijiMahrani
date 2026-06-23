<?php

require_once 'Karyawan.php';

class KaryawanMagang extends Karyawan
{
    protected $uangSakuBulanan;
    protected $sertifikatKampusMerdeka;

    public function __construct(
        $id_karyawan,
        $nama_karyawan,
        $departemen,
        $hariKerjaMasuk,
        $gajiDasarPerHari,
        $uangSakuBulanan,
        $sertifikatKampusMerdeka
    ) {
        parent::__construct(
            $id_karyawan,
            $nama_karyawan,
            $departemen,
            $hariKerjaMasuk,
            $gajiDasarPerHari
        );

        $this->uangSakuBulanan = $uangSakuBulanan;
        $this->sertifikatKampusMerdeka = $sertifikatKampusMerdeka;
    }

    public function hitungGajiBersih()
    {
        return ($this->hariKerjaMasuk * $this->gajiDasarPerHari)
                + $this->uangSakuBulanan;
    }

    public function tampilkanProfileKaryawan()
    {
        return "Karyawan Magang";
    }
}
?>