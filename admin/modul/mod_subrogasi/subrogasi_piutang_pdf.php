<?php
session_start();
ob_start();
include_once("../../../config/koneksi.php");
include "../../../config/fungsi_indotgl.php";
include "../../../config/fungsi_rupiah.php";

$query  = mysql_query("SELECT * FROM subrogasi WHERE subrogasi_sisapiutang > 0");
$data   = mysql_fetch_array($query);

?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Subrogasi Piutang</title>
</head>
<body>


			<div class="title">Piutang Subrogasi</div>
			<div class="center">
								<table class="border">
									<thead>
										<tr>
											<th width="20">#</th>
											<th>Nama</th>
											<th>Nomor SP</th>
											<th>Bank</th>
											<th>Piutang <br />Subrogasi</th>
											<th>Sisa Piutang<br /> Subrogasi</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$result=mysql_query("SELECT * FROM subrogasi WHERE subrogasi_sisapiutang > 0");
										$jmldata = mysql_num_rows(mysql_query("SELECT * FROM subrogasi WHERE subrogasi_sisapiutang > 0"));
										if(mysql_num_rows($result) === 0) {
										?>
										<tr>
											<td  style="text-align:center" colspan="6">Data kosong...</td>
										</tr>
										<?php } else {
										$no = 1;
										while ($r=mysql_fetch_array($result)) {
										$tanggal=tgl_indo($r['subrogasi_tglklaim']);
										$totalpiutang=format_rupiah($r['subrogasi_totalpiutang']);
										$sisapiutang=format_rupiah($r['subrogasi_sisapiutang']);
										?>
										<tr>
											<td  style="text-align:center"><?php echo $no ?></td>
											<?php
											$result2 =mysql_query("SELECT * FROM debitur WHERE debitur_id='$r[debitur_id]'");
											$r2      = mysql_fetch_array($result2);
											$result3 =mysql_query("SELECT * FROM bank WHERE bank_id='$r[bank_id]'");
											$r3      = mysql_fetch_array($result3);
											$result4 =mysql_query("SELECT * FROM categorybank WHERE categorybank_id='$r3[categorybank_id]'");
											$r4      = mysql_fetch_array($result4);
											?>
											<td><?php echo $r2['debitur_name'] ?></td>
											<td><?php echo $r['subrogasi_nosp'] ?></td>
											<td><?php echo $r4['categorybank_name'] ?> <br /><?php echo $r3['bank_cabang'] ?></td>
											<td style="text-align:right">Rp<?php echo $totalpiutang ?>,00</td>
											<td style="text-align:right">Rp<?php echo $sisapiutang ?>,00</td>
											<?php $no++;
										 ?>
										</tr>
										<?php }
										}?>
									</tbody>
									<tbody>
										<tr>
											<?php
												$result = mysql_query('SELECT SUM(subrogasi_totalpiutang) AS subrogasi_totalpiutang FROM subrogasi WHERE subrogasi_sisapiutang > 0'); 
												$result2 = mysql_query('SELECT SUM(subrogasi_sisapiutang) AS subrogasi_sisapiutang FROM subrogasi WHERE subrogasi_sisapiutang > 0'); 
												$row = mysql_fetch_assoc($result); 
												$row2 = mysql_fetch_assoc($result2); 
												$sum = $row['subrogasi_totalpiutang'];
												$sum2 = $row2['subrogasi_sisapiutang'];
												$sum3 = $row['subrogasi_totalpiutang'] - $row2['subrogasi_sisapiutang'];
											?>
											<td colspan="5">Total Piutang yang belum dibayar</td>
											<td colspan="1">Rp<?php echo format_rupiah($sum2); ?>,00</td>
										</tr>
									</tbody>
								</table>


								</div>
</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename="Subrogasi Piutang.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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
