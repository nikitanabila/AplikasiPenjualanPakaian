<!DOCTYPE html>
<html>
    <head>
        <title>Wirus Jaya 171511054</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo base_url();?>asset/bootstrap/css/bootstrap.css">
        <style>
            p{
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            }
            h1{
                font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                padding-bottom: 1px;
                padding-top:1px;
                font-size: 63px;
                margin-top: 5%;
            }
            @media(max-width:767px){
                h1{font-size: 18px}
                h2{font-size: 16px}
                
            }
            tr.button{
                font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            }
            .bordered{
                border: solid 1px red;
            }
            .active {
                background-color: #000000;
            }
            img.photo_list {
                width:250px !important;
                height:250px !important;

            }
            body{
                background-color: #ff8c00;
            }
            .header{
                background-color: #ff5d00;
                color: whitesmoke;
            }
            .navbar div{
                background-color: #db621d;
                padding: 1%;
            }
            .navbar div a{
                color: whitesmoke;
            }
            /* .content{
                background-color: #ffb861;
                padding:3%
            } */
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12" align="center">
                    <h1 align="center">WIRUSJAYA</h1>
                </div>
            </div>
            <div class="row navbar" style="margin:0px">
                <div class="col-md-2" align="center" style="border-radius:15px">
                    <a href="<?php echo base_url();?>index.php/c_home/display">Home</a>
                </div>
                <div class="col-md-2" align="center" style="border-radius:15px">
                    <a href="<?php echo base_url();?>index.php/c_penjualan/display">Admin</a>
                </div>
                
                <div class="col-md-2" align="center" style="border-radius:15px">
                    <a href="<?php echo base_url();?>index.php/cart/index">Cart</a>
                </div>

                <?php
                 if ($this->session->userdata('logged_user')!=NULL){
                ?>
                <div class="col-md-2" align="center" style="border-radius:15px">
                    <a href="<?php echo base_url();?>index.php/c_login/logout">Logout</a>
                </div>
                <?php
                 }
                ?>

            </div>
            <div class="row content">
                <?php echo $content; ?>
            </div>
        </div>
        <script src="<?php echo base_url();?>asset/bootstrap/js/jquery-3.3.1.min.js"></script>
        <script src="<?php echo base_url();?>asset/bootstrap/js/bootstrap.js"></script>
    </body>
    <footer class="text-center">Copyright 2019</footer>
</html>