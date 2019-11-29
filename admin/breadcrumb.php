<?php

// Bagian Identitas Home
if ($_GET['module']=='home'){
  ?>
  <div class="page-head">
    <h3>Dashboard <small>Control Panel</small></h3>
    <ol class="breadcrumb">
      <li class="active"><i class='fa fa-home'></i> Dashboard</li>
  	</ol>
  </div>
  <?php
}

// Bagian Identitas Website
elseif ($_GET['module']=='website') {
  ?>
  <div class="page-head">
    <h3>Identitas <small>Website</small></h3>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class='fa fa-home'></i> Dashboard</a></li>
      <li class="active">Identitas Website</li>
    </ol>
  </div>
<?php }

// Bagian Profil
elseif ($_GET['module']=='profile') {
  ?>
  <div class="page-head">
    <h3>Akun <small>Saya</small></h3>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class='fa fa-home'></i> Dashboard</a></li>
      <li class="active">Profile</li>
    </ol>
  </div>
<?php }

// Bagian User
elseif ($_GET['module']=='user'){
  ?>
  <div class="page-head">
    <h3>Pengguna</h3>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class='fa fa-home'></i> Dashboard</a></li>
      <li class="active">Pengguna</li>
    </ol>
  </div>
<?php }

// Bagian Jenis Bank
elseif ($_GET['module']=='jenisbank'){
  ?>
  <div class="page-head">
    <h3>Jenis <small>Bank</small></h3>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class='fa fa-home'></i> Dashboard</a></li>
      <li class="active">Jenis Bank</li>
    </ol>
  </div>
<?php }

// Bagian Bank
elseif ($_GET['module']=='bank'){
  ?>
  <div class="page-head">
    <h3>Bank</h3>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class='fa fa-home'></i> Dashboard</a></li>
      <li class="active">Bank</li>
    </ol>
  </div>
<?php }

// Bagian Bank Jamkrindo
elseif ($_GET['module']=='jamkrindo'){
  ?>
  <div class="page-head">
    <h3>Bank Jamkrindo</h3>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class='fa fa-home'></i> Dashboard</a></li>
      <li class="active">Jamkrindo</li>
    </ol>
  </div>
<?php }

// Bagian Jenis Produk
elseif ($_GET['module']=='produk'){
  ?>
  <div class="page-head">
    <h3>Jenis <small>Produk</small></h3>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class='fa fa-home'></i> Dashboard</a></li>
      <li class="active">Bank</li>
    </ol>
  </div>
<?php }

// Bagian Subrogasi
elseif ($_GET['module']=='subrogasi'){
  ?>
  <div class="page-head">
    <h3>Subrogasi</h3>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class='fa fa-home'></i> Dashboard</a></li>
      <li class="active">Subrogasi</li>
    </ol>
  </div>
<?php }

// Bagian Subrogasi
elseif ($_GET['module']=='subrogasiadd'){
  ?>
  <div class="page-head">
    <h3>Subrogasi</h3>
    <ol class="breadcrumb">
      <li><a href="?module=subrogasiadd"><i class='fa fa-home'></i> Dashboard</a></li>
      <li class="active">Tambah Subrogasi</li>
    </ol>
  </div>
<?php }

elseif ($_GET['module']=='subrogasilunas'){
  ?>
  <div class="page-head">
    <h3>Lunas Piutang</h3>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class='fa fa-home'></i> Dashboard</a></li>
      <li class="active">Lunas Piutang</li>
    </ol>
  </div>
<?php }

// Bagian Subrogasi
elseif ($_GET['module']=='tindakan'){
  ?>
  <div class="page-head">
    <h3>Tindakan <small>Subrogasi</small></h3>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class='fa fa-home'></i> Dashboard</a></li>
      <li class="active">Tindakan Subrogasi</li>
    </ol>
  </div>
<?php }

// Bagian Angsuran
elseif ($_GET['module']=='angsuran'){
  ?>
  <div class="page-head">
    <h3>Pembayaran <small>Subrogasi</small></h3>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class='fa fa-home'></i> Dashboard</a></li>
      <li class="active">Pembayaran Subrogasi</li>
    </ol>
  </div>
<?php }

// Bagian Debitur
elseif ($_GET['module']=='debitur'){
  ?>
  <div class="page-head">
    <h3>Debitur</h3>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class='fa fa-home'></i> Dashboard</a></li>
      <li class="active">Debitur</li>
    </ol>
  </div>
<?php } ?>
