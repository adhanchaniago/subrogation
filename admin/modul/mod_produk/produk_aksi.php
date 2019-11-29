<?php
include "../../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

$date = date("Y-m-d H:i:s");

// Hapus
if ($module=='produk' AND $act=='hapus'){
  $sql = "DELETE FROM product
          WHERE product_id = '$_GET[id]'";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Tambah
elseif ($module=='produk' AND $act=='tambah'){

  $sql = "INSERT INTO product (
            product_name,
            product_created )
          VALUES (
            '$_POST[product_name]',
            '$date')";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}

// Ubah
elseif ($module=='produk' AND $act=='edit'){
  $sql = "UPDATE product SET
            product_name  = '$_POST[product_name]'
          WHERE product_id = '$_POST[product_id]'";

  if (mysql_query($sql)) {
    header('location:../../media.php?module='.$module);
  }
}
?>
