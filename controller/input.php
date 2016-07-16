<?php

// require_once 'includes/template_menu.php';

global $tipeUrl;
$tipeUrl = $_GET['tipeUrl'];


function localInputMenuControl($localPageName){
	global $tipeUrl; 
	$tipeUrl=$_GET[tipeUrl];	
	
	localInputMenuButton($localPageName);

	LocalInputForm();  
	

}

function localInputMenuButton($localPageName)
{	global $tipeUrl, $key;
	// $buttCetak .= "<input value='Cetak Data Dispenser' class='buttonprint' style='width:150px;font-weight:bold' type='button' 
		   // onclick=\"localJsPrintDispenser();\">";
	// echo "<hr>".$buttCetak."<hr>";
	if($submenuTitle){
		// $rom = getBulanRomawi();
		echo "<div style='margin-left: 320px; !important' align='right'><a href='/dra/index.php?act=suratjalan'><< Kembali ke halaman Surat Jalan</a></div>";
		echo "<div><h4 class='boxTitle' style='margin-top: 0px;'>INPUT ORDER</h4></div>";
	}
}

function LocalInputForm()
{	global $tipeUrl;
	if($_POST['txtNamaPelanggan'])	localSaveInput($_POST['hdid'],$_POST['hdidjalan'],$_POST['hdtipe']);
	
	$formName = "formInput"; //action='".$_SERVER['PHP_SELF']."?act=WageCode&tipeUrl=addnew'
	// $content = "<div class='col-md-10 col-md-offset-1' >"; 
	$content = "<div  style='margin: auto; width: 80%;  padding: 10px;'>"; 
	$content .= "<fieldset>"; 
	// $content .= "<legend style='cursor:pointer'>Buat Surat Balik</legend>"; localResetSuratJalan();
	$content .= "<legend onclick=' Effect.toggle(\"$formName\",\"slide\");' style='cursor:pointer'>Input Order</legend>";
	// $content .= '<form   method="post" name="'.$formName.'" id="'.$formName.'"
	$content .= '<form style="display:none;"  method="post" name="'.$formName.'" id="'.$formName.'"
			action="'.$_SERVER['PHP_SELF'].'?act=input" enctype="multipart/form-data" class="form" novalidate="novalidate">';
	$content .= localAddEditInput('1','',$formName);
	$content .= "</form>";
	$content .= "</fieldset><br/><br/>";	
	$content .= "</div>";	
	
	$content .= ViewListInput($formName);
	echo $content;
};
function localAddEditInput($tipe,$no,$formName){
	// $content .= "<input type=hidden value='$page' name='p' id='p'>";
	$content = "<input type=hidden value='$tipe' name='hdtipe' id='hdtipe'>";
	
	
	
	$qLast = "SELECT MAX(IFNULL(CAST(SUBSTR(no_invoice, -3) AS UNSIGNED),0)) AS LAST FROM invoice_tbl WHERE MONTH(tgl_invoice) = DATE_FORMAT(NOW(),'%m')";
	$sLast = sql_query($qLast); 
	$rLast = sql_fetchrow($sLast);

	$next = $rLast['LAST'] + 1; 
	if($next < 10) $next = '00' . $next; 
	else if($next < 100) $next = '0' . $next; 
	
	$no_invoice = "INV/".date('Y')."/".getBulanShort(date('m'))."/".$next;
	$content = "<input type=hidden value='$no_invoice' name='hdid' id='hdid'>";
	if($tipe=='2') $readonly = "readonly"; else $readonly = "";
	
	$content .= '<table class="reportTbl SuratBalikTable" width="100%">';
	$content .= '<tr height="30">';
	$content .= '<td class="fkey" width="10%">No. Invoice</td><td class="fkey" width="2%">:</td><td width="87%">'.$no_invoice.'</td>';
	$content .= '</tr>';
	$content .= '<tr height="30">';
	$content .= '<td class="fkey" width="10%">Tanggal Invoice</td><td class="fkey" width="2%">:</td><td width="87%"><input type=text name="txtTanggalInvoice" id="txtTanggalInvoice" size=20 readonly value="'.date('Y-m-d', time()).'">';
	$content .= "<a href=\"javascript:show_calendar('".$formName.".txtTanggalInvoice');\"  ><img src=\"images/calendar.gif\" border=0 align=absmiddle></a>";
	$content .= "<img src='images/return.gif' style='cursor:pointer'  onclick='$(txtTanggalInvoice).value=convertDate(Date())'> ";
	$content .= '</td>';
	$content .= '</tr>';
	$content .= '<tr><td class="fkey">Nama</td><td class="fkey" width="2%">:</td>';
	$content .= '<td><input type=text name="txtNamaPelanggan" id="txtNamaPelanggan" size=30 ></td>';
	$content .= '</tr>';
	$content .= '</table><br />';
	
	
	/* PENGEMBALIAN */
	$content .= '<table class="reportTbl SuratBalikTable" width="100%">';
	$content .= "<tr><th  colspan=6 style='background-color: #cccccc; text-align:center;'>Perjalanan</th></tr>";
	$content .= "<tr><td style='width:20%; text-align:center;' class='fkey'>Tanggal</td>";
	$content .= "<td class='fkey' style='width:10%; text-align:center;'>Asal</td>";
	$content .= "<td style='width:10%; text-align:center;' class='fkey' style='text-align:center;'>Tujuan</td>";
	$content .= "<td style='width:20%; text-align:center;' class='fkey' style='text-align:center;'>Harga Asli</td>";
	$content .= "<td style='width:20%; text-align:center;' class='fkey' style='text-align:center;'>Markup</td>";
	$content .= "<td style='width:20%; text-align:center;' class='fkey' style='text-align:center;'>Fee Azhar</td></tr>";
	$content .= "<tbody id=trTrip>";
	//listProduk
	// $qBeli = sql_query("SELECT id_produk, jumlah,transaksi,
					// IF(transaksi='P', 'Pinjam', kondisi_galon) AS kondisi_galon 
					// FROM detail_penjualan 
					// WHERE no_surat_balik = '$no' AND transaksi<>'B'");
	// $j=0;
	// while($rowBeli = sql_fetchrow($qBeli)){
		// $content .= '<tr id="RowProduk'.$j.'"><td width="22%" >'.listProduk($j,$rowBeli['id_produk']).'</td>';
		// $content .= '<td width="25%" align="center"><input type="text" name="txtJumlah[]" value="'.$rowBeli['jumlah'].'" class=txtJumlah class="forminput" id="txtJumlah['.$j.']" size=20 onkeypress="return isNumber(event);" ></td>';
		// $content .= '<td style="text-align:center;">';
		// $content .= '<select class="ddrKondisi" id="ddrKondisi['.$j.']" name="ddrKondisi[]" style="width:100px">';
		// $content .= '<option value="OK" '.chsel('OK',$rowBeli['kondisi_galon'],'2').'>OK</option>';
		// $content .= '<option value="Pecah" '.chsel('Pecah',$rowBeli['kondisi_galon'],'2').'>Pecah</option>';
		// $content .= '<option value="Bocor" '.chsel('Bocor',$rowBeli['kondisi_galon'],'2').'>Bocor</option>';
		// $content .= '<option value="Kotor" '.chsel('Kotor',$rowBeli['kondisi_galon'],'2').'>Kotor</option>';
		// $content .= '<option value="Bau" '.chsel('Bau',$rowBeli['kondisi_galon'],'2').'>Bau</option>';
		// $content .= '<option value="Pinjam" '.chsel('Pinjam',$rowBeli['kondisi_galon'],'2').'>Pinjam</option>';
		// $content .= '</select>&nbsp;&nbsp;&nbsp;';
		// $content .= '<a href="javascript:void(0)" class="btndelete" id="btndelete" data-row="'.$j.'"  onClick="$(this).closest(\'tr\').remove();"><img src="images/minus.png"></a>';
		// $content .= '</td></tr>';
		// $j++;
	// }
	$content .= "</tbody>";
	$content .= "<tbody id=trButton>";
	$content .= '<tr><td colspan="6" style="padding:5px 10px; text-align:left;"><a href="javascript:void(0)" onclick="addTrip_1();" class="addNew" id="addNew" data-row="1">Tambah Perjalanan</a></td></tr>';
	$content .= "</tbody></table><br />";
	
	$content .= '<table class="reportTbl SuratBalikTable" width="100%">';
	$content .= '<tr>';
	$content .= "<td class='fkey' width='40%'><input type='checkbox' name='chkResched' id='chkResched' class='checkboxes'  >&nbsp;&nbsp;Biaya Pemindahan Jadwal</td>";
	$content .= "<td width='20%'><input type='text'  name='txtHargaAsliR' id='txtHargaAsliR' size=25 onkeypress=\"return isNumber(event)\"  onkeyup=\"CurrencyFormat(this);\" placeholder='Harga Asli'  readonly></td>";
	$content .= "<td width='20%'><input type='text'  name='txtMarkupR' id='txtMarkupR' size=25 onkeypress=\"return isNumber(event)\"  onkeyup=\"CurrencyFormat(this);\" placeholder='Markup'  readonly></td>";
	$content .= "<td width='20%'><input type='text'  name='txtFeeAzharR' id='txtFeeAzharR' size=25 onkeypress=\"return isNumber(event)\"  onkeyup=\"CurrencyFormat(this);\" placeholder='Fee Azhar' readonly></td>";
	$content .= '<tr>';
	$content .= '</tr>';
	$content .= '</table><br />';
	
	$content .= '<table class="reportTbl SuratBalikTable" width="100%">';
	$content .= '<tr><td colspan="2">&nbsp;</td></tr>';
	$content .= '<tr><td class="fkey" colspan="2" style="text-align:center;"><input type="button" id="btnSaveInput" value="Simpan" class="btn btnSave" onclick=\'localJsSaveInput("'.$formName.'");\'>&nbsp;&nbsp;&nbsp;';
	$content .= "<input type='button' onclick='localResetSuratJalan(); Effect.toggle(\"".$formName."\",\"slide\");' class='btn btnCancel' value='Cancel' name='btnCancelSuratJalan' id='btnCancelSuratJalan'  >";
	$content .= '</table>';
	
	return $content;

}

function ViewListInput($form) {
		$InputQuery="SELECT a.no_invoice, a.tgl_invoice, a.nama, SUM(b.harga_asli) AS harga_asli, SUM(b.harga_asli+b.markup) AS harga_invoice
							FROM invoice_tbl a
							LEFT JOIN detail_tbl b ON a.no_invoice = b.no_invoice
							GROUP BY b.no_invoice ";
		$InputQuery .= " ORDER BY a.tgl_invoice DESC";					
		$stmt = sql_query($InputQuery);
		
		$content = "<div  style='margin: auto; width: 80%;  padding: 10px;'>"; 
		$content .= 
		'<table width="80%" class="display" id="tableinput" >
		<thead>
			<tr align="center">
				<th>No. Invoice</th>
				<th>Tanggal<br />Invoice</th>
				<th>Nama</th>
				<th>Total Harga<br />Asli</th>
				<th>Total Harga<br />Invoice</th>
				<th>Tindakan</th>
			</tr></thead>';
			$content .= '<tbody>';
		$i=0;
		while($row=sql_fetchrow($stmt))
		{ $i++; 
		$content .="<tr><td align=\"center\">".$row['no_invoice']."</td>
						<td align=\"center\">".getDMYFormatDateShort($row['tgl_invoice'])."</td>
						<td align=\"center\">".$row['nama']."</td>";
		$content .="<td align=\"center\">Rp. ".number_format($row['harga_asli'],0)."</td>";
		$content .="<td align=\"center\">Rp. ".number_format($row['harga_invoice'],0)."</td>";
		$content .= "<td style='text-align:center'>";
		$content .= localInputAction($row['no_invoice']);
		$content .= "</td>";
		$content .="</tr>";
						  
		}
		//if($i=='0') $content .= '<tr><td colspan="9" class="fb12" align="center" bgcolor="#d4e8f6">Data tidak ditemukan</td></tr>';
		
		$content .= '</tbody>';
		$content .= '</table></div><br><br>';
		return $content;
}


function localInputAction($id)
{	
	$content.="
		<img src='images/print.gif' style='cursor:pointer' 
			onclick=\"localJsPrintInput('".$id."');\">
		";
	
	$content.="<img src='images/trash.png' style='cursor:pointer' onclick='localJsDeleteInput(\"".$id."\")'> ";			
		
	return $content;
}

function listProduk($row,$id) {
	$listSelect = '<select class="ddrproduk" id="ddrProdukKembali['.$row.']" name="ddrProdukKembali[]" data-produk="'.$row.'" style="width:140px;">';
	$sqlProduk = "SELECT id_produk, nama_produk,keterangan from produk ORDER BY id_produk ASC";

	$qProduk = sql_query($sqlProduk);
		$no = 1;
		while ($rayproduk = sql_fetchassoc($qProduk)) {
				$listSelect .= '<option value="'.$rayproduk['id_produk'].'" '.chsel($rayproduk['id_produk'],$id,'2').'>'.$rayproduk['nama_produk'].'</option>';
		$no++;
		}
	$listSelect .= '</select>';

	return $listSelect;
}

function localSaveInput()
{	
		$sukses='1';
		if($sukses=='1') {
				$query = "INSERT INTO `travelelo`.`invoice_tbl` 
						(`no_invoice`, `tgl_invoice`, `nama`
						)
						VALUES
						('".$_POST['hdid']."', '".$_POST['txtTanggalInvoice']."', '".$_POST['txtNamaPelanggan']."'); ";
				
				// list($jumlahProduk) = sql_fetchrow(sql_query("SELECT COUNT(id_produk) FROM produk ORDER BY id_produk"));
				$totalbeli=0;
				for($x=0;$x<count($_POST['txtTanggal']);$x++){
						$querydtl[] = "INSERT INTO `travelelo`.`detail_tbl` 
							(`no_invoice`, `jenis`, 
							`tanggal_flight`, `asal`, `tujuan`,
							`harga_asli`, `markup`, `fee_azhar`
							)
							VALUES
							('".$_POST['hdid']."', '0', 
							'".$_POST['txtTanggal'][$x]."', '".$_POST['ddrAsal'][$x]."', '".$_POST['ddrTujuan'][$x]."', 
							'".str_replace(',', '', $_POST['txtHargaAsli'][$x])."', '".str_replace(',', '', $_POST['txtMarkup'][$x])."', '".str_replace(',', '', $_POST['txtFeeAzhar'][$x])."'
							);";
				}
				
				if(isset($_POST['chkResched'])) {
				$querydtl[] = "INSERT INTO `travelelo`.`detail_tbl` 
					(`no_invoice`, `jenis`, 
					`tanggal_flight`, `asal`, `tujuan`,
					`harga_asli`, `markup`, `fee_azhar`
					)
					VALUES
					('".$_POST['hdid']."', '1', 
					'', '', '', 
					'".str_replace(',', '', $_POST['txtHargaAsliR'])."', '".str_replace(',', '', $_POST['txtMarkupR'])."', '".str_replace(',', '', $_POST['txtFeeAzharR'])."' 
					);";
				}					
			
			if(sql_query($query)) 
			{
				for($z=0;$z<count($querydtl);$z++){//print_r ($querydtl[$z]);
						if(sql_query($querydtl[$z])) {
						$sukses='2';
						
						}
						else{ $sukses='1';}
				}
			}
			else $sukses='1';
		}
		echo ($sukses);
	
}
function localDeleteInput($id)
{	
			
	$querydtl[] = "DELETE FROM `travelelo`.`invoice_tbl` WHERE `no_invoice` = '".$id."'";
	$querydtl[] = "DELETE FROM `travelelo`.`detail_tbl` WHERE `no_invoice` = '".$id."'";
			
			
			
				for($z=0;$z<count($querydtl);$z++){//print_r ($querydtl[$z]);
						if(sql_query($querydtl[$z])) {
						$sukses='2';
						
						}
						else{ $sukses='1';}
				}
		
		echo $sukses;
	
}

function localPrintInput($id){
	$printpage .= "<page>";
	$printpage .= "<html>";
	$printpage .= "<head>";
	$printpage .= '<link href="css/custom.css" rel="stylesheet" type="text/css" />';
	$printpage .= "</head>";
	$printpage .= "<body>";
	$printpage .= '<img src="../images/logo.png" width="182" height="45"><br /><br />';
	$printpage .= '<div style="text-align:right;">';
	$printpage .= 'Travelelo<br />';
	$printpage .= 'Jl. Belimbing no. 20 RT 14 / RW 01<br />';
	$printpage .= 'Jagakarsa, Jakarta Selatan<br />';
	$printpage .= 'saidiskandar1988@gmail.com<br />';
	$printpage .= 'Tel: 08128773770<br />';
	$printpage .= '</div><br />';
	
	$qInvoice = "SELECT no_invoice, date_format(`tgl_invoice`, '%d-%m-%Y') as tgl_invoice, nama FROM invoice_tbl WHERE no_invoice = '".$id."';";
	$queryInvoice = sql_query($qInvoice); 
	$row=sql_fetchrow($queryInvoice);
	$printpage .= '<div style="text-align:left; background-color:aquamarine;">';
	$printpage .= '<table style="width:100%;" border="0" cellspacing="0" cellpadding="0">';
	$printpage .= '<tr><td style="width:15%">Invoice No.</td><td style="width:2%">:</td><td>'.$row['no_invoice'].'</td></tr>';
	$printpage .= '<tr><td>Invoice Date.</td><td>:</td><td>'.getDMYFormatDate2($row['tgl_invoice']).'</td></tr>';
	$printpage .= '<tr><td>Nama</td><td>:</td><td>'.$row['nama'].'</td></tr>';
	$printpage .= '</table>';
	$printpage .= '</div><br />';
	
	$printpage .= '<table style="width:100%;" border="1" cellspacing="0" cellpadding="0">';
	$printpage .= '<tr><td style="text-align:center; width:70%;"><b>Item</b></td>';
	$printpage .= '<td style="text-align:center; width:30%;"><b>Price</b></td>';
	$printpage .= '</tr>';
	$qDetail = sql_query("SELECT jenis, asal, tujuan, date_format(tanggal_flight, '%d-%m-%Y') as tanggal_flight, harga_asli+markup AS harga FROM detail_tbl 
						WHERE no_invoice = '".$id."' 
						ORDER BY jenis, tanggal_flight");
	$i=0;
	$total = 0;
	while($rowDetail = sql_fetchrow($qDetail)){
		$total = $total + $rowDetail['harga'];
		if($rowDetail['jenis']==0)
			$printpage .= '<tr><td> ('.$rowDetail['asal'].' - '.$rowDetail['tujuan'].') @ '.getDMYFormatDate2($rowDetail['tanggal_flight']).'</td>';
		else $printpage .= '<tr><td> Biaya Perubahan Jadwal</td>';
		$printpage .= '<td style="text-align:center;">Rp. '.number_format($rowDetail['harga'],0).'</td>';
		$printpage .= '</tr>';
		$i++;
	}
	$printpage .= '<tr><td style="text-align:center;">Total</td><td style="text-align:center;">Rp. '.number_format($total,0).'</td></tr>';
	$printpage .= '</table><br /><br /><br /><br />';
	
	
	$printpage .= '<div style="text-align:left;">';
	$printpage .= '<u>TRANSFER VIA</u><br /><br />';
	$printpage .= 'BCA-IDR<br />';
	$printpage .= 'A/C: 7310655826<br />';
	$printpage .= 'A/N: SAID ISKANDAR<br /><br /><br />';
	$printpage .= 'MANDIRI-IDR<br />';
	$printpage .= 'A/C: 1170006024657<br />';
	$printpage .= 'A/N: SAID ISKANDAR<br />';
	$printpage .= '</div><br /><br />';
	
	$printpage .= '<div style="text-align:center; padding-left:500px;">';
	$printpage .= 'Jakarta, '.getDMYFormatDate2(date('Y-m-d')).'<br /><br /><br /><br /><br />';
	$printpage .= '(	Said Iskandar	)';
	$printpage .= '</div>';
 	
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
    $dmy[0]=$ymd[0];
    $dmy[1]=$bulan;
    $dmy[2]=$ymd[2];
    $dmyFormat=implode(" ",$dmy);
    if($time==1)$dmyFormat.=" - $exp[1]";
    return $dmyFormat;
  }
?>