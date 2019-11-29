<?php
include "../../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

$date = date("Y-m-d H:i:s");

// Tambah
if ($module=='angsuran' AND $act=='tambah'){

  $jamkrindo=mysql_query("SELECT * FROM jamkrindo WHERE jamkrindo_id='$_POST[transaksi_bankjamkrindo]'");
  $s      = mysql_fetch_array($jamkrindo);
  $transaksi_bankjamkrindo = $s['bank_id'];
  $transaksi_norekbank = $s['jamkrindo_norek'];

  $subrogasi=mysql_query("SELECT * FROM subrogasi WHERE subrogasi_id='$_POST[subrogasi_id]'");
  $s2      = mysql_fetch_array($subrogasi);
  
  if ($s2['subrogasi_sisapiutang'] >= $_POST['transaksi_jumlah']) {
  $piutang = $_POST['subrogasi_sisapiutang'];
  $jumlah = $_POST['transaksi_jumlah'];
  $sisa =  $piutang-$jumlah ;

  $sql2 = "UPDATE subrogasi SET
            subrogasi_sisapiutang = '$sisa'
          WHERE subrogasi_id = '$_POST[subrogasi_id]'";

  $sql = "INSERT INTO transaksi (
            subrogasi_id,
            transaksi_sumberpenerimaan,
            transaksi_jenispenerimaan,
            transaksi_norekjamkrindo,
            transaksi_namarekjamkrindo,
            transaksi_bankjamkrindo,
            transaksi_norekbank,
            transaksi_namarekbank,
            transaksi_bank,
            transaksi_jumlah,
            transaksi_nobukti,
            transaksi_created )
          VALUES (
            '$_POST[subrogasi_id]',
            '$_POST[transaksi_sumberpenerimaan]',
            '$_POST[transaksi_jenispenerimaan]',
            '$transaksi_norekbank',
            '$_POST[transaksi_namarekjamkrindo]',
            '$transaksi_bankjamkrindo',
            '$_POST[transaksi_norekbank]',
            '$_POST[transaksi_namarekbank]',
            '$_POST[transaksi_bank]',
            '$_POST[transaksi_jumlah]',
            '$_POST[transaksi_nobukti]',
            '$date')";
if (mysql_query($sql)) {
  if (mysql_query($sql2)) {
    header('location:../../media.php?module='.$module.'&id='.$_POST['subrogasi_id']);
  }
}
  } else {
    
   
    ?>
    <script>
        alert("Jumlah Pembayaran melebihi Sisa Piutang!");
        document.location = 'http://localhost/subrogasi/admin/media.php?module=subrogasi';
    </script>
    <?php 
  }
}

?>
