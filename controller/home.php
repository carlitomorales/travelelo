<?php
function LoginForm()
{	
	// $content = '<div id="title" align="center">Login</div>';
	$formName = 'formRegister';
	$content = "<fieldset>"; // localResetSuratJalan(); 
	$content .= "<legend onclick='Effect.toggle(\"$formName\",\"slide\");' style='cursor:pointer'>Buat Surat Balik</legend>";
	$content .= '<form action="" method="post" enctype="multipart/form-data" name="'.$formName.'" id="'.$formName.'">';
	$content .= "<table id=tbLogin align='center' border='0' width='450px'>";
	$content .= "<tr>";
	$content .= "<td width='35%'>Tanggal Tes</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'>".getDMYFormatDate(date("Y-m-d H:i:s"))."<input type='hidden' id='hdTanggal' name='hdTanggal' value='".date("Y-m-d H:i:s")."' ></td>";
	$content .= "</tr>";
	$content .= "<tr>";
	$content .= "<tr>";
	$content .= "<td width='35%'>Nomor KTP</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'><input type='text' id='txtNoKTP' name='txtNoKTP' size='30' maxlength='16' onkeypress='return isNumberNoAlert(event);'></td>";
	$content .= "</tr>";
	$content .= "<tr>";
	$content .= "<td width='35%'>Nama Lengkap</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'><input type='text' id='txtNama' name='txtNama' size='30'></td>";
	$content .= "</tr>";
	$content .= "<tr>";
	$content .= "<td width='35%'>Posisi yang Dilamar</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'><input type='text' id='txtPosisi' name='txtPosisi' size='30'></td>";
	$content .= "</tr>";
	$content .= "<tr>";
	$content .= "<td width='35%'>Usia</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'><input type='text' id='txtUsia' name='txtUsia' size='23' maxlength='16' onkeypress='return isNumberNoAlert(event);'>&nbsp;Tahun</td>";
	$content .= "</tr>";
	$content .= "<tr>";
	$content .= "<td width='35%'>Alamat</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'><textarea rows=3 cols=31 name='txtAlamat' id='txtAlamat' ></textarea></td>";
	$content .= "</tr>";
	$content .= "<tr>";
	$content .= "<td width='35%'>Nomor HP</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'><input type='text' id='txtNoHP' name='txtNoHP' size='30' maxlength='12' onkeypress='return isNumberNoAlert(event);'></td>";
	$content .= "</tr>";
	$content .= "<tr>";
	$content .= "<td colspan=3 style='text-align:center;'>";
	$content .= '<input type="button" id="btnSaveDetail" value="Simpan" class="btn btnSave" onclick=\'localJsSaveDetail("'.$formName.'");\'>';
	$content .= "</td>";
	$content .= "</tr>";
	$content .= "</table>";
	$content .= "</form>";
	$content .= "</fieldset>"; 
	echo $content;
}
function localSaveDetail()
{	
		
		$sukses='0';
		
		
		$query = "INSERT INTO user
				(`no_ktp`, `tanggal_tes`, `nama_peserta`, 
				`posisi`, `usia`, `alamat`, `no_hp`, 
				`tahapan_tes`
				)
				VALUES
				('".$_POST['txtNoKTP']."', '".$_POST['hdTanggal']."', '".$_POST['txtNama']."', 
				'".$_POST['txtPosisi']."', '".$_POST['txtUsia']."', '".$_POST['txtAlamat']."', '".$_POST['txtNoHP']."', 
				'1'
				); ";
				// echo $query;
				
				
							
			
			
			if(sql_query($query)) 
			{
				$sukses='1';
				$_SESSION['userid'] = $_POST['txtNoKTP'];
			}
		
		echo $sukses;
	
}
?>