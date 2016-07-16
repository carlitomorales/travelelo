<?php

session_start();
include('../config/conn.php');
include('../function/sqlfunction.php');
require_once('../function/tmplfunction.php');
require_once('../function/mainfunction.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Dashboard Psikotest Online</title>
	<link href="../css/style.css" rel="stylesheet" type="text/css">
	<link href="../css/bootstrap-min.css" rel="stylesheet" type="text/css">
	<link href="../css/custom.css" rel="stylesheet" type="text/css">
	<link href="../css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery.timer.js"></script>
	<script type="text/javascript" src="../js/jquery.msgbox.js"></script>
	<!--<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/dataTables.tableTools.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.columnFilter.js"></script>-->
	<link href="../css/custom2.css" rel="stylesheet">
    <link href="../css/icheck/flat/green.css" rel="stylesheet">
	<link href="../css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
</head>

<body>
	<div id="content">
		<?php 
		$UserQuery="SELECT tanggal_tes, no_ktp, nama_peserta, posisi, 
						IF(tahapan_tes='1', 'Kraeplin', IF(tahapan_tes='2', 'PAPI', IF(tahapan_tes='3', 'DISC', IF(tahapan_tes='4', 'WPT', 'Completed')))) AS tahapan
						FROM USER  ";
		$UserQuery .= " ORDER BY tanggal_tes DESC ";					
		$stmt = sql_query($UserQuery);
		
		$content .= 
		'<div id="title" align="center" style="font-weight:bold; font-size:23px;">Data Peserta</div><br /><br /><br />
		<div class="x_content">
		<table width="1000px" class="table table-striped responsive-utilities jambo_table" id="tableatendee" >
		<thead>
			<tr align="center">
				<th>Tanggal Tes</th>
				<th>Kondisi</th>
				<th>No. KTP</th>
				<th>Posisi yang<br />Dilamar</th>
				<th>Tahapan<br />Tes</th>
				<th>Tindakan</th>
			</tr></thead>';
			$content .= '<tbody>';
		$i=0;
		while($row=sql_fetchrow($stmt))
		{ $i++; 
		$content .="<tr><td align=\"center\">".getDMYFormatDate($row['tanggal_tes'])."</td>
						<td align=\"center\">".$row['no_ktp']."</td>
						<td align=\"center\">".$row['nama_peserta']."</td>
						<td align=\"center\">".$row['posisi']."</td>
						<td align=\"center\">".$row['tahapan']."</td>";
		$content .= "<td style='text-align:center'>";
		$content .= UserAction($row['no_ktp']);
		$content .= "</td>";
		$content .="</tr>";
						  
		}
		// if($i=='0') $content .= '<tr><td colspan="9" class="fb12" align="center" bgcolor="#d4e8f6">Data tidak ditemukan</td></tr>';
		
		$content .= '</tbody>';
		$content .= '</table><br><br></div>';
		echo $content;
		
		function UserAction($id)
		{	
			$content.="
				<img src='../images/print.gif' style='cursor:pointer' onmouseout=\"exit();\"  
					onmouseover=\"tooltip2('".getTooltipMenuRight('Klik untuk print data peserta ini.')."');\" 
					onclick=\"localJsPrintSuratBalik('".$id."');\">
				";
				
			return $content;
		}
		?>
		<!--<div id="title" align="center">Kraeplin</div>
		<div id="btstart" align="center"><input type=button id="btnstart" tabindex="-1" value="Start"></div>
		<div id="body">
			<form action="" method="post" enctype="multipart/form-data">
				
					// $max = sql_fetchassoc(sql_query("SELECT DISTINCT MAX(x) as maxX, MAX(y) as maxY FROM template"));
					// $maxX = $max['maxX'];
					// $maxY = $max['maxY'];

					// $qCell = sql_query("SELECT x,y,value,answer FROM template order by x asc, y asc ");

					// $x=1;
					// $y=1;
					// while($tcell = sql_fetchassoc($qCell)){
						// print_r($tcell['x']." ".$tcell['y']." ".$tcell['value']."<br />");
						// print_r($x." ".$y." ".$tcell['value']."<br />");
						// $cell[$x][$y]['x'] = $tcell['x'];
						// $cell[$x][$y]['y'] = $tcell['y'];
						// $cell[$x][$y]['val'] = $tcell['value'];
						// $cell[$x][$y]['ans'] = $tcell['answer'];
						// $x++; if($x==$maxX+1) $x=1;
						// $y++; if($y==$maxY+1) {$y=1; $x++;}
					// }
					// /*echo '<pre>';
					// print_r ($cell[1][3]['val']);
					// echo '</pre>';*/

					
					// $content = "<div id=countdown style='display:none;'></div>";
					// $content = "<table id=tbSheet style='display:none;'>";
					// for($yp=$maxY;$yp>=1;$yp--){
						// $content .= "<tr>";
						// for($xp=1;$xp<=$maxX;$xp++){
							// echo $xp.$yp;

							// $content .= "<td>".$cell[$xp][$yp]['val']."</td><td>&nbsp;</td>";
								// if($xp==$maxX && $yp>1){
								// $content .= "</tr><tr>";
								// for($xpp=1;$xpp<=$maxX;$xpp++){ $ypp = $yp-1;
									// $content .= "<td>&nbsp;</td>";
									// $content .= "<td><input tabindex='-1' type='number' min='0' max='9' maxlength = '1' class='txtans txtansrow".$xpp."' name='txtans_".$xpp."_".$ypp."' size=1 id='txtans_".$xpp."_".$ypp."' onkeyup='nextText($xpp, $ypp, (this).value)' oninput='maxLengthCheck(this)' onClick='this.select();' onfocus='this.oldvalue = this.value;' onChange='check($xpp, $ypp, this)' this.oldvalue = this.value; disabled>";
									// $content .= "<input type=hidden name='hdans_".$xpp."_".$ypp."' id='hdans_".$xpp."_".$ypp."' value='".$cell[$xpp][$ypp]['ans']."'></td>";
									// $content .= "<input type=hidden name='hdstatus_".$xpp."_".$ypp."' id='hdstatus_".$xpp."_".$ypp."' value='1'></td>";
									// $content .= "<input type=hidden name='hdcounter_".$xpp."_".$ypp."' id='hdcounter_".$xpp."_".$ypp."' value='0'></td>";
								// }
								// $content .= "</tr>";
							// }
						// }	
						// $content .= "</tr>";
						
						
					// }
					// $content .= "</table>";
					// echo $content;
				

			<!--</form>
		</div>-->
	</div>
</body>
</html>
