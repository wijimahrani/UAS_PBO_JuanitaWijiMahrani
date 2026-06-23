<?php

require_once 'Karyawan.php';
require_once 'database/koneksi.php';

class KaryawanKontrak extends Karyawan
{
    protected $durasiKontrakBulan;
    protected $agensiPenyalur;

    public function __construct(
        $id_karyawan,
        $nama_karyawan,
        $departemen,
        $hariKerjaMasuk,
        $gajiDasarPerHari,
        $durasiKontrakBulan,
        $agensiPenyalur
    )
    {
        parent::__construct(
            $id_karyawan,
            $nama_karyawan,
            $departemen,
            $hariKerjaMasuk,
            $gajiDasarPerHari
        );

        $this->durasiKontrakBulan = $durasiKontrakBulan;
        $this->agensiPenyalur = $agensiPenyalur;
    }

    public function getKaryawanKontrak()
    {
        $db = new Koneksi();
        $conn = $db->getConnection();

        return $conn->query(
            "SELECT * FROM tabel_karyawan
             WHERE jenis_karyawan='Kontrak'"
        );
    }

    public function hitungGajiBersih()
    {
        return $this->hariKerjaMasuk * $this->gajiDasarPerHari;
    }

    public function tampilkanProfileKaryawan()
    {
        return "Karyawan Kontrak";
    }
}