<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title;?></title>
  <link rel="icon" href="<?php echo base_url(); ?>asset/arina.png" type="image/x-icon" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/datepicker/datepicker3.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-yellow sidebar-mini">
<?php foreach($pengguna->result_array() as $user)?>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SIK</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SPK IK</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url();?>asset/admin.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><b><?php echo $user['name'];?></b></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url();?>asset/admin.png" class="img-circle" alt="User Image">

                <p>
                  <b><?php echo $user['name'];?></b>
                  <small><?php if($user['hak_akses']=='1'){ echo "Login as : Staff PMW";}?></small>
                  <small><?php if($user['hak_akses']=='2'){ echo "Login as : Penilai Fakultas";}?></small>
                  <small><?php if($user['hak_akses']=='3'){ echo "Login as : Mahasiswa Pengusul";}?></small>
                  <small><?php if($user['hak_akses']=='4'){ echo "Login as : Pimpinan PMW";}?></small>
                  <small><?php if($user['hak_akses']=='5'){ echo "Login as : Evaluator";}?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url();?>web/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>asset/admin.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          </br>
          <a href="#"><i class="fa fa-circle text-warning"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <?php if($user['hak_akses']=='1'){?>
        <li class="header">Admin NAVIGATION</li>
        <!-- As Admin -->
          <li class="treeview">
            <a href="#">
              <i class="fa fa-database"></i> <span>Data Master</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url();?>web/pengguna_sistem"><i class="fa  fa-user"></i> <span>Karyawan</span></a></li>
              <li><a href="<?php echo base_url();?>web/view_jabatan"><i class="fa  fa-chevron-right"></i> <span>Jabatan</span></a></li>
            </ul>
          </li>
          <li><a href="<?php echo base_url();?>web/view_kriteria_saw"><i class="fa fa-gears"></i> <span>Indikator Penilaian</span>
          </a></li>
          <li><a href="<?php echo base_url();?>web/penilaian_karyawan"><i class="fa fa-book"></i> <span>Penilaian</span>
          </a></li>
          <li><a href="<?php echo base_url();?>web/ranking"><i class="fa fa-book"></i> <span>Ranking</span>
          </a></li>

        <?php } ?>

        <?php if($user['hak_akses']=='2'){?>
        <li class="header">Pimpinan NAVIGATION</li>
        <!-- As Pimpinan -->
        <li><a href="<?php echo base_url();?>web/list_usulan_usaha"><i class="fa fa-book"></i> <span>Penilaian [ TAHAP 1 ]<small class="label pull-right badge bg-green" id="penilaian_pertama"></small></span></a></li>
        <li><a href="<?php echo base_url();?>web/recom_electre"><i class="fa fa-star-o"></i> <span>Seleksi Tahap Pertama</span></a></li>
        <?php } ?>

        <?php if($user['hak_akses']=='3'){?>
        <li class="header">Karyawan NAVIGATION</li>
        <!-- As Karyawan -->
        <li><a href="<?php echo base_url();?>web/form_usulan_usaha"><i class="fa fa-book"></i> <span>Form Usulan Usaha</span></a></li>
        <li><a href="<?php echo base_url();?>web/form_upload_usulan"><i class="fa fa-book"></i> <span>Form Upload Usulan Usaha</span></a></li>
        <li><a href="<?php echo base_url();?>web/timeline_usaha"><i class="fa fa-spinner"></i> <span>Timeline Usulan Usaha</span></a></li>
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-bookmark"></i> <?php echo $board;?></a></li>
        <li class="active"><?php echo $page;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">