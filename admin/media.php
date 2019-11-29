<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  header("location: index.php");
} else { ?>
<!DOCTYPE html>
<html>
<head>
  <?php
  include "../config/koneksi.php";
  $result=mysql_query("SELECT * FROM identitas WHERE identitas_id=1");
  while ($r=mysql_fetch_array($result)) { ?>


  <title><?php echo $r['identitas_website'] ?></title>

  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo $r['identitas_deskripsi'] ?>"/>
  <meta name="keywords" content="<?php echo $r['identitas_keyword'] ?>"/>
  <meta name="author" content="<?php echo $r['identitas_author'] ?>"/>

  <link rel="shortcut icon" type="image/x-icon" href="assets/images/website/<?php echo $r['identitas_favicon'] ?>" sizes="16x16" />
  <?php } ?>

  <link href="assets/admin/js/bootstrap/dist/css/bootstrap.css" rel="stylesheet" />
  <link href="assets/admin/fonts/font-awesome-4/css/font-awesome.min.css" rel="stylesheet" />
  <link href='assets/admin/fonts/css/fonts.css' rel='stylesheet' type='text/css'>
  <link href="assets/admin/js/jquery.nanoscroller/nanoscroller.css" rel="stylesheet" type="text/css" />
  <link href="assets/admin/css/style.css" rel="stylesheet" type="text/css" />


  <!-- Font -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
  <script src="assets/admin/js/highchart.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="assets/admin/js/jquery.js" type="text/javascript"></script>
  <script src="assets/admin/js/date/jquery-1.7.1.min.js" type="text/javascript"></script>
  <script src="assets/admin/js/date/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
  <script src="assets/admin/js/behaviour/general.js" type="text/javascript"></script>
  <script src="assets/admin/js/jquery.nanoscroller/jquery.nanoscroller.js" type="text/javascript"></script>
  <script src="assets/admin/js/jquery.ui/jquery-ui.js" type="text/javascript"></script>
</head>
<body>
  <?php 
  $result2 =mysql_query("SELECT * FROM admin WHERE admin_username='$_SESSION[username]'");
  $r2      = mysql_fetch_array($result2);
  ?>
  <!-- ==================== Navbar ==================== -->
  <div id="head-nav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="fa fa-gear"></span>
        </button>
        <a class="navbar-brand" href="#"><span>SUBROGASI</span></a>
      </div>
      <div class="navbar-collapse collapse">
        <!-- ========== Navbar Left ========== -->
        <ul class="nav navbar-nav left-nav">
          <li class="active"><a href=""><i class="fa fa-home"></i></a></li>
        </ul>
        <!-- ========== Navbar Right ========== -->
        <ul class="nav navbar-nav navbar-right user-nav">
          <li class="dropdown profile_menu">
            <!-- dropdown -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img alt="Avatar" src="assets/admin/images/avatar2.jpg" />
              <span><?php echo $r2['admin_name'] ?></span>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="?module=home">Beranda</a></li>
              <li class="divider"></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right not-nav" ></ul>
      </div>
    </div>
  </div>
  <!-- ==================== End Navbar ==================== -->

  <div id="cl-wrapper" class="fixed-menu">
    <!-- ==================== Sidebar ==================== -->
    <div class="cl-sidebar" data-position="right">
      <div class="cl-toggle"><i class="fa fa-bars"></i></div>
        <div class="cl-navblock">
          <div class="menu-space">
            <div class="content">
              <div class="side-user">
                <div class="avatar">
                  <img src="assets/admin/images/avatar1_50.jpg" alt="Avatar" />
                </div>
                <div class="info">
                  <a href="#"><?php echo $r2['admin_name'] ?></a>
                  <img src="assets/admin/images/state_online.png" alt="Status" />
                  <span>Online</span>
                </div>
              </div>
              <ul class="cl-vnavigation">
                <?php include "sidemenu.php"; ?>
              </ul>
            </div>
          </div>
          <div class="text-center collapse-button" style="padding:7px 9px;">
            <button id="sidebar-collapse" class="btn btn-default" style="">
              <i class="fa fa-angle-left"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- ==================== End Sidebar ==================== -->

      <!-- ==================== Content ==================== -->
      <div class="container-fluid" id="pcont">
        <?php include "breadcrumb.php"; ?>
        <?php include "content.php"; ?>
			</div>
      <!-- ==================== End Content ==================== -->
    </div>
    <script>
      $(function(){
		  $('#modal-konfirmasi').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget)
			  var id = div.data('id')
        var modal = $(this)
        modal.find('#hapus-jamkrindo').attr("href","modul/mod_jamkrindo/jamkrindo_aksi.php?module=jamkrindo&act=hapus&id="+id);
        modal.find('#hapus-user').attr("href","modul/mod_user/user_aksi.php?module=user&act=hapus&id="+id);
        modal.find('#hapus-debitur').attr("href","modul/mod_debitur/debitur_aksi.php?module=debitur&act=hapus&id="+id);
        modal.find('#hapus-jenisbank').attr("href","modul/mod_jenisbank/jenisbank_aksi.php?module=jenisbank&act=hapus&id="+id);
        modal.find('#hapus-bank').attr("href","modul/mod_bank/bank_aksi.php?module=bank&act=hapus&id="+id);
        modal.find('#hapus-produk').attr("href","modul/mod_produk/produk_aksi.php?module=produk&act=hapus&id="+id);
        modal.find('#hapus-subrogasi').attr("href","modul/mod_subrogasi/subrogasi_aksi.php?module=subrogasi&act=hapus&id="+id);
        });
      });
      $(function(){
		  $('#modal-konfirmasi').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget)
			  var id = div.data('id')
        });
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
        App.init();
        App.dashBoard();
        introJs().setOption('showBullets', false).start();
      });
    </script>
    <script src="assets/admin/js/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/admin/js/jquery.flot/jquery.flot.js" type="text/javascript"></script>
    <script src="assets/admin/js/jquery.flot/jquery.flot.pie.js" type="text/javascript"></script>
    <script src="assets/admin/js/jquery.flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="assets/admin/js/jquery.flot/jquery.flot.labels.js" type="text/javascript"></script>
    <script src="asset/admin/js/jquery.nestable/jquery.nestable.js"></script>
    <script src="asset/admin/js/bootstrap.switch/bootstrap-switch.min.js" type="text/javascript" ></script>
    <script src="asset/admin/js/jquery.select2/select2.min.js" type="text/javascript" ></script>
    <script src="asset/admin/js/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
    <script src="asset/admin/js/jquery.icheck/icheck.min.js" type="text/javascript"></script>
    <script src="asset/admin/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

    <script src="assets/admin/js/jquery.parsley/parsley.js" type="text/javascript"></script>
  </body>
</html>
<?php } ?>
