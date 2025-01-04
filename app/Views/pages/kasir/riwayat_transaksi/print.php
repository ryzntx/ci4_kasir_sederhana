<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Print Page</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>">

    </head>

    <body>
        <h1 class="text-center">Saung Lebe</h1>
        <p class="text-center">Jln. lorem ipsum dolor sit amet, no. 4</p>

        <table class="table table-borderless">
            <tr>
                <th>Kode Transaksi</th>
                <td><?=$transaksi[ 'kode_transaksi' ];?></td>
            </tr>
            <tr>
                <th>Jenis Pembayaran</th>
                <td><?=$transaksi[ 'jenis_pembayaran' ];?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td><?=$transaksi[ 'tanggal' ];?></td>
            </tr>
            <tr>
                <th>Kasir</th>
                <td><?=$transaksi[ 'nama' ];?></td>
            </tr>
        </table>

        <hr class="border-2 border-black border-bottom">

        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;foreach ($detailTransaksi as $row): ?>
                <tr>
                    <td><?=$no++;?></td>
                    <td><?=$row[ 'nama_menu' ];?></td>
                    <td><?=number_format($row[ 'harga' ]);?></td>
                    <td><?=$row[ 'qty' ];?></td>
                    <td><?=number_format($row[ 'total_harga' ]);?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        <hr class="border-2 border-black border-bottom">

        <table class="table table-borderless">
            <tr>
                <th>Total Belanja</th>
                <td><?=number_format($transaksi[ 'total_belanja' ]);?></td>
            </tr>
            <tr>
                <th>Tunai</th>
                <td><?=number_format($transaksi[ 'tunai' ]);?></td>
            </tr>
            <tr>
                <th>Kembalian</th>
                <td><?=number_format($transaksi[ 'kembalian' ]);?></td>
            </tr>
        </table>

        <script>
        window.print();
        </script>
    </body>

</html>