<?php
include "../../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

$date = date("Y-m-d H:i:s");

// Tambah
if ($module=='tindakan' AND $act=='tambah'){

  $sql = "INSERT INTO tindakan (
            subrogasi_id,
            tindakan_jenis,
            tindakan_hasil,
            tindakan_created )
          VALUES (
            '$_POST[subrogasi_id]',
            '$_POST[tindakan_jenis]',
            '$_POST[tindakan_hasil]',
            '$date')";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module.'&id='.$_POST['subrogasi_id']);
  }
}
?>
