<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Catatan Keuangan</title>
   <style>
        table, td, th {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        h1, th {
            text-align : center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Laporan Catatan Keuangan</h1>
        <h1>Periode <?= $tanggal_awal ?> - <?= $tanggal_akhir ?></h1>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nominal</th>
                    <th>Jenis</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <?php if(session()->get('jabatan') == "Admin") { ?>
                        <th>Nama Pengguna</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody> 
                <?php $no = 1; foreach($Keuangan as $key){ ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>Rp. <?= number_format($key->nominal, 0, ".",",") ?></td>
                        <td><?= str_replace('_', ' ', $key->jenis) ?></td>
                        <td><?= $key->kategori ?></td>
                        <td><?= $key->keterangan ?></td>
                        <td><?= $key->tanggal ?></td>
                        <?php if(session()->get('jabatan') == "Admin") { ?>
                            <td><?= $key->nama_pengguna ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>