<div class="container-fluid">
    <a href="<?php echo site_url('c_penjualan/exportBarang') ?>" class="btn btn-warning">Export Barang Excel</a>
    <a href="<?php echo site_url('c_penjualan/exportBarangpdf') ?>" class="btn btn-warning">Export Barang PDF</a>
    <a href="<?php echo site_url('c_penjualan/importbarangform') ?>" class="btn btn-warning">Import Barang</a>
    <a href="<?php echo site_url('c_penjualan/barangpagination') ?>" class="btn btn-warning">Barang Pagination</a>
        <div class="card">
            <div class="card-body">
            <div class="row">
            <table class="table table-borderless" >
            <thead>
                <tr align="center">
                    <th >No Penjualan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Kota</th> 
                    <th>Alamat</th> 
                    <th>Kode Pos</th> 
                    <th>Status</th> 
                </tr>
            </thead>
            <tbody>
             
                <?php foreach($penjualan as $item){ ?>
                    <tr align="center">
                        <td><?php echo $item['no_penjualan']; ?></td>
                        <td><?php echo $item['tanggal']; ?></td>
                        <td><?php echo $item['total']; ?></td>
                        <td><?php echo $item['nama']; ?></td>
                        <td><?php echo $item['nohp']; ?></td>
                        <td><?php echo $item['kota']; ?></td>
                        <td><?php echo $item['alamat']; ?></td>
                        <td><?php echo $item['kodepos']; ?></td>
                        <td><?php echo $item['status']; ?></td>
                        <td>
                        <?php if ($item['status']== 'Belum Bayar'){ ?>
                            <form action="<?php echo site_url('c_penjualan/setStatusPenjualan') ?> " method="post">
                                <input type="hidden" name="id" value="<?php echo $item['no_penjualan']; ?>">
                                <input type="hidden" name="newstatus" value="Sudah Bayar">
                                <button type="submit" class = "btn btn-warning">Sudah Bayar</button>
                            </form>

                        <?php 
                            
                        }else if ($item['status']== 'Sudah Bayar'){ ?>

                        <form action="<?php echo site_url('c_penjualan/setStatusPenjualan') ?> " method="post">
                            <input type="hidden" name="id" value="<?php echo $item['no_penjualan']; ?>">
                            <input type="hidden" name="newstatus" value="Sudah Kirim">
                            <button type="submit"class = "btn btn-warning" >Sudah Kirim</button>
                        </form>
                        <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
            </div>
        </div>
    </div>
</div>
