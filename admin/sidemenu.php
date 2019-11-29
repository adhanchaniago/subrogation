<?php if ($_GET['module']=='home'){ ?>
<li class="active">
<?php } else { ?>
<li>
<?php } ?>
  <a href="?module=home"><i class="fa fa-home"></i> <span>Beranda</span></a>
</li>
<?php if ($_SESSION['level']=='admin') { ?>

<?php if ($_GET['module']=='website'){ ?>
<li class="active">
<?php } else { ?>
<li>
<?php } ?>
  <a href="?module=website&act=edit&id=1"><i class="fa fa-globe"></i> <span>Identitas Website</span></a>
</li>

<?php if ($_GET['module']=='profile'){ ?>
<li class="active">
<?php } else { ?>
<li>
<?php } ?>
  <a href="?module=profile"><i class="fa fa-user"></i> <span>Akun Saya</span></a>
</li>

<?php if ($_GET['module']=='user'){ ?>
<li class="active">
<?php } else { ?>
<li>
<?php } ?>
  <a href="?module=user"><i class="fa fa-user"></i> <span>User</span></a>
</li>
<?php } ?>

<?php if ($_GET['module']=='debitur'){ ?>
<li class="active">
<?php } else { ?>
<li>
<?php } ?>
  <a href="?module=debitur"><i class="fa fa-users"></i> <span>Debitur</span></a>
</li>

<li>
  <a href=""><i class="fa fa-university"></i> <span>Bank</span></a>
  <ul class="sub-menu">

    <?php if ($_GET['module']=='jenisbank'){ ?>
    <li class="active">
    <?php } else { ?>
    <li>
    <?php } ?>
    <a href="?module=jenisbank">Jenis Bank</a></li>

    <?php if ($_GET['module']=='bank'){ ?>
    <li class="active">
    <?php } else { ?>
    <li>
    <?php } ?>
    <a href="?module=bank">Cabang Bank</a></li>

    <?php if ($_GET['module']=='jamkrindo'){ ?>
    <li class="active">
    <?php } else { ?>
    <li>
    <?php } ?>
    <a href="?module=jamkrindo">Bank Jamkrindo</a></li>

  </ul>
</li>

<?php if ($_GET['module']=='produk'){ ?>
  <li class="active">
  <?php } else { ?>
  <li>
  <?php } ?>
    <a href="?module=produk"><i class="fa fa-list"></i> <span>Jenis Produk</span></a>
  </li>

  <?php if ($_GET['module']=='subrogasiadd'){ ?>
  <li class="active">
  <?php } else { ?>
  <li>
  <?php } ?>
    <a href="?module=subrogasiadd&act=tambah"><i class="fa fa-plus"></i> <span>Subrogasi</span></a>
  </li>

  <?php if ($_GET['module']=='subrogasi'){ ?>
  <li class="active">
  <?php } else { ?>
  <li>
  <?php } ?>
    <a href="?module=subrogasi"><i class="fa fa-money"></i> <span>Piutang Subrogasi</span></a>
  </li>

  <?php if ($_GET['module']=='subrogasilunas'){ ?>
  <li class="active">
  <?php } else { ?>
  <li>
  <?php } ?>
    <a href="?module=subrogasilunas"><i class="fa fa-money"></i> <span>Lunas Piutang</span></a>
  </li>