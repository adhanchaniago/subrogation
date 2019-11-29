<?php


	require_once "../../../config/PHPExcel.php";
	include "../../../config/koneksi.php";

/*start - BLOCK PROPERTIES FILE EXCEL*/
	$file = new PHPExcel ();
	$file->getProperties ()->setCreator ( "Admin" );
	$file->getProperties ()->setLastModifiedBy ( "Indonesia" );
	$file->getProperties ()->setTitle ( "Pembayaran Subrogasi" );
	$file->getProperties ()->setSubject ( "Pembayaran Subrogasi" );
	$file->getProperties ()->setDescription ( "Pembayaran Subrogasi" );
	$file->getProperties ()->setKeywords ( "Pembayaran Subrogasi" );
	$file->getProperties ()->setCategory ( "Subrogasi" );
/*end - BLOCK PROPERTIES FILE EXCEL*/

/*start - BLOCK SETUP SHEET*/
	$file->createSheet ( NULL,0);
	$file->setActiveSheetIndex ( 0 );
	$sheet = $file->getActiveSheet ( 0 );
	//memberikan title pada sheet
	$sheet->setTitle ( "Pembayaran Subrogasi" );
/*end - BLOCK SETUP SHEET*/

/*start - BLOCK HEADER*/

	$sheet	->setCellValue ( "A1", "Pembayaran Subrogasi" );
		$sheet	->setCellValue ( "D1", "List Pembayaran" );
	$sheet	->setCellValue ( "A2", "Nama" );
		$sheet	->setCellValue ( "A3", "Nomor SP" );
			$sheet	->setCellValue ( "A4", "Bank" );
				$sheet	->setCellValue ( "A5", "Cabang" );
					$sheet	->setCellValue ( "A6", "KCP" );
						$sheet	->setCellValue ( "A7", "Tanggal Keputusan Klaim" );
							$sheet	->setCellValue ( "A8", "Total Piutang" );
								$sheet	->setCellValue ( "A9", "Sisa Piutang" );
									$sheet	->setCellValue ( "A10", "Nilai Agunan" );

									$sheet	->setCellValue ( "D2", "No" );
									$sheet	->setCellValue ( "E2", "Tanggal" );
									$sheet	->setCellValue ( "F2", "No Bukti" );
									$sheet	->setCellValue ( "G2", "Angsuran" );
/*end - BLOCK HEADER*/

$sheet->getColumnDimension('A')->setWidth(30);
$sheet->getColumnDimension('B')->setWidth(40);


$sheet->getColumnDimension('C')->setWidth(20);

$sheet->getColumnDimension('D')->setWidth(20);

$sheet->getColumnDimension('E')->setWidth(20);

$sheet->getColumnDimension('F')->setWidth(20);

$sheet->getColumnDimension('G')->setWidth(20);

/* start - BLOCK MEMASUKAN DATABASE*/

$id   = $_GET['id'];
$subrogasi=mysql_query("SELECT * FROM subrogasi WHERE subrogasi_id='$_GET[id]'");
$s      = mysql_fetch_array($subrogasi);
	$nomor=2;
	$no=0;

		$result2=mysql_query("SELECT * FROM debitur WHERE debitur_id = $s[debitur_id]");
			while ($e=mysql_fetch_array($result2)) {
		$sheet	->setCellValue ( "B2", $e["debitur_name"] );
	}

$sheet	->setCellValue ( "B3", $s["subrogasi_nosp"] );

$result3=mysql_query("SELECT * FROM bank WHERE bank_id = $s[bank_id]");
while ($r=mysql_fetch_array($result3)) {
	$resul4=mysql_query("SELECT * FROM categorybank WHERE categorybank_id= $r[categorybank_id]");
		while ($r2=mysql_fetch_array($resul4)) {
	$sheet	->setCellValue ( "B4", $r2["categorybank_name"] );
$sheet	->setCellValue ( "B5", $r["bank_cabang"] );
$sheet	->setCellValue ( "B6", $r["bank_kcp"] );
		}
	}

	$sheet	->setCellValue ( "B7", $s["subrogasi_tglklaim"] );
		$sheet	->setCellValue ( "B8", $s["subrogasi_totalpiutang"] );
			$sheet	->setCellValue ( "B9", $s["subrogasi_sisapiutang"] );
				$sheet	->setCellValue ( "B10", $s["subrogasi_agunan"] );


				$transaksi=mysql_query("SELECT * FROM transaksi WHERE subrogasi_id='$_GET[id]'");
					while($row=mysql_fetch_array($transaksi)){
$nomor++;$no++;
						$sheet	->setCellValue ( "D".$nomor, $no );

						$sheet	->setCellValue ( "E".$nomor, $row["transaksi_created"] );

						$sheet	->setCellValue ( "F".$nomor, $row["transaksi_nobukti"] );

						$sheet	->setCellValue ( "G".$nomor, $row["transaksi_jumlah"] );

					}




/* end - BLOCK MEMASUKAN DATABASE*/

/* start - BLOCK MEMBUAT LINK DOWNLOAD*/
	header ( 'Content-Type: application/vnd.ms-excel' );
	//namanya adalah keluarga.xls
	header ( 'Content-Disposition: attachment;filename="Pembayaran Subrogasi.xlsx"' );
	header ( 'Cache-Control: max-age=0' );
	$writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
	$writer->save ( 'php://output' );
/* start - BLOCK MEMBUAT LINK DOWNLOAD*/

?>
