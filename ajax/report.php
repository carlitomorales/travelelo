<?php

session_start();
include('../config/conn.php');
include('../function/sqlfunction.php');
require("../controller/report.php");

$po   = $_GET['po'];
if($po=="localAjPrintReport") 
{		
	$printpage = localPrintReport($_GET['bulan'],$_GET['tahun'],$_GET['tipe']);
	require_once('../function/html2pdf/html2pdf.class.php');
			$html2pdf = new HTML2PDF('P','A4','en');
			//$html2pdf->pdf->SetProtection(array('print'),'', 'Orangesystem');
			// $html2pdf->pdf->SetFont('times', 'BI', 20, '', 'false');;
			// $html2pdf->WriteHTML(htmlspecialchars ($printpage));
			$html2pdf->WriteHTML($printpage);
			$html2pdf->Output('Travelelo-'.$_GET['bulan'].$_GET['tahun'].'.pdf');
			
}
?>