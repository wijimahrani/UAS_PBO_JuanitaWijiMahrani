<?php

require_once 'Karyawan.php';

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

    public function hitungGajiBersih()
    {
        return ($this->hariKerjaMasuk * $this->gajiDasarPerHari)
                + $this->tunjanganKesehatan;
    }

    public function tampilkanProfileKaryawan()
    {
        return "Karyawan Tetap";
    }
}
?>