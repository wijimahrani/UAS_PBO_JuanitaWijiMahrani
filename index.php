<?php
require_once 'database/koneksi.php';
require_once 'classes/Karyawan.php';
require_once 'classes/KaryawanKontrak.php';
require_once 'classes/KaryawanTetap.php';
require_once 'classes/KaryawanMagang.php';

// Buat objek untuk masing-masing jenis karyawan
$kontrak = new KaryawanKontrak(0, '', '', 0, 0, 0, '');
$tetap = new KaryawanTetap(0, '', '', 0, 0, 0, '');
$magang = new KaryawanMagang(0, '', '', 0, 0, 0, '');

// Ambil data dari database menggunakan method di masing-masing class
$dataKontrak = $kontrak->getKaryawanKontrak();
$dataTetap = $tetap->getKaryawanTetap();
$dataMagang = $magang->getKaryawanMagang();
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
            font-family: 'Segoe UI', 'Georgia', serif;
            background: #e8f0e8;
            min-height: 100vh;
            padding: 30px;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        .container {
            max-width: 1300px;
            margin: 0 auto;
            background: #f5f8f5;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 5px 25px rgba(30, 60, 30, 0.15);
            border: 1px solid #c8dcc8;
        }

        /* Header */
        .header {
            text-align: center;
            padding: 30px 0 35px;
            border-bottom: 3px double #2d5a2d;
            margin-bottom: 40px;
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 2px;
            background: linear-gradient(to right, transparent, #4a7a4a, transparent);
        }

        .header .logo {
            font-size: 42px;
            font-weight: 700;
            color: #1e3a1e;
            letter-spacing: 4px;
            text-transform: uppercase;
            font-family: 'Georgia', serif;
        }

        .header .logo small {
            font-size: 16px;
            font-weight: normal;
            letter-spacing: 2px;
            color: #4a6a4a;
            display: block;
            margin-top: 5px;
        }

        .header .subtitle {
            color: #4a6a4a;
            font-size: 15px;
            margin-top: 10px;
            letter-spacing: 2px;
            font-style: italic;
        }

        .header .period {
            display: inline-block;
            background: #2d5a2d;
            color: #f0f7f0;
            padding: 5px 30px;
            font-size: 14px;
            letter-spacing: 1px;
            margin-top: 15px;
            font-family: 'Georgia', serif;
            border-radius: 3px;
        }

        /* Section */
        .section {
            margin-bottom: 45px;
            background: #fafffa;
            border-radius: 8px;
            padding: 25px;
            border: 1px solid #d4e6d4;
            transition: all 0.3s ease;
        }

        .section:hover {
            border-color: #8aaa8a;
            box-shadow: 0 2px 15px rgba(45, 90, 45, 0.08);
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            padding: 15px 25px;
            background: linear-gradient(to right, #eef5ee, #f5f8f5);
            border-left: 5px solid #2d5a2d;
            border-radius: 4px;
        }

        .section-title .number {
            font-size: 22px;
            font-weight: 700;
            color: #2d5a2d;
            font-family: 'Georgia', serif;
        }

        .section-title h2 {
            color: #1e3a1e;
            font-size: 22px;
            font-weight: 600;
            font-family: 'Georgia', serif;
            letter-spacing: 1px;
        }

        .section-title .count {
            margin-left: auto;
            background: #2d5a2d;
            color: #f0f7f0;
            padding: 3px 20px;
            font-size: 14px;
            font-family: 'Georgia', serif;
            letter-spacing: 0.5px;
            border-radius: 3px;
        }

        /* Table */
        .table-wrapper {
            overflow-x: auto;
            border-radius: 6px;
            border: 1px solid #d4e6d4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            font-family: 'Segoe UI', 'Georgia', serif;
        }

        thead {
            background: #2d5a2d;
            color: #f0f7f0;
        }

        th {
            padding: 16px 14px;
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
            padding: 14px 14px;
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

        tbody tr:nth-child(even) {
            background: #fafcfa;
        }

        tbody tr:nth-child(even):hover {
            background: #f0f8f0;
        }

        /* Badges */
        .badge-status {
            display: inline-block;
            padding: 4px 16px;
            font-size: 12px;
            letter-spacing: 0.5px;
            font-family: 'Georgia', serif;
            border-radius: 3px;
            font-weight: 600;
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
            font-size: 15px;
        }

        .text-right {
            text-align: right;
        }

        .id-column {
            font-weight: 600;
            color: #2d5a2d;
            font-family: 'Georgia', serif;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px;
            color: #6a8a6a;
            font-style: italic;
            letter-spacing: 0.5px;
            font-size: 15px;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 25px;
            color: #4a6a4a;
            font-size: 13px;
            border-top: 1px solid #d4e6d4;
            margin-top: 25px;
            letter-spacing: 0.5px;
            font-family: 'Georgia', serif;
        }

        .footer .divider {
            margin: 0 15px;
            color: #8aaa8a;
        }

        .footer .company {
            color: #1e3a1e;
            font-weight: 600;
        }

        /* Print */
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
            .section {
                break-inside: avoid;
                page-break-inside: avoid;
            }
            .section:hover {
                border-color: #d4e6d4;
                box-shadow: none;
            }
            .section-title {
                background: #eef5ee !important;
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
            tbody tr:nth-child(even) {
                background: #fafcfa !important;
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
            .header .logo {
                font-size: 28px;
            }
            .header .subtitle {
                font-size: 13px;
            }
            th, td {
                padding: 10px 8px;
                font-size: 12px;
            }
            .section-title h2 {
                font-size: 18px;
            }
            .section-title .number {
                font-size: 18px;
            }
            .badge-status {
                font-size: 11px;
                padding: 2px 10px;
            }
            .gaji-amount {
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }
            .header .logo {
                font-size: 22px;
                letter-spacing: 1px;
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
            <div class="logo">
                Slip Gaji Karyawan
                <small>Human Resource Information System</small>
            </div>
            <div class="subtitle">Laporan Penggajian Periode</div>
            <div class="period"><?= strtoupper(date('F Y')); ?></div>
        </div>

        <!-- Karyawan Kontrak -->
        <div class="section">
            <div class="section-title">
                <span class="number">I.</span>
                <h2>Karyawan Kontrak</h2>
                <span class="count">
                    <?= $dataKontrak->num_rows; ?> Karyawan
                </span>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 12%;">ID Karyawan</th>
                            <th style="width: 20%;">Nama Karyawan</th>
                            <th style="width: 18%;">Departemen</th>
                            <th style="width: 15%;">Durasi Kontrak</th>
                            <th style="width: 23%;">Agensi Penyalur</th>
                            <th style="width: 12%; text-align: right;">Gaji Bersih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($dataKontrak->num_rows > 0): ?>
                            <?php while($row = $dataKontrak->fetch_assoc()): ?>
                                <?php
                                $obj = new KaryawanKontrak(
                                    $row['id_karyawan'],
                                    $row['nama_karyawan'],
                                    $row['departemen'],
                                    $row['hari_kerja_masuk'],
                                    $row['gaji_dasar_per_hari'],
                                    $row['durasi_kontrak_bulan'],
                                    $row['agensi_penyalur']
                                );
                                ?>
                                <tr>
                                    <td class="id-column"><?= $row['id_karyawan']; ?></td>
                                    <td><?= $row['nama_karyawan']; ?></td>
                                    <td><?= $row['departemen']; ?></td>
                                    <td><span class="badge-status badge-kontrak"><?= $row['durasi_kontrak_bulan']; ?> Bulan</span></td>
                                    <td><?= $row['agensi_penyalur']; ?></td>
                                    <td class="text-right gaji-amount">Rp <?= number_format($obj->hitungGajiBersih(), 0, ',', '.'); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
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
                    <?= $dataTetap->num_rows; ?> Karyawan
                </span>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 12%;">ID Karyawan</th>
                            <th style="width: 20%;">Nama Karyawan</th>
                            <th style="width: 18%;">Departemen</th>
                            <th style="width: 18%;">Tunjangan Kesehatan</th>
                            <th style="width: 20%;">Opsi Saham</th>
                            <th style="width: 12%; text-align: right;">Gaji Bersih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($dataTetap->num_rows > 0): ?>
                            <?php while($row = $dataTetap->fetch_assoc()): ?>
                                <?php
                                $obj = new KaryawanTetap(
                                    $row['id_karyawan'],
                                    $row['nama_karyawan'],
                                    $row['departemen'],
                                    $row['hari_kerja_masuk'],
                                    $row['gaji_dasar_per_hari'],
                                    $row['tunjangan_kesehatan'],
                                    $row['opsi_saham_id']
                                );
                                ?>
                                <tr>
                                    <td class="id-column"><?= $row['id_karyawan']; ?></td>
                                    <td><?= $row['nama_karyawan']; ?></td>
                                    <td><?= $row['departemen']; ?></td>
                                    <td><span class="badge-status badge-tetap">Rp <?= number_format($row['tunjangan_kesehatan'], 0, ',', '.'); ?></span></td>
                                    <td><?= $row['opsi_saham_id']; ?></td>
                                    <td class="text-right gaji-amount">Rp <?= number_format($obj->hitungGajiBersih(), 0, ',', '.'); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
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
                    <?= $dataMagang->num_rows; ?> Karyawan
                </span>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 12%;">ID Karyawan</th>
                            <th style="width: 20%;">Nama Karyawan</th>
                            <th style="width: 18%;">Departemen</th>
                            <th style="width: 18%;">Uang Saku Bulanan</th>
                            <th style="width: 20%;">Sertifikat KM</th>
                            <th style="width: 12%; text-align: right;">Gaji Bersih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($dataMagang->num_rows > 0): ?>
                            <?php while($row = $dataMagang->fetch_assoc()): ?>
                                <?php
                                $obj = new KaryawanMagang(
                                    $row['id_karyawan'],
                                    $row['nama_karyawan'],
                                    $row['departemen'],
                                    $row['hari_kerja_masuk'],
                                    $row['gaji_dasar_per_hari'],
                                    $row['uang_saku_bulanan'],
                                    $row['sertifikat_kampus_merdeka']
                                );
                                ?>
                                <tr>
                                    <td class="id-column"><?= $row['id_karyawan']; ?></td>
                                    <td><?= $row['nama_karyawan']; ?></td>
                                    <td><?= $row['departemen']; ?></td>
                                    <td><span class="badge-status badge-magang">Rp <?= number_format($row['uang_saku_bulanan'], 0, ',', '.'); ?></span></td>
                                    <td><?= $row['sertifikat_kampus_merdeka']; ?></td>
                                    <td class="text-right gaji-amount">Rp <?= number_format($obj->hitungGajiBersih(), 0, ',', '.'); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
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
            <span class="company">PT. PERUSAHAAN SEJAHTERA</span>
            <span class="divider">|</span>
            Sistem Informasi Sumber Daya Manusia
            <span class="divider">|</span>
            <br>
            <span style="font-size: 11px; color: #6a8a6a;">
                Data terakhir diperbaharui: <?= date('d/m/Y H:i:s'); ?>
            </span>
        </div>
    </div>
</body>
</html>