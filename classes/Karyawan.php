<?php

abstract class Karyawan
{
    // Properti terenkripsi (protected)
    protected $id_karyawan;
    protected $nama_karyawan;
    protected $departemen;
    protected $hariKerjaMasuk;
    protected $gajiDasarPerHari;

    // Constructor
    public function __construct(
        $id_karyawan,
        $nama_karyawan,
        $departemen,
        $hariKerjaMasuk,
        $gajiDasarPerHari
    ) {
        $this->id_karyawan = $id_karyawan;
        $this->nama_karyawan = $nama_karyawan;
        $this->departemen = $departemen;
        $this->hariKerjaMasuk = $hariKerjaMasuk;
        $this->gajiDasarPerHari = $gajiDasarPerHari;
    }

    // Getter
    public function getIdKaryawan()
    {
        return $this->id_karyawan;
    }

    public function getNamaKaryawan()
    {
        return $this->nama_karyawan;
    }

    public function getDepartemen()
    {
        return $this->departemen;
    }

    public function getHariKerjaMasuk()
    {
        return $this->hariKerjaMasuk;
    }

    public function getGajiDasarPerHari()
    {
        return $this->gajiDasarPerHari;
    }

    // Method abstrak
    abstract public function hitungGajiBersih();

    abstract public function tampilkanProfileKaryawan();
}
?>