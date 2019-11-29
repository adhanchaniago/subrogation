<?php
include "../../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

$date = date("Y-m-d H:i:s");

// Hapus
if ($module=='debitur' AND $act=='hapus'){
  $sql = "DELETE FROM debitur
          WHERE debitur_id = '$_GET[id]'";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Tambah
elseif ($module=='debitur' AND $act=='tambah'){

  $sql = "INSERT INTO debitur (
            debitur_name,
            debitur_address,
            debitur_notelp,
            debitur_gender,
            debitur_age,
            debitur_created )
          VALUES (
            '$_POST[debitur_name]',
            '$_POST[debitur_address]',
            '$_POST[debitur_notelp]',
            '$_POST[debitur_gender]',
            '$_POST[debitur_age]',
            '$date')";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Ubah
elseif ($module=='debitur' AND $act=='edit'){
  $sql = "UPDATE debitur SET
            debitur_name  = '$_POST[debitur_name]',
            debitur_address = '$_POST[debitur_address]',
            debitur_notelp = '$_POST[debitur_notelp]',
            debitur_gender = '$_POST[debitur_gender]',
            debitur_age = '$_POST[debitur_age]'
          WHERE debitur_id = '$_POST[debitur_id]'";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}
?>
