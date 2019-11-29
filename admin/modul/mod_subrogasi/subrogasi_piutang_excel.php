<?php


	require_once "../../../config/PHPExcel.php";
	include "../../../config/koneksi.php";

/*start - BLOCK PROPERTIES FILE EXCEL*/
	$file = new PHPExcel ();
	$file->getProperties ()->setCreator ( "Admin" );
	$file->getProperties ()->setLastModifiedBy ( "Indonesia" );
	$file->getProperties ()->setTitle ( "Piutang Subrogasi" );
	$file->getProperties ()->setSubject ( "Piutang Subrogasi" );
	$file->getProperties ()->setDescription ( "Piutang Subrogasi" );
	$file->getProperties ()->setKeywords ( "Piutang Subrogasi" );
	$file->getProperties ()->setCategory ( "Subrogasi" );
/*end - BLOCK PROPERTIES FILE EXCEL*/

/*start - BLOCK SETUP SHEET*/
	$file->createSheet ( NULL,0);
	$file->setActiveSheetIndex ( 0 );
	$sheet = $file->getActiveSheet ( 0 );
	//memberikan title pada sheet
	$sheet->setTitle ( "Piutang Subrogasi" );
/*end - BLOCK SETUP SHEET*/

/*start - BLOCK HEADER*/
	$sheet	->setCellValue ( "A1", "No" );
	$sheet	->setCellValue ( "B1", "Nama" );
	$sheet	->setCellValue ( "C1", "Nomor SP" );
	$sheet	->setCellValue ( "D1", "Bank" );
	$sheet	->setCellValue ( "E1", "Cabang" );
	$sheet	->setCellValue ( "F1", "KCP" );
	$sheet	->setCellValue ( "G1", "Piutang Subrogasi" );
	$sheet	->setCellValue ( "H1", "Sisa Piutang Subrogasi" );
/*end - BLOCK HEADER*/

$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('C')->setWidth(20);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(20);
$sheet->getColumnDimension('F')->setWidth(20);
$sheet->getColumnDimension('G')->setWidth(20);
$sheet->getColumnDimension('H')->setWidth(20);

/* start - BLOCK MEMASUKAN DATABASE*/
	$result=mysql_query("SELECT * FROM subrogasi WHERE subrogasi_sisapiutang > 0");
	$nomor=1;
	$no=0;
	while($row=mysql_fetch_array($result)){
		$nomor++;$no++;
		$sheet	->setCellValue ( "A".$nomor, $no );
		$result2=mysql_query("SELECT * FROM debitur WHERE debitur_id = $row[debitur_id]");
		while($row2=mysql_fetch_array($result2)){
		$sheet	->setCellValue ( "B".$nomor, $row2["debitur_name"] );
		}
		$sheet	->setCellValue ( "C".$nomor, $row["subrogasi_nosp"] );

		$result3=mysql_query("SELECT * FROM bank WHERE bank_id = $row[bank_id]");
		while ($r=mysql_fetch_array($result3)) {
			$resul4=mysql_query("SELECT * FROM categorybank WHERE categorybank_id= $r[categorybank_id]");
				while ($r2=mysql_fetch_array($resul4)) {
			$sheet	->setCellValue ( "D".$nomor, $r2["categorybank_name"] );
		$sheet	->setCellValue ( "E".$nomor, $r["bank_cabang"] );
	$sheet	->setCellValue ( "F".$nomor, $r["bank_kcp"] );
				}
			}
			$total =$row["subrogasi_totalpiutang"];

			$sisa = $row["subrogasi_sisapiutang"];

$sheet	->setCellValue ( "G".$nomor, $total );
$sheet	->setCellValue ( "H".$nomor, $sisa );
	}
/* end - BLOCK MEMASUKAN DATABASE*/

/* start - BLOCK MEMBUAT LINK DOWNLOAD*/
	header ( 'Content-Type: application/vnd.ms-excel' );
	//namanya adalah keluarga.xls
	header ( 'Content-Disposition: attachment;filename="Piutang Subrogasi.xlsx"' );
	header ( 'Cache-Control: max-age=0' );
	$writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel2007' );
	$writer->save ( 'php://output' );
/* start - BLOCK MEMBUAT LINK DOWNLOAD*/

?>
