<?php

session_start();
include('../config/conn.php');
include('../function/sqlfunction.php');
require("../controller/input.php");

$po   = $_GET['po'];
if($po=="localAjSaveInput"){	echo localSaveInput(); }
if($po=="localAjDeleteInput"){	echo localDeleteInput($_GET['id']); }
if ($po === 'global_getrowkembali') {
	$id = $_GET['id'];
	$sql_code = "SELECT COUNT(1) AS row FROM detail_penjualan WHERE transaksi <> 'B' AND no_surat_balik = '$id'";
	$rs = sql_query($sql_code);
		$ray_code = sql_fetchrow($rs);
		echo json_encode($ray_code);
}

if($po=="global_getdatabandara") {
	$sqlBandara = sql_query("SELECT kode, keterangan from bandara_tbl ");
	$no = 1;
	while ($rayBandara = sql_fetchassoc($sqlBandara)) { 
		$codeBandara['bandara'][] = array("kode" => $rayBandara['kode'],"keterangan" => $rayBandara['keterangan']);
		$no++;
	}
	$codeBandara['status'] = 'success';
	echo json_encode($codeBandara);
}
if ($po === 'global_getcurrencyformat') {
	$harga = $_GET['harga'];
	$hasil['harga'] = number_format($harga,0);
	echo json_encode($hasil);
}

if($po=="localAjPrintInput") 
{		
	$printpage = localPrintInput($_GET['id']);
 	$nama_file = explode("/", $_GET['id']);
	require_once('../function/html2pdf/html2pdf.class.php');
			$html2pdf = new HTML2PDF('P','A4','en');
			//$html2pdf->pdf->SetProtection(array('print'),'', 'Orangesystem');
			// $html2pdf->pdf->SetFont('times', 'BI', 20, '', 'false');;
			// $html2pdf->WriteHTML(htmlspecialchars ($printpage));
			$html2pdf->WriteHTML($printpage);
			$html2pdf->Output($nama_file[0].$nama_file[1].$nama_file[2].$nama_file[3].'.pdf');
			
}
if($po=="localAjPrintGroup") 
{		
	$printpage = localPrintGroup($_GET['id']);
 	$nama_file = explode("/", $_GET['id']);
	require_once('../function/html2pdf/html2pdf.class.php');
			$html2pdf = new HTML2PDF('P','A4','en');
			//$html2pdf->pdf->SetProtection(array('print'),'', 'Orangesystem');
			// $html2pdf->pdf->SetFont('times', 'BI', 20, '', 'false');;
			// $html2pdf->WriteHTML(htmlspecialchars ($printpage));
			$html2pdf->WriteHTML($printpage);
			$html2pdf->Output($nama_file[0].$nama_file[1].'.pdf');
			
}
?>