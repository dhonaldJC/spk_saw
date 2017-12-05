<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Page | SI-Penentuan Calon PMW Universitas Sriwijaya</title>
  <link rel="icon" href="<?php echo base_url(); ?>asset/pmw.png" type="image/x-icon" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="body-Login-back">
    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>REGISTRASI CALON PMW Universitas Sriwijaya</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="<?php echo base_url();?>web/submit_register" method="post" enctype="multipart/form-data">

                                    <div class="form-group col-lg-6">
                                      <label>Nama</label>
                                        <input type="text" name="name" class="form-control">
                                      <?php echo form_error('name'); ?>
                                    </div>

                                    <div class="form-group col-lg-6">
                                      <label>Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" class="form-control">
                                      <?php echo form_error('tanggal_lahir'); ?>
                                    </div>

                                    <div class="form-group col-lg-6">
                                      <label>NIM</label>
                                        <input type="text" name="nim" class="form-control">
                                      <?php echo form_error('nim'); ?>
                                    </div>

                                    <div class="form-group col-lg-6">
                                      <label>Fakultas</label>
                                        <select name="fakultas" class="form-control">
                                          <?php foreach($fakultas->result_array() as $ku){?>
                                            <option value="<?php echo $ku['nama_fakultas'];?>">
                                              <?php echo $ku['nama_fakultas'];?>
                                            </option>
                                          <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                      <label>Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="Laki-Laki"> Laki-Laki</option>
                                            <option value="Perempuan"> Perempuan</option>
                                        </select>
                                      <?php echo form_error('jenis_kelamin'); ?>
                                    </div>

                                    <div class="form-group col-lg-6">
                                      <label>Password</label>
                                        <input type="password" name="password" class="form-control">
                                      <?php echo form_error('password'); ?>
                                    </div

                                     <div class="panel-footer">
                                        <button class="btn btn-primary pull-right">Submit</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
        </div>
</body>
</html>
