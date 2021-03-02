<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-body">
            <form action="<?php echo site_url('c_checkout/displayReceipt'); ?>" method="post">

<div class="form-group">
    <label for="exampleInputEmail1">Nama</label>
    <input type="text"  name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Nama">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">No HP</label>
    <input type="number" name="nohp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan No HP">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Alamat</label>
    <input type="text" name="alamat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Alamat">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Kota</label>
    <input type="text" name="kota" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Kota">   
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Kode Pos</label>
    <input type="number" name="kodepos" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Kode Pos">  
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Kota Tujuan</label>
    <select name="kotatujuan" id="kotatujuan">
    <?php foreach ($kota as $item){?>
    <option value="<?php echo $item->city_id ?>"><?php echo $item->city_name ?> </option>
    <?php } ?>
    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>
</form>
            </div>
        </div>
    </div>
</div>