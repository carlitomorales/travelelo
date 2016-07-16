var tinggi = {};
jQuery.noConflict();
$( document ).ready(function() {
	
    //$( "#txtans_1_1" ).focus();
});

function isNumberNoAlert(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		//alert("Hanya dapat diisi angka.");
        return false;
    }
    return true;
}
function localJsSaveDetail(form)
{	
	var strConfirm = "Anda yakin akan simpan data ini?";
	var row;
	var tahapan_tes;
	var NoKTP = $('#txtNoKTP').val(); 		
	var Nama = $('#txtNama').val(); 		
	var Posisi = $('#txtPosisi').val(); 		
	var Usia = $('#txtUsia').val(); 		
	var Alamat = $('#txtAlamat').val(); 		
	var NoHP = $('#txtNoHP').val(); 	
	var thpn = 0;
	
	
	if(!NoKTP){ alert('Nomor KTP belum diisi!'); return false; }
	if(NoKTP.length < 16){ alert('Nomor KTP belum lengkap!'); return false; }
		// alert("a"); return false;
	$.ajax({
	 type: 'POST',
             dataType: "json",
             async:false,
             url: 'ajax/home.php?po=localAjGetRowDetail&id='+$('#txtNoKTP').val(),
             success: function(data) {
			if(data.row>0){
				thpn = 1;
				switch(data.tahapan_tes)
					{	
						case '1': window.open('index.php?act=wpt','newtab','toolbar=0,height='+screen.height+',width='+screen.width);break; 
						case '2': window.open('index.php?act=kraeplin','newtab','toolbar=0,height='+screen.height+',width='+screen.width);break; 
						case '3': window.open('index.php?act=papi','newtab','toolbar=0,height='+screen.height+',width='+screen.width);break; 
						case '4': window.open('index.php?act=disc','newtab','toolbar=0,height='+screen.height+',width='+screen.width);break; 
						case '5': alert('Peserta dengan nomor KTP '+NoKTP+' sudah menyelesaikan tahapan psikotes.'); break;
					}
				}
		}			
	});
	
	if(thpn == 0){
		if(!Nama){ alert('Nama belum diisi!'); return false; }
		if(!Usia){ alert('Usia belum diisi!'); return false; }
		if(!Posisi){ alert('Posisi yang dilamar belum diisi!'); return false; }
		if(!Alamat){ alert('Alamat belum diisi!'); return false; }
		if(!NoHP){ alert('Nomor HP belum diisi!'); return false; }	
		if(!confirm(strConfirm)){ 
			return false; 
		}else{   
			$('#btnSaveDetail').disable;
			$('#btnSaveDetail').val("Sedang Dalam Proses Simpan");
			// $(form).submit();
			console.log($('#'+form).serialize());
			$.ajax({
			 type: 'POST',
			 url: 'ajax/home.php?&po=localAjSaveDetail',
			 data: $('#'+form).serialize(),
			
	        success:function(request){
	            // var hasils = request.responseText;
				console.log(request);
				switch(request)
				{	case '0': alert('Gagal menyimpan data.'); break;	
					case '1': alert('Sukses menyimpan data'); 
							  window.open('index.php?act=wpt','newtab','toolbar=0,height='+screen.height+',width='+screen.width);break; 
				}
				$('#btnSaveDetail').enable;
				$('#btnSaveDetail').val("Simpan");
			}
			 }); return false;
			
		}
	}
}
function trim(str, chars) {	return ltrim(rtrim(str, chars), chars);} 
function ltrim(str, chars) {	chars = chars || "\\s";	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");}
function rtrim(str, chars) {	chars = chars || "\\s";	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");}
