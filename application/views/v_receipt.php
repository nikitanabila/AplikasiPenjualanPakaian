
<div class="container-fluid">
    <!-- <div class="row"> -->
        <div class="card">
            <div class="card-body">
                    <table class="table table-borderless">
                
                     <tbody>
                
                <?php foreach ($pembeli as $key => $pembeliItem){?>
                <tr>
                <td><?php echo $key?></td>
                <td><?php echo $pembeliItem?></td>
                </tr>    
                <?php }?>
                <tr>
                <td>Ongkos Kirim</td>
                <td><?php echo $ongkir?></td>
                </tr>
                <tr>
                <td>Total</td>
                <td><?php echo $ongkir+$pembeli['total']?></td>
                </tr>                                                                             
                </tbody>           
            </table>   
            <form action="<?php echo site_url('c_checkout/checkout_submit') ?>" method="post">
            <?php foreach ($pembeli as $key => $pembeliItem){?>
                <input type="hidden" name="<?php echo $key?>" value='<?php echo $pembeliItem ?>'>
            <?php }?>
            <input type="hidden" name="total" value='<?php echo $ongkir+$pembeli['total']?>'>
            <button type="submit" class='btn btn-primary'>Check Out</button>
            
            </form>
            </div>

        </div>
<!--    
    </div> -->
</div>