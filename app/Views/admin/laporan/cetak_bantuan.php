<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penerima Bantuan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            margin: 40px;
        }

        h2,
        h4 {
            text-align: center;
            margin: 0;
        }

        .periode {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 13px;
        }

        thead {
            background-color: #f8f9fa;
        }

        th,
        td {
            border: 1px solid #bbb;
            padding: 8px;
        }

        th {
            background-color: #e9ecef;
            text-align: center;
        }

        td.text-right {
            text-align: right;
        }

        td.text-center {
            text-align: center;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>

<body onload="window.print()">

    <h2>Laporan Penerima Bantuan</h2>
    <div class="periode">
        Periode: <?= date('d M Y', strtotime($dari)) ?> s.d. <?= date('d M Y', strtotime($sampai)) ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Daftar</th>
                <th>No. Daftar</th>
                <th>Nama Mustahik</th>
                <th>Jenis Bantuan</th>
                <th>Status</th>
                <th>Rekomendasi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($laporan)) : ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data</td>
                </tr>
            <?php else : ?>
                <?php foreach ($laporan as $i => $row) : ?>
                    <?php
                    // satukan rekomendasi menjadi 1 string
                    $rekomen = [];
                    if (!empty($row->rekomendasi)) {
                        foreach ($row->rekomendasi as $r) {
                            $rekomen[] = $r->nama_kriteria . ': ' . $r->rekap;
                        }
                    }
                    $rekomen_str = implode(', ', $rekomen);
                    ?>
                    <tr>
                        <td class="text-center"><?= $i + 1 ?></td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($row->tanggal)) ?></td>
                        <td><?= esc($row->invoice) ?></td>
                        <td><?= esc($row->nama_mustahik) ?></td>
                        <td><?= esc($row->nama_bantuan) ?></td>
                        <td class="text-center"><?= ucfirst($row->status_pengajuan) ?></td>
                        <td><?= esc($rekomen_str) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: <?= date('d-m-Y H:i') ?>
    </div>

    <script>
        // Tutup otomatis setelah print
        window.onafterprint = function() {
            window.close();
        };
        if (window.matchMedia) {
            const mql = window.matchMedia('print');
            mql.addEventListener('change', function(e) {
                if (!e.matches) {
                    window.close();
                }
            });
        }
    </script>

</body>

</html>