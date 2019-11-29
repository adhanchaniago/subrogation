<?php
include "../../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

$date = date("Y-m-d H:i:s");

// Hapus
if ($module=='subrogasilunas' AND $act=='hapus'){
  $sql = "DELETE FROM subrogasi
          WHERE subrogasi_id = '$_GET[id]'";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Ubah
elseif ($module=='subrogasilunas' AND $act=='edit'){
  $sql = "UPDATE subrogasi SET
            debitur_id  = '$_POST[debitur_id]',
            bank_id  = '$_POST[bank_id]',
            product_id  = '$_POST[product_id]',
            subrogasi_SKIM  = '$_POST[subrogasi_SKIM]',
            subrogasi_nosp  = '$_POST[subrogasi_nosp]',
            subrogasi_sertifikat  = '$_POST[subrogasi_sertifikat]'
          WHERE subrogasi_id = '$_POST[subrogasi_id]'";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}
?>
