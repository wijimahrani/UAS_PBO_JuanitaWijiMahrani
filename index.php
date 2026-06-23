<?php
require_once 'database/koneksi.php';
require_once 'classes/Karyawan.php';
require_once 'classes/KaryawanKontrak.php';
require_once 'classes/KaryawanTetap.php';
require_once 'classes/KaryawanMagang.php';

$query = mysqli_query($conn, "SELECT * FROM tabel_karyawan ORDER BY jenis_karyawan");

$daftarKaryawan = [];

while ($data = mysqli_fetch_assoc($query)) {
    switch ($data['jenis_karyawan']) {
        case 'Kontrak':
            $obj = new KaryawanKontrak(
                $data['id_karyawan'],
                $data['nama_karyawan'],
                $data['departemen'],
                $data['hari_kerja_masuk'],
                $data['gaji_dasar_per_hari'],
                $data['durasi_kontrak_bulan'],
                $data['agensi_penyalur']
            );
            break;
        case 'Tetap':
            $obj = new KaryawanTetap(
                $data['id_karyawan'],
                $data['nama_karyawan'],
                $data['departemen'],
                $data['hari_kerja_masuk'],
                $data['gaji_dasar_per_hari'],
                $data['tunjangan_kesehatan'],
                $data['opsi_saham_id']
            );
            break;
        case 'Magang':
            $obj = new KaryawanMagang(
                $data['id_karyawan'],
                $data['nama_karyawan'],
                $data['departemen'],
                $data['hari_kerja_masuk'],
                $data['gaji_dasar_per_hari'],
                $data['uang_saku_bulanan'],
                $data['sertifikat_kampus_merdeka']
            );
            break;
    }
    $daftarKaryawan[] = [
        'objek' => $obj,
        'data' => $data
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji Karyawan - HRIS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background: #e8f0e8;
            min-height: 100vh;
            padding: 30px;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .container {
            max-width: 1300px;
            margin: 0 auto;
            background: #f5f8f5;
            border-radius: 8px;
            padding: 35px;
            box-shadow: 0 4px 20px rgba(30, 60, 30, 0.15);
            border: 1px solid #c8dcc8;
        }

        /* Header Section */
        .header {
            text-align: center;
            padding: 25px 0 30px;
            border-bottom: 3px double #2d5a2d;
            margin-bottom: 35px;
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 2px;
            background: #4a7a4a;
        }

        .header h1 {
            font-size: 30px;
            color: #1e3a1e;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-family: 'Georgia', serif;
        }

        .header .subtitle {
            color: #4a6a4a;
            font-size: 15px;
            margin-top: 8px;
            letter-spacing: 2px;
            font-style: italic;
        }

        .header .period {
            display: inline-block;
            background: #2d5a2d;
            color: #f0f7f0;
            padding: 4px 25px;
            font-size: 13px;
            letter-spacing: 1px;
            margin-top: 12px;
            font-family: 'Georgia', serif;
        }

        /* Section Cards */
        .section {
            margin-bottom: 40px;
            background: #fafffa;
            border-radius: 6px;
            padding: 20px;
            border: 1px solid #d4e6d4;
            transition: border-color 0.3s;
        }

        .section:hover {
            border-color: #8aaa8a;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding: 12px 20px;
            background: #eef5ee;
            border-left: 4px solid #2d5a2d;
            border-radius: 4px;
        }

        .section-title .number {
            font-size: 20px;
            font-weight: 700;
            color: #2d5a2d;
            font-family: 'Georgia', serif;
            margin-right: 5px;
        }

        .section-title h2 {
            color: #1e3a1e;
            font-size: 20px;
            font-weight: 600;
            font-family: 'Georgia', serif;
            letter-spacing: 1px;
        }

        .section-title .count {
            margin-left: auto;
            background: #2d5a2d;
            color: #f0f7f0;
            padding: 2px 16px;
            font-size: 13px;
            font-family: 'Georgia', serif;
            letter-spacing: 0.5px;
        }

        /* Table Styles */
        .table-wrapper {
            overflow-x: auto;
            border-radius: 4px;
            border: 1px solid #d4e6d4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            font-family: 'Georgia', serif;
        }

        thead {
            background: #2d5a2d;
            color: #f0f7f0;
        }

        th {
            padding: 14px 12px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
            text-align: left;
            border-right: 1px solid #3a6a3a;
        }

        th:last-child {
            border-right: none;
        }

        td {
            padding: 13px 12px;
            font-size: 14px;
            border-bottom: 1px solid #e8f0e8;
            color: #1e3a1e;
        }

        tbody tr {
            transition: background 0.2s;
        }

        tbody tr:hover {
            background: #f0f8f0;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Status Badges */
        .badge-status {
            display: inline-block;
            padding: 3px 14px;
            font-size: 12px;
            letter-spacing: 0.5px;
            font-family: 'Georgia', serif;
            border-radius: 2px;
        }

        .badge-kontrak {
            background: #f5f0e0;
            color: #6a5a2d;
            border: 1px solid #d4c8a0;
        }

        .badge-tetap {
            background: #e0f0e0;
            color: #1e4a1e;
            border: 1px solid #a0c8a0;
        }

        .badge-magang {
            background: #e8ecf0;
            color: #2d4a5a;
            border: 1px solid #a0b8c8;
        }

        .gaji-amount {
            font-weight: 700;
            color: #1e4a1e;
            font-family: 'Georgia', serif;
        }

        .text-right {
            text-align: right;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #6a8a6a;
            font-style: italic;
            letter-spacing: 0.5px;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            color: #4a6a4a;
            font-size: 12px;
            border-top: 1px solid #d4e6d4;
            margin-top: 20px;
            letter-spacing: 0.5px;
            font-family: 'Georgia', serif;
        }

        .footer span {
            margin: 0 10px;
            color: #8aaa8a;
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }
            .container {
                box-shadow: none;
                border-radius: 0;
                padding: 20px;
                border: none;
            }
            .section:hover {
                border-color: #d4e6d4;
            }
            .section-title {
                background: #eef5ee;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            thead {
                background: #2d5a2d !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .badge-status {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }
            .container {
                padding: 15px;
            }
            .header h1 {
                font-size: 22px;
                letter-spacing: 1px;
            }
            .header .subtitle {
                font-size: 13px;
            }
            th, td {
                padding: 10px 8px;
                font-size: 12px;
            }
            .section-title h2 {
                font-size: 17px;
            }
            .section-title .number {
                font-size: 17px;
            }
            .badge-status {
                font-size: 11px;
                padding: 2px 10px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }
            .header h1 {
                font-size: 18px;
            }
            .section {
                padding: 12px;
            }
            .section-title {
                padding: 10px 12px;
                flex-wrap: wrap;
            }
            .section-title .count {
                margin-left: 0;
                margin-top: 5px;
            }
            th, td {
                padding: 8px 6px;
                font-size: 11px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Slip Gaji Karyawan</h1>
            <div class="subtitle">Human Resource Information System</div>
            <div class="period">Periode <?= date('F Y'); ?></div>
        </div>

        <!-- Karyawan Kontrak -->
        <div class="section">
            <div class="section-title">
                <span class="number">I.</span>
                <h2>Karyawan Kontrak</h2>
                <span class="count">
                    <?= count(array_filter($daftarKaryawan, function($k) { return $k['data']['jenis_karyawan'] == 'Kontrak'; })); ?>
                    Karyawan
                </span>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 12%;">ID</th>
                            <th style="width: 20%;">Nama Karyawan</th>
                            <th style="width: 18%;">Departemen</th>
                            <th style="width: 18%;">Durasi Kontrak</th>
                            <th style="width: 20%;">Agensi Penyalur</th>
                            <th style="width: 12%; text-align: right;">Gaji Bersih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $hasKontrak = false;
                        foreach($daftarKaryawan as $k):
                            if($k['data']['jenis_karyawan'] == 'Kontrak'):
                                $hasKontrak = true;
                        ?>
                        <tr>
                            <td><strong><?= $k['data']['id_karyawan']; ?></strong></td>
                            <td><?= $k['data']['nama_karyawan']; ?></td>
                            <td><?= $k['data']['departemen']; ?></td>
                            <td><span class="badge-status badge-kontrak"><?= $k['data']['durasi_kontrak_bulan']; ?> Bulan</span></td>
                            <td><?= $k['data']['agensi_penyalur']; ?></td>
                            <td class="text-right gaji-amount">Rp <?= number_format($k['objek']->hitungGajiBersih(),0,',','.'); ?></td>
                        </tr>
                        <?php
                            endif;
                        endforeach;
                        if(!$hasKontrak):
                        ?>
                        <tr>
                            <td colspan="6" class="empty-state">Belum terdapat data karyawan kontrak</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Karyawan Tetap -->
        <div class="section">
            <div class="section-title">
                <span class="number">II.</span>
                <h2>Karyawan Tetap</h2>
                <span class="count">
                    <?= count(array_filter($daftarKaryawan, function($k) { return $k['data']['jenis_karyawan'] == 'Tetap'; })); ?>
                    Karyawan
                </span>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 12%;">ID</th>
                            <th style="width: 20%;">Nama Karyawan</th>
                            <th style="width: 18%;">Departemen</th>
                            <th style="width: 18%;">Tunjangan Kesehatan</th>
                            <th style="width: 20%;">Opsi Saham</th>
                            <th style="width: 12%; text-align: right;">Gaji Bersih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $hasTetap = false;
                        foreach($daftarKaryawan as $k):
                            if($k['data']['jenis_karyawan'] == 'Tetap'):
                                $hasTetap = true;
                        ?>
                        <tr>
                            <td><strong><?= $k['data']['id_karyawan']; ?></strong></td>
                            <td><?= $k['data']['nama_karyawan']; ?></td>
                            <td><?= $k['data']['departemen']; ?></td>
                            <td><span class="badge-status badge-tetap">Rp <?= number_format($k['data']['tunjangan_kesehatan'],0,',','.'); ?></span></td>
                            <td><?= $k['data']['opsi_saham_id']; ?></td>
                            <td class="text-right gaji-amount">Rp <?= number_format($k['objek']->hitungGajiBersih(),0,',','.'); ?></td>
                        </tr>
                        <?php
                            endif;
                        endforeach;
                        if(!$hasTetap):
                        ?>
                        <tr>
                            <td colspan="6" class="empty-state">Belum terdapat data karyawan tetap</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Karyawan Magang -->
        <div class="section">
            <div class="section-title">
                <span class="number">III.</span>
                <h2>Karyawan Magang</h2>
                <span class="count">
                    <?= count(array_filter($daftarKaryawan, function($k) { return $k['data']['jenis_karyawan'] == 'Magang'; })); ?>
                    Karyawan
                </span>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 12%;">ID</th>
                            <th style="width: 20%;">Nama Karyawan</th>
                            <th style="width: 18%;">Departemen</th>
                            <th style="width: 18%;">Uang Saku Bulanan</th>
                            <th style="width: 20%;">Sertifikat KM</th>
                            <th style="width: 12%; text-align: right;">Gaji Bersih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $hasMagang = false;
                        foreach($daftarKaryawan as $k):
                            if($k['data']['jenis_karyawan'] == 'Magang'):
                                $hasMagang = true;
                        ?>
                        <tr>
                            <td><strong><?= $k['data']['id_karyawan']; ?></strong></td>
                            <td><?= $k['data']['nama_karyawan']; ?></td>
                            <td><?= $k['data']['departemen']; ?></td>
                            <td><span class="badge-status badge-magang">Rp <?= number_format($k['data']['uang_saku_bulanan'],0,',','.'); ?></span></td>
                            <td><?= $k['data']['sertifikat_kampus_merdeka'] ? 'Tersedia' : 'Belum Tersedia'; ?></td>
                            <td class="text-right gaji-amount">Rp <?= number_format($k['objek']->hitungGajiBersih(),0,',','.'); ?></td>
                        </tr>
                        <?php
                            endif;
                        endforeach;
                        if(!$hasMagang):
                        ?>
                        <tr>
                            <td colspan="6" class="empty-state">Belum terdapat data karyawan magang</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <span>&#9679;</span> Sistem Informasi Sumber Daya Manusia <span>&#9679;</span>
            <br>
            &copy; <?= date('Y'); ?> PT. Perusahaan Sejahtera <span>&#9679;</span>
            Data terakhir diperbaharui: <?= date('d/m/Y H:i:s'); ?>
        </div>
    </div>
</body>
</html>