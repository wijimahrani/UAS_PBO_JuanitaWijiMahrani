<?php

require_once 'Karyawan.php';
require_once '../database/Koneksi.php';

class KaryawanKontrak extends Karyawan
{
    protected $durasiKontrakBulan;
    protected $agensiPenyalur;

    public static function getDataKontrak()
    {
        $db = new Koneksi();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM tabel_karyawan
                WHERE jenis_karyawan='Kontrak'";

        return $conn->query($sql);
    }

    public function __construct($data)
    {
        parent::__construct(
            $data['id_karyawan'],
            $data['nama_karyawan'],
            $data['departemen'],
            $data['hari_kerja_masuk'],
            $data['gaji_dasar_per_hari']
        );

        $this->durasiKontrakBulan =
            $data['durasi_kontrak_bulan'];

        $this->agensiPenyalur =
            $data['agensi_penyalur'];
    }

    public function hitungGajiBersih()
    {
        return $this->hariKerjaMasuk *
               $this->gajiDasarPerHari;
    }

    public function tampilkanProfileKaryawan()
    {
        return "Karyawan Kontrak";
    }
}
?>