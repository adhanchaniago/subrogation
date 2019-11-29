<?php
include "../../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

$date = date("Y-m-d H:i:s");

// Hapus
if ($module=='subrogasi' AND $act=='hapus'){
  $sql = "DELETE FROM subrogasi
          WHERE subrogasi_id = '$_GET[id]'";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Tambah
elseif ($module=='subrogasiadd' AND $act=='tambah'){

  $sql = "INSERT INTO subrogasi (
            debitur_id,
            bank_id,
            product_id,
            subrogasi_nosp,
            subrogasi_SKIM,
            subrogasi_sertifikat,
            subrogasi_agunan,
            subrogasi_sisapiutang,
            subrogasi_totalpiutang,
            subrogasi_tglklaim )
          VALUES (
            '$_POST[debitur_id]',
            '$_POST[bank_id]',
            '$_POST[product_id]',
            '$_POST[subrogasi_nosp]',
            '$_POST[subrogasi_SKIM]',
            '$_POST[subrogasi_sertifikat]',
            '$_POST[subrogasi_agunan]',
            '$_POST[subrogasi_totalpiutang]',
            '$_POST[subrogasi_totalpiutang]',
            '$date')";

  if (mysql_query($sql)) {
    header('location:../../media.php?module=subrogasi');
  }
}

// Ubah
elseif ($module=='subrogasi' AND $act=='edit'){
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
