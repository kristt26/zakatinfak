<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan Penyaluran</title>
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

        tfoot td {
            font-weight: bold;
            background-color: #f1f1f1;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>

<body onload="window.print()">

    <h2>Laporan Penyaluran Zakat</h2>
    <div class="periode">
        Periode: <?= date('d M Y', strtotime($dari)) ?> s.d. <?= date('d M Y', strtotime($sampai)) ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Invoice</th>
                <th>Mustahik</th>
                <th>Status</th>
                <th>Total (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $grand_total = 0;
            if (empty($laporan)) :
            ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                </tr>
            <?php else: ?>
                <?php foreach ($laporan as $i => $row): ?>
                    <?php
                    $grand_total += $row['jumlah_bayar'];
                    $mustahik = $row['nama_muzaki']
                        ?? $row['nama_mustahik']
                        ?? $row['nama_pelajar']
                        ?? '-';
                    ?>
                    <tr>
                        <td class="text-center"><?= $i + 1 ?></td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                        <td><?= esc($row['invoice']) ?></td>
                        <td><?= esc($mustahik) ?></td>
                        <td class="text-center"><?= esc(ucfirst($row['status_transaksi'])) ?></td>
                        <td class="text-right"><?= number_format($row['jumlah_bayar'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

        </tbody>
        <?php if (!empty($laporan)): ?>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-right">Total Keseluruhan</td>
                    <td class="text-right"><?= number_format($grand_total, 0, ',', '.') ?></td>
                </tr>
            </tfoot>
        <?php endif; ?>
    </table>

    <div class="footer">
        Dicetak pada: <?= date('d-m-Y H:i') ?>
    </div>
    <script>
        window.onafterprint = function() {
            window.close();
        };

        if (window.matchMedia) {
            const mediaQueryList = window.matchMedia('print');
            mediaQueryList.addEventListener('change', function(mql) {
                if (!mql.matches) {
                    window.close();
                }
            });
        }
    </script>

</body>

</html>