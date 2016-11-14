<?php


function localReportMenuControl($localPageName){
	$content = '<div style="margin-right: 200px; !important" align="right"><form>';
	$content .= '<input class="MyButton" type="button" value="Input" onclick="window.location.href=\'/travelelo/index.php?act=input\'" />';
	$content .= '</form></div>'; 
	// '<div style="margin-right: 200px; !important" align="right"><a href="/travelelo/index.php?act=report">Report</a></div>';
	echo $content;
	localReportForm();  
	

}
function localReportForm()
{	
	$formName = "formReport"; 
	$content = "<div  style='margin: auto; width: 80%;  padding: 10px;'>"; 
	$content .= "<fieldset>"; 
	$content .= "<legend>Filter Report</legend>";
	// $content .= '<form style="display:none;"  method="post" name="'.$formName.'" id="'.$formName.'"
	$content .= '<form   method="post" name="'.$formName.'" id="'.$formName.'"
			action="'.$_SERVER['PHP_SELF'].'?act=report" enctype="multipart/form-data" class="form" novalidate="novalidate">';
	$content .= localAddEditReport('1','',$formName,'1');
	$content .= "</form>";
	$content .= "</fieldset><br/><br/>";	
	$content .= "</div>";	
	
	echo $content;
};
function localAddEditReport($tipe,$no,$formName){
	
	$content = '<table class="reportTbl ReportTable" width="100%">';
	$content .= '<tr><td class="fkey" width="25%">Periode Pengeluaran</td><td>';
	
	$content .= 'Bulan&nbsp;&nbsp;<select id="ddrBulan" name="ddrBulan" style="width:100px;">';
	$content .= '<option value="01" '.chsel('01',date('m'),'2').'>Januari</option>';
	$content .= '<option value="02" '.chsel('02',date('m'),'2').'>Februari</option>';
	$content .= '<option value="03" '.chsel('03',date('m'),'2').'>Maret</option>';
	$content .= '<option value="04" '.chsel('04',date('m'),'2').'>April</option>';
	$content .= '<option value="05" '.chsel('05',date('m'),'2').'>Mei</option>';
	$content .= '<option value="06" '.chsel('06',date('m'),'2').'>Juni</option>';
	$content .= '<option value="07" '.chsel('07',date('m'),'2').'>Juli</option>';
	$content .= '<option value="08" '.chsel('08',date('m'),'2').'>Agustus</option>';
	$content .= '<option value="09" '.chsel('09',date('m'),'2').'>September</option>';
	$content .= '<option value="10" '.chsel('10',date('m'),'2').'>Oktober</option>';
	$content .= '<option value="11" '.chsel('11',date('m'),'2').'>November</option>';
	$content .= '<option value="12" '.chsel('12',date('m'),'2').'>Desember</option>';
	$content .= '</select>&nbsp;&nbsp;&nbsp;';
	
	$content .= 'Tahun&nbsp;&nbsp;<select id="ddrTahun" name="ddrTahun" style="width:70px;">';
	$qTahun = "SELECT DISTINCT DATE_FORMAT(tgl_invoice, '%Y') AS tahun FROM invoice_tbl ;";
	$queryTahun = sql_query($qTahun); 
	while($rowTahun=sql_fetchrow($queryTahun)){
		$content .= '<option value="'.$rowTahun['tahun'].'">'.$rowTahun['tahun'].'</option>';
	} 
	$content .= '</select>';
	
	$content .= '</td></tr>';
	$content .= '<tr><td class="fkey" width="25%">Tipe</td><td>';
	$content .= '<select id="ddrTipe" name="ddrTipe" style="width:100px;">';
	$content .= '<option value="2" selected>All</option>';
	$content .= '<option value="1" >Settled</option>';
	$content .= '<option value="0" >Unsettled</option>';
	$content .= '</select>&nbsp;&nbsp;&nbsp;';
	
	$content .= '<tr><td colspan="2">&nbsp;</td></tr>';
	$content .= '<tr><td class="fkey" colspan="2" style="text-align:center;"><input type="button" id="btnPrint" value="Print" class="btn btnPrint" onclick=\'localJsPrintReport();\'>';
	$content .= '</table>';
	return $content;

}

function localPrintReport($bulan, $tahun, $tipe){
	$printpage = "<page>";
	$printpage .= "<html>";
	$printpage .= "<head>";
	$printpage .= '<link href="css/custom.css" rel="stylesheet" type="text/css" />';
	$printpage .= "</head>";
	$printpage .= "<body>";
	$printpage .= '<img src="../images/logo.png" width="182" height="45"><br /><br />';
	$printpage .= '<div style="text-align:center;">';
	$printpage .= '<h2>REPORT '.getBulan($bulan).'</h2>';
	$printpage .= '</div><br />';
	
	
	$printpage .= '<table style="width:100%;" border="1" cellspacing="0" cellpadding="0">';
	$printpage .= '<tr><td style="text-align:center; width:5%;"><b>No.</b></td>';
	$printpage .= '<td style="text-align:center; width:15%;"><b>Tanggal<br />Invoice</b></td>';
	$printpage .= '<td style="text-align:center; width:20%;"><b>No. Invoice</b></td>';
	$printpage .= '<td style="text-align:center; width:15%;"><b>Status</b></td>';
	$printpage .= '<td style="text-align:center; width:15%;"><b>Amount</b></td>';
	$printpage .= '<td style="text-align:center; width:15%;"><b>Profit</b></td>';
	$printpage .= '<td style="text-align:center; width:15%;"><b>Marketing<br />Fee</b></td>';
	$printpage .= '</tr>';
	$qQuery = "SELECT b.tgl_invoice, b.no_invoice, (SUM(a.harga_asli) + SUM(a.markup)) AS amount, 
				(SUM(a.markup) - SUM(a.fee_azhar)) AS profit, SUM(a.fee_azhar) AS fee,
				IF(b.status = '0' , 'Unsettled', 'Settled') AS STATUS
				FROM detail_tbl a LEFT JOIN invoice_tbl b ON a.no_invoice = b.no_invoice
				WHERE DATE_FORMAT(b.tgl_invoice,  '%m') = '$bulan' AND DATE_FORMAT(b.tgl_invoice,  '%Y') = '$tahun'";
	if($tipe <> '2') $qQuery .= " AND b.status = '$tipe' ";
	$qQuery .= "GROUP BY a.no_invoice ORDER BY b.no_invoice DESC";
	// echo $qQuery;
	$qDetail = sql_query($qQuery);
	$i=0;
	$totalsettled = 0;
	$totalunsettled = 0;
	$totalprofit = 0;
	$totalfee = 0;
	while($rowDetail = sql_fetchrow($qDetail)){
		$i++;
		if($rowDetail['STATUS'] == "Settled") $totalsettled = $totalsettled + $rowDetail['amount'];
		else $totalunsettled = $totalunsettled + $rowDetail['amount'];
		$totalprofit = $totalprofit + $rowDetail['profit'];
		$totalfee = $totalfee + $rowDetail['fee'];
		$printpage .= '<tr><td style="text-align:center;">'.$i.'</td>';
		$printpage .= '<td style="text-align:center;">'.getDMYFormatDateShort($rowDetail['tgl_invoice']).'</td>';
		$printpage .= '<td style="text-align:center;">'.$rowDetail['no_invoice'].'</td>';
		$printpage .= '<td style="text-align:center;">'.$rowDetail['STATUS'].'</td>';
		$printpage .= '<td style="text-align:center;">Rp. '.number_format($rowDetail['amount'],0).'</td>';
		$printpage .= '<td style="text-align:center;">Rp. '.number_format($rowDetail['profit'],0).'</td>';
		$printpage .= '<td style="text-align:center;">Rp. '.number_format($rowDetail['fee'],0).'</td>';
		$printpage .= '</tr>';
		
	}
	if($tipe == '1') $printpage .= '<tr><td colspan="4" style="text-align:center; font-weight:bold;" >TOTAL</td><td style="text-align:center;">Rp. '.number_format($totalsettled,0).'</td>';
	else if($tipe == '0') $printpage .= '<tr><td colspan="4" style="text-align:center; font-weight:bold;" >TOTAL</td><td style="text-align:center;">Rp. '.number_format($totalunsettled,0).'</td>';
	else if($tipe == '2') $printpage .= '<tr><td colspan="4" style="text-align:center; font-weight:bold;" >TOTAL</td><td style="text-align:center;">Rp. '.number_format($totalunsettled,0).'</td>';
	$printpage .= '<td style="text-align:center;">Rp. '.number_format($totalprofit,0).'</td><td style="text-align:center;">Rp. '.number_format($totalfee,0).'</td></tr></table><br /><br />';
	
	if($tipe == '2'){
		$printpage .= 'Total Settled : <b>Rp.'. number_format($totalsettled, 0). '</b>';
		$printpage .= '<br />Total Unsettled : <b>Rp.'. number_format($totalunsettled, 0). '</b>';
	}
	
 	
	$printpage .= "</body>";
	$printpage .= "</html>";
	$printpage .= "</page>";
	return $printpage;
}

function getBulanRomawi(){
	$bulan = date('m');
	switch ($bulan){
			case '01': $rom = 'I'; break;
			case '02': $rom = 'II'; break;
			case '03': $rom = 'III'; break;
			case '04': $rom = 'IV'; break;
			case '05': $rom = 'V'; break;
			case '06': $rom = 'VI'; break;
			case '07': $rom = 'VII'; break;
			case '08': $rom = 'VIII'; break;
			case '09': $rom = 'IX'; break;
			case '10': $rom = 'X'; break;
			case '11': $rom = 'XI'; break;
			case '12': $rom = 'XII'; break;
	}
	return $rom;
	
}
function getBulanShort(){
	$bulan = date('m');
	switch ($bulan){
			case '01': $rom = 'JAN'; break;
			case '02': $rom = 'FEB'; break;
			case '03': $rom = 'MAR'; break;
			case '04': $rom = 'APR'; break;
			case '05': $rom = 'MEI'; break;
			case '06': $rom = 'JUN'; break;
			case '07': $rom = 'JUL'; break;
			case '08': $rom = 'AGU'; break;
			case '09': $rom = 'SEP'; break;
			case '10': $rom = 'OKT'; break;
			case '11': $rom = 'NOV'; break;
			case '12': $rom = 'DES'; break;
	}
	return $rom;
	
}
function getBulan(){
	$bulan = date('m');
	switch ($bulan){
			case '01': $rom = 'JANUARI'; break;
			case '02': $rom = 'FEBRUARI'; break;
			case '03': $rom = 'MARET'; break;
			case '04': $rom = 'APRIL'; break;
			case '05': $rom = 'MEI'; break;
			case '06': $rom = 'JUNI'; break;
			case '07': $rom = 'JULI'; break;
			case '08': $rom = 'AGUSTUS'; break;
			case '09': $rom = 'SEPTEMBER'; break;
			case '10': $rom = 'OKTOBER'; break;
			case '11': $rom = 'NOVEMBER'; break;
			case '12': $rom = 'DESEMBER'; break;
	}
	return $rom;
	
}
function getReverseRomawi($rom){
	switch ($rom){
			case 'I': $bulan = '01'; break;
			case 'II': $bulan = '02'; break;
			case 'III': $bulan = '03'; break;
			case 'IV': $bulan = '04'; break;
			case 'V': $bulan = '05'; break;
			case 'VI': $bulan = '06'; break;
			case 'VII': $bulan = '07'; break;
			case 'VIII': $bulan = '08'; break;
			case 'IX': $bulan = '09'; break;
			case 'X': $bulan = '10'; break;
			case 'XI': $bulan = '11'; break;
			case 'XII': $bulan = '12'; break;
	}
	return $bulan;
	
}
  function getDMYFormatDateShort($datetime){
    $exp=explode(" ",$datetime);
    $ymd=explode("-",$exp[0]);
    if($ymd[1]=="01"){$bulan="Jan";}
    else if($ymd[1]=="02"){$bulan="Feb";}
    else if($ymd[1]=="03"){$bulan="Mar";}
    else if($ymd[1]=="04"){$bulan="Apr";}
    else if($ymd[1]=="05"){$bulan="Mei";}
    else if($ymd[1]=="06"){$bulan="Jun";}
    else if($ymd[1]=="07"){$bulan="Jul";}
    else if($ymd[1]=="08"){$bulan="Agu";}
    else if($ymd[1]=="09"){$bulan="Sep";}
    else if($ymd[1]=="10"){$bulan="Okt";}
    else if($ymd[1]=="11"){$bulan="Nov";}
    else if($ymd[1]=="12"){$bulan="Des";}
    $dmy[0]=$ymd[2];
    $dmy[1]=$bulan;
    $dmy[2]=$ymd[0];
    $dmyFormat=implode(" ",$dmy);
    return $dmyFormat;
  }
  function getDMYFormatDate2($datetime,$time=""){
	  $bulan = '';
    $exp=explode(" ",$datetime);
    $ymd=explode("-",$exp[0]);
    if($ymd[1]=="01"){$bulan="Januari";}
    else if($ymd[1]=="02"){$bulan="Februari";}
    else if($ymd[1]=="03"){$bulan="Maret";}
    else if($ymd[1]=="04"){$bulan="April";}
    else if($ymd[1]=="05"){$bulan="Mei";}
    else if($ymd[1]=="06"){$bulan="Juni";}
    else if($ymd[1]=="07"){$bulan="Juli";}
    else if($ymd[1]=="08"){$bulan="Agustus";}
    else if($ymd[1]=="09"){$bulan="September";}
    else if($ymd[1]=="10"){$bulan="Oktober";}
    else if($ymd[1]=="11"){$bulan="November";}
    else if($ymd[1]=="12"){$bulan="Desember";}
    $dmy[0]=$ymd[2];
    $dmy[1]=$bulan;
    $dmy[2]=$ymd[0];
    $dmyFormat=implode(" ",$dmy);
    if($time==1)$dmyFormat.=" - $exp[1]";
    return $dmyFormat;
  }
  function chsel($val,$inp,$tipe)
  {	$ya='';
	if($val==$inp) { if($tipe=='1') $ya='checked'; else if($tipe=='2') $ya='selected'; }
  	else $ya=='';
	return $ya;
  }
?>