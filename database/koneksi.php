<?php

class Koneksi
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "DB_UAS_PBO_TRPL1B_JuanitaWijiMahrani";

    protected $conn;

    public function __construct()
    {
        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->database
        );

        if ($this->conn->connect_error) {
            die("Koneksi gagal : " . $this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
?>