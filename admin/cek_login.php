<?php
include "../config/koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$login=mysql_query("SELECT * FROM admin WHERE admin_username='$username' AND admin_password='$password'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();

  $_SESSION[username]   = $r[admin_username];
  $_SESSION[name]       = $r[admin_name];
  $_SESSION[password]   = $r[admin_password];
  $_SESSION[level]      = $r[admin_level];

	$sid_lama = session_id();

	session_regenerate_id();

	$sid_baru = session_id();

  mysql_query("UPDATE admin SET admin_session='$sid_baru' WHERE admin_username='$username'");
  header('location:media.php?module=home');
}
else{
  header('location:index.php');
}
?>
