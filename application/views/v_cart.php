<div class="container-fluid">
        <div class="card">
            <div class="card-body">
            <div class="row">
            <table class="table table-borderless">
            <thead>
                <tr align="center">
                    <th>Nama Barang</th>
                    <th>Gambar</th>
                    <th>Harga Satuan</th>
                    <th>Berat Barang</th>
                    <th>Banyaknya</th>
                    <th>Jumlah</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                if ($this->cart->total() != 0){
                ?>
                <?php foreach($items as $item){ ?>
                    <tr align="center">
                        <td><?php echo $item['name']; ?></td>
                        <?php
                            if($item['photo'] != NULL) $img = $item['photo'];
                        ?>
                        <td><img src="<?=base_url()?>asset/barang/<?=$img; ?>" width="50"></td>
                        <td><?php echo $item['price']; ?></td>
                        <td><?php echo $item['berat']; ?></td>
                        <td><?php echo $item['qty']; ?></td>
                        <td><?php echo $item['subtotal']; ?></td>
                        <td align="center">
                            <form action="<?php echo site_url('cart/remove/'.$item['rowid']); ?>" method="post">
                                <button type="submit"class = "btn btn-warning" >X</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                    <tr>
                        <td class="align-text-bottom">
                            <form action="<?php echo site_url('cart/destroy'); ?>" method="post">
                                <button type="submit"class = "btn btn-warning" >Delete All</button>
                            </form>    
                        </td> 
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                <td colspan="6" align="right">Total</td>
        			<td><?php echo $this->cart->total(); ?></td>
                </tr>
            </tfoot>
        </table>
        <br>
           
            <div class="col-md-2" align="center" style="border-radius:15px">
                <a href="<?php echo site_url('c_home/display'); ?>">Continue Shopping</a>
            </div>
            <div class="col-md-12" align="center" style="border-radius:15px">
                <a href="<?php echo site_url('c_checkout/display'); ?>">Check Out</a>
            </div>
            
            </div>
        </div>
    </div>
</div>