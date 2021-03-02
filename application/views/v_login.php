<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-body">
            <form action="<?php echo site_url('c_login/login'); ?>" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text"  name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Username">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Password">
                </div>
                <button type="submit" class="btn btn-warning">Login</button>
            </form>
        </div>
    </div>
</div>
