<?php
include "../../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

$date = date("Y-m-d H:i:s");

// Hapus
if ($module=='bank' AND $act=='hapus'){
  $sql = "DELETE FROM bank
          WHERE bank_id = '$_GET[id]'";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Tambah
elseif ($module=='bank' AND $act=='tambah'){

  $sql = "INSERT INTO bank (
            bank_cabang,
            bank_kcp,
            categorybank_id,
            bank_created )
          VALUES (
            '$_POST[bank_cabang]',
            '$_POST[bank_kcp]',
            '$_POST[categorybank_id]',
            '$date')";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Ubah
elseif ($module=='bank' AND $act=='edit'){
  $sql = "UPDATE bank SET
            bank_cabang  = '$_POST[bank_cabang]',
            bank_kcp  = '$_POST[bank_kcp]',
            categorybank_id  = '$_POST[categorybank_id]'
          WHERE bank_id = '$_POST[bank_id]'";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}
?>
