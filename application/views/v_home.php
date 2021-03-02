<div class="container-fluid">
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
                            <form action="<?php echo site_url('cart/buy/'.$result['kode']); ?>" method="post">
                                <button type="submit"class = "btn btn-warning" >Beli</button>
                            </form>
                        </div>
                    </div>
                </div>
        <?php } ?>
    </div>
</div>
