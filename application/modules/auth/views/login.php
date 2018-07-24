<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sistem Informasi Pokja Koperasi Pemkot Depok</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php base_url()?>assets/images/logodepok.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="<?php echo base_url()?>assets/css/material-design-iconic-font.css" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url()?>assets/js/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url()?>assets/css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url()?>assets/css/style_bsmaterial.css" rel="stylesheet">

</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">SIPOKJA</a>
            <small>Pemerintah Kota Depok</small>
        </div>
        <div class="card">
            <div class="body">
               <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
              <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if($error)
                {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $error; ?>                    
                    </div>
                <?php }
                $success = $this->session->flashdata('success');
                if($success)
                {
                  ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $success; ?>                    
                    </div>
                <?php } ?>  

                <form action="<?php echo base_url(); ?>auth/login" method="post">
                    <div class="msg">Login Page</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="email" placeholder="email" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-red waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <!-- <a href="sign-up.html">Register Now!</a> -->
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url()?>assets/js/jquery-2.1.4.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url()?>assets/js/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url()?>assets/js/admin.js"></script>
    <script src="<?php echo base_url()?>assets/js/sign-in.js"></script>


</body>

</html>