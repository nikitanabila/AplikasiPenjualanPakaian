<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-body">
            <form action="<?php echo site_url('c_penjualan/importbarang'); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail1">Import Barang</label>
                    <input type="file"  name="filebarang" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Username">
                </div>
                <button type="submit" class="btn btn-warning">Upload</button>
            </form>
        </div>
    </div>
</div>
