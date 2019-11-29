<?php
include "../../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

$date = date("Y-m-d H:i:s");

// Hapus
if ($module=='jamkrindo' AND $act=='hapus'){
  $sql = "DELETE FROM jamkrindo
          WHERE jamkrindo_id = '$_GET[id]'";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Tambah
elseif ($module=='jamkrindo' AND $act=='tambah'){

  $sql = "INSERT INTO jamkrindo (
            jamkrindo_norek,
            bank_id,
            jamkrindo_created )
          VALUES (
            '$_POST[jamkrindo_norek]',
            '$_POST[bank_id]',
            '$date')";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Ubah
elseif ($module=='jamkrindo' AND $act=='edit'){
  $sql = "UPDATE jamkrindo SET
            jamkrindo_norek  = '$_POST[jamkrindo_norek]',
            bank_id  = '$_POST[bank_id]'
          WHERE jamkrindo_id = '$_POST[jamkrindo_id]'";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}
?>
