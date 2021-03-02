<div class="container-fluid">
<form action="<?php echo site_url('c_penjualan/searchbarangpagination'); ?>" method="get">
    <div class="form-group">
        <label for="exampleInputEmail1">Cari Barang</label>
        <input type="text"  name="nama" class="form-control" id="cari_barang" aria-describedby="emailHelp" placeholder="Masukkan Nama Barang">
    </div>            
    <button type="submit" class="btn btn-warning">Cari</button>
</form>
<a href="<?php echo site_url('c_penjualan/barangpagination'); ?>" class="btn btn-primary">Reset Pencarian</a>
<div class="row">
    <?php foreach ($barang as $result){ ?>
                <div class="col-md-3">
                    <div class="card" style="border:1px; margin-bottom:20px">
                        <div class="card-body">
                            <?php 
                                $img = "placeholder.png";
                                if($result['gambar'] != NULL) $img = $result['gambar'];
                            ?>
                            <img class="img-fluid photo_list" src="<?=base_url()?>asset/barang/<?=$img; ?>">
                            <div class="card-title"><?php echo $result['nama'] ?></div>
                            <div class="card-text">
                                <p><b>Harga : <?php echo $result['harga'] ?></b></p>
                                <p>Stok : <?php echo $result['stok'] ?></p>
                                <p><?php echo $result['keterangan'] ?></p>
                            </div>                            
                        </div>
                    </div>
                </div>
        <?php } ?>
    </div>
    <?php echo $link?>
</div>
