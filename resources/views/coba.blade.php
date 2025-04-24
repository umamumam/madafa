<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Ujian Kompetensi</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
            font-size: 0.85em; /* Sedikit diperkecil lagi */
        }

        .container {
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            padding: 12px; /* Sedikit dikurangi */
        }

        .left-panel {
            flex: 1;
            padding-right: 12px; /* Sedikit dikurangi */
            border-right: 1px solid #eee;
        }

        .right-panel {
            flex: 1;
            padding-left: 12px; /* Sedikit dikurangi */
        }

        /* Left Panel Styles */
        .header-left {
            text-align: left;
            margin-bottom: 12px; /* Sedikit dikurangi */
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .logo-container {
            display: flex;
            align-items: center;
            margin-bottom: 3px; /* Sedikit dikurangi */
        }

        .logo-container img {
            width: 35px; /* Lebih kecil */
            margin-right: 8px;
        }

        .logo-text {
            font-weight: bold;
            font-size: 0.9em; /* Sedikit diperkecil */
            margin-bottom: 1px;
        }

        .school-name {
            font-size: 1em; /* Sedikit diperkecil */
            font-weight: bold;
            margin-bottom: 1px;
        }

        .address {
            font-size: 0.75em; /* Sedikit diperkecil */
            color: #555;
            margin-bottom: 6px; /* Sedikit dikurangi */
        }

        .card-title {
            font-size: 0.9em; /* Sedikit diperkecil */
            font-weight: bold;
            margin-bottom: 8px; /* Sedikit dikurangi */
            text-align: center;
        }

        .student-info {
            margin-bottom: 8px; /* Sedikit dikurangi */
        }

        .info-row {
            margin-bottom: 5px; /* Sedikit dikurangi */
            font-size: 0.8em; /* Sedikit diperkecil */
        }

        .label {
            font-weight: bold;
            margin-right: 2px;
        }

        .photo-box {
            border: 1px solid #ccc;
            width: 55px; /* Lebih kecil */
            height: 75px; /* Lebih kecil */
            margin-top: 6px; /* Sedikit dikurangi */
            text-align: center;
            line-height: 75px;
            color: #777;
            font-size: 0.65em; /* Lebih kecil */
        }

        .signature-area {
            margin-top: 12px; /* Sedikit dikurangi */
            font-size: 0.75em; /* Sedikit diperkecil */
        }

        .signature-line {
            border-bottom: 1px dashed #bbb;
            padding-bottom: 8px; /* Sedikit dikurangi */
            margin-bottom: 2px; /* Sedikit dikurangi */
        }

        .signature-title {
            text-align: right;
            color: #555;
            font-size: 0.75em; /* Sedikit diperkecil */
        }

        /* Right Panel Styles */
        .header-right {
            text-align: center;
            margin-bottom: 12px; /* Sedikit dikurangi */
        }

        .exam-schedule-title {
            font-size: 0.9em; /* Sedikit diperkecil */
            font-weight: bold;
            margin-bottom: 6px; /* Sedikit dikurangi */
        }

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.75em; /* Sedikit diperkecil */
        }

        .schedule-table th, .schedule-table td {
            border: 1px solid #ccc;
            padding: 5px; /* Sedikit dikurangi */
            text-align: left;
        }

        .schedule-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            font-size: 0.8em; /* Sedikit diperkecil */
        }

        .notes {
            margin-top: 12px; /* Sedikit dikurangi */
            font-size: 0.7em; /* Sedikit diperkecil */
            line-height: 1.2; /* Sedikit disesuaikan */
        }

        .notes-title {
            font-weight: bold;
            margin-bottom: 2px; /* Sedikit dikurangi */
        }

        .notes ul {
            padding-left: 12px; /* Sedikit dikurangi */
            margin-top: 0;
            margin-bottom: 0;
        }

        .notes li {
            margin-bottom: 1px; /* Sedikit dikurangi */
        }

        .footer {
            text-align: right;
            font-size: 0.65em; /* Lebih kecil */
            color: #777;
            margin-top: 8px; /* Sedikit dikurangi */
        }

        hr {
            border: 0;
            border-top: 1px solid #ccc;
            margin: 8px 0; /* Sedikit dikurangi */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div class="header-left">
                <div class="logo-container">
                    <img src="logo.png" alt="Logo">
                    <div>
                        <div class="logo-text">PANITIA PPDB TAHUN PELAJARAN 2024/2025</div>
                        <div class="school-name">MA DARUL FALAH</div>
                        <div class="logo-text">Sirahan Cluwak Pati</div>
                    </div>
                </div>
                <div class="address">Alamat : Jln. Raya Tayu Jepara Km. 18 Sirahan Cluwak Pati Telp. (0291) 4277748</div>
            </div>
            <div class="card-title">KARTU PESERTA UJIAN KOMPETENSI SISWA BARU</div>
            <div class="student-info">
                <div class="info-row"><span class="label">Nomor</span>: 002</div>
                <div class="info-row"><span class="label">Nama</span>: AHMAD MUZAKHIM</div>
                <div class="info-row"><span class="label">Alamat</span>: Banyumanis Karanganyar, Rt.005/006<br>Keling Jepara</div>
            </div>
            <div class="photo-box">Photo<br>3 x 4</div>
            <div class="signature-area">
                <div class="signature-line">Sirahan, "bad date"</div>
                <div class="signature-title">Ketua Panitia,</div>
                <div style="margin-top: 8px;">
                    <div style="height: 25px;"></div> <div style="text-align: center; font-size: 0.7em;">Muhammad Aziz, M.Pd.</div>
                </div>
            </div>
        </div>
        <div class="right-panel">
            <div class="header-right">
                <div class="exam-schedule-title">JADWAL UJIAN KOMPETENSI SISWA BARU</div>
                <div class="school-name" style="font-size: 0.9em;">MA DARUL FALAH SIRAHAN CLUWAK PATI</div>
                <div class="exam-schedule-title" style="font-size: 0.9em;">TAHUN PELAJARAN 2024/2025</div>
            </div>
            <table class="schedule-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hari/Tanggal</th>
                        <th>Jam Ke</th>
                        <th>Waktu</th>
                        <th>Mapel</th>
                        <th>Materi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Selasa, <br>9 Juli 2024</td>
                        <td>1</td>
                        <td>07:30 - 09:00</td>
                        <td>Fiqih</td>
                        <td>Fathul Qorib <br>(Ubudiyah dan Muamalah)</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>2</td>
                        <td>09:30 - 11:00</td>
                        <td>Bahasa Arab</td>
                        <td>Bhs. Arab Mts, Nahwu <br>/Shorof Alfiyah Ibnu Malik</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Rabu, <br>10 Juli 2024</td>
                        <td>1</td>
                        <td>07:30 - 09:00</td>
                        <td>BTA</td>
                        <td>Al Qur'an Juz 30</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>2</td>
                        <td>09:30 - 11:00</td>
                        <td>Wawancara</td>
                        <td>Minat, Bakat, Kepribadian, <br>Spiritual & Sosial</td>
                    </tr>
                </tbody>
            </table>
            <div class="notes">
                <div class="notes-title">Keterangan:</div>
                <ul>
                    <li>Kartu ini harus dibawa selama ujian seleksi berlangsung.</li>
                    <li>Apabila kartu ini rusak, hilang atau ketinggalan harus segera melaporkannya kepada panitia ujian.</li>
                </ul>
            </div>
            <div class="footer">PPDB MASDAFA 2024/2025</div>
        </div>
    </div>
</body>
</html>
