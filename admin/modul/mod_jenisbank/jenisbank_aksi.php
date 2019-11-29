<?php
include "../../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

$date = date("Y-m-d H:i:s");

// Hapus
if ($module=='jenisbank' AND $act=='hapus'){
  $sql = "DELETE FROM categorybank
          WHERE categorybank_id = '$_GET[id]'";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Tambah
elseif ($module=='jenisbank' AND $act=='tambah'){

  $sql = "INSERT INTO categorybank (
            categorybank_name,
            categorybank_created )
          VALUES (
            '$_POST[categorybank_name]',
            '$date')";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Ubah
elseif ($module=='jenisbank' AND $act=='edit'){
  $sql = "UPDATE categorybank SET
            categorybank_name  = '$_POST[categorybank_name]'
          WHERE categorybank_id = '$_POST[categorybank_id]'";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}
?>
