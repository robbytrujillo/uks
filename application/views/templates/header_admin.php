<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>UKS</title>

  <!-- General CSS Files -->
  <link rel="shortcut icon" href="<?= base_url() ?>/image/1.png">
  <link rel="stylesheet" href="<?= base_url() ?>/dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/dist/modules/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/dist/modules/ionicons/css/ionicons.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url() ?>/dist/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/dist/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/dist/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/dist/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>dist/dist/sweetalert.css">
</head>

<body class="layout-3">
  <div id="app">
    <div class="main-wrapper container">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <a href="<?= base_url('admin/')?>" class="navbar-brand sidebar-gone-hide" style="font-size: 20px;"><img src="<?= base_url()?>/image/1.png" width="4.5%">UKS SEKOLAH</a>
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        <div class="nav-collapse">
          <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
            <i class="fas fa-ellipsis-v"></i>
          </a>
        </div>
        <form class="form-inline ml-auto">
          
        </form>
        <ul class="navbar-nav navbar-right">
          
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?= base_url() ?>/dist/img/avatar/avatar-1.png" width="20" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block"><?= $this->session->userdata('username'); ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('auth/logout') ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <nav class="navbar navbar-secondary navbar-expand-lg">
        <div class="container">
          <ul class="navbar-nav">
            <li class="nav-item ">
              <a href="<?= base_url('admin/')?>"  class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('siswa')?>" class="nav-link"><i class="far ion-person-add"></i><span>Upload Siswa</span></a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/siswa')?>" class="nav-link"><i class="far ion-ios-medkit-outline"></i><span>Input Siswa Sakit</span></a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/report') ?>" class="nav-link"><i class="far ion-clipboard"></i><span>Laporan</span></a>
              
            </li>
          </ul>
        </div>
      </nav>