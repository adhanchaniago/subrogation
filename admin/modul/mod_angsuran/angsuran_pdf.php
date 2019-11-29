<?php
session_start();
ob_start();
include_once("../../../config/koneksi.php");
include "../../../config/fungsi_indotgl.php";
include "../../../config/fungsi_rupiah.php";

$id   = $_GET['id'];
$query  = mysql_query("SELECT * FROM transaksi WHERE subrogasi_id='".$id."'");
$data   = mysql_fetch_array($query);

?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $data['transaksi_id']; ?></title>
</head>
<body>

<?php
$subrogasi=mysql_query("SELECT * FROM subrogasi WHERE subrogasi_id='$_GET[id]'");
$s      = mysql_fetch_array($subrogasi);
$tanggal=tgl_indo($s['subrogasi_tglklaim']);
$totalpiutang=format_rupiah($s['subrogasi_totalpiutang']);
$sisapiutang=format_rupiah($s['subrogasi_sisapiutang']);
$agunan=format_rupiah($s['subrogasi_agunan']);
?>
<div class="title">
	Detail Pembayaran Subrogasi
</div>
	<div class="center">
							<table class="table">
								<tbody>
									<tr>
										<td>Nama</td>
										<td>:</td>
										<?php
										$result2=mysql_query("SELECT * FROM debitur WHERE debitur_id = $s[debitur_id]");
											while ($e=mysql_fetch_array($result2)) {
												?>
										<td class="detail"><?php echo $e['debitur_name'] ?></td>
										<?php } ?>
									</tr>
									<tr>
										<td>Nomor SP</td>
										<td>:</td>
										<td><?php echo $s['subrogasi_nosp'] ?></td>
									</tr>
									<tr>
										<td>Kreditur</td>
										<td>:</td>
										<?php
										$result2=mysql_query("SELECT * FROM bank WHERE bank_id = $s[bank_id]");
											while ($e=mysql_fetch_array($result2)) {
												$result4 =mysql_query("SELECT * FROM categorybank WHERE categorybank_id='$e[categorybank_id]'");
												$r4      = mysql_fetch_array($result4);
												?>
										<td><?php echo $r4['categorybank_name'] ?> <?php echo $e['bank_cabang']; ?></td>
										<?php } ?>
									</tr>
									<tr>
										<td>Tanggal Keputusan Klaim</td>
										<td>:</td>
										<td><?php echo $tanggal ?></td>
									</tr>
									<tr>
										<td>Total Piutang Subrogasi</td>
										<td>:</td>
										<td>Rp<?php echo $totalpiutang ?>,00</td>
									</tr>
									<tr>
										<td>Sisa Piutang Subrogasi</td>
										<td>:</td>
										<td>Rp<?php echo $sisapiutang ?>,00</td>
									</tr>
									<tr>
										<td width="200">Nilai Agunan</td>
										<td>:</td>
										<td>Rp<?php echo $agunan ?>,00</td>
									</tr>
								</tbody>
							</table>
														<table class="border">
															<thead>
																<tr>
																	<th width="30">#</th>
																	<th width="120">Tanggal</th>
																	<th width="200">No Bukti</th>
																	<th width="180">Angsuran</th>
																</tr>
															</thead>
															<tbody>
															<?php
																$result=mysql_query("SELECT * FROM transaksi WHERE subrogasi_id='$_GET[id]'");
																$jmldata = mysql_num_rows(mysql_query("SELECT * FROM transaksi WHERE subrogasi_id='$_GET[id]'"));
																if(mysql_num_rows($result) === 0) {
																?>
																<tr>
																	<td style="text-align:center" colspan="4">Data kosong...</td>
																</tr>
																<?php } else {
																$no = 1;
																while ($r=mysql_fetch_array($result)) {
																$tanggal=tgl_indo($r['transaksi_created']);


																$angsuran=format_rupiah($r['transaksi_jumlah']);
																?>

																<tr>
																	<td class="center"><?php echo $no ?></td>
																	<td class="text-center"><?php echo $tanggal ?></td>
																	<td><?php echo $r['transaksi_nobukti'] ?></td>
																	<td>Rp<?php echo $angsuran ?>,00</td>
																	<?php $no++;
																 ?>
																</tr>
																<?php }
																}?>
															</tbody>
														</table>
													</div>

</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename="Pembayaran Subrogasi -".$id.".pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
//Copy dan paste langsung script dibawah ini,untuk mengetahui lebih jelas tentang fungsinya silahkan baca-baca tutorial tentang HTML2PDF
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';
$content .= "<style>\n " . file_get_contents('pdf.css') . "</style>";

 require_once(dirname(__FILE__).'../../../../config/html2pdf/html2pdf.class.php');
 try
 {
  $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(15, 10, 15, 10));
  $html2pdf->setDefaultFont('Arial');
  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
  $html2pdf->Output($filename);
 }
 catch(HTML2PDF_exception $e) { echo $e; }
?>
