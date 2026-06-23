<?php

require_once 'Karyawan.php';
require_once 'database/koneksi.php';

class KaryawanTetap extends Karyawan
{
    protected $tunjanganKesehatan;
    protected $opsiSahamId;

    public function __construct(
        $id_karyawan,
        $nama_karyawan,
        $departemen,
        $hariKerjaMasuk,
        $gajiDasarPerHari,
        $tunjanganKesehatan,
        $opsiSahamId
    ) {
        parent::__construct(
            $id_karyawan,
            $nama_karyawan,
            $departemen,
            $hariKerjaMasuk,
            $gajiDasarPerHari
        );

        $this->tunjanganKesehatan = $tunjanganKesehatan;
        $this->opsiSahamId = $opsiSahamId;
    }

    // Method baru (Tahap 4)
    public function getKaryawanTetap()
    {
        $db = new Koneksi();
        $conn = $db->getConnection();

        $sql = "SELECT *
                FROM tabel_karyawan
                WHERE jenis_karyawan = 'Tetap'";

        return $conn->query($sql);
    }

    // Polymorphism (Tahap 5)
    public function hitungGajiBersih()
    {
        return ($this->hariKerjaMasuk * $this->gajiDasarPerHari)
                + $this->tunjanganKesehatan;
    }

    // Implementasi abstract method
    public function tampilkanProfileKaryawan()
    {
        return [
            'ID' => $this->id_karyawan,
            'Nama' => $this->nama_karyawan,
            'Departemen' => $this->departemen,
            'Hari Kerja' => $this->hariKerjaMasuk,
            'Gaji Dasar' => $this->gajiDasarPerHari,
            'Tunjangan Kesehatan' => $this->tunjanganKesehatan,
            'Opsi Saham' => $this->opsiSahamId
        ];
    }
}
?>