
jQuery.noConflict();
jQuery(function($){

	$(document).ready(function() {
		
		// $("#ddrExisting").select2();
		$(".ddrbandara").select2();
		
		$('#RowProduk1').css('opacity','0.5');
		$('#RowProduk2').css('display','none');
		$('#RowProduk3').css('display','none');
		$('#RowProduk4').css('display','none');
		
		
		
		$("#chkResched").click(function(){   
			$("#txtHargaAsliR").attr('readonly', !this.checked)
			$("#txtMarkupR").attr('readonly', !this.checked)
			$("#txtFeeAzharR").attr('readonly', !this.checked)
			// $("#txtResched").css('background-color: gainsboro;', !this.checked)
		});

		var oTable = $('#tableinput').dataTable({
		   "language": {
					 "lengthMenu": "Tampilkan _MENU_ Data per halaman",
					 "zeroRecords": "Tidak ada data surat balik",
					 "info": "Halaman _PAGE_ dari _PAGES_",
					 "infoEmpty": "Tidak ada data yang tersedia",
					 "infoFiltered": "(Penyaringan data dari _MAX_ total data)"
				 },
				 "order": [],
				 pagingType: "simple_numbers",
				 "aoColumnDefs": [
					{ 'bSortable': false, 'aTargets': [ 5 ] }//,
					// { "visible": false, "targets": 0 }
				 ],
				 // "aoColumns": [{ 
				 //   "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
				 //   $(".titletooltip", this.fnGetNodes()).tooltipster();
				 // }
				 // }],
			  aLengthMenu: [
				 [10, 25, 50, 100, -1],
				 [10, 25, 50, 100, "All"]
			  ],
			  iDisplayLength:10
			 });
	$("#trTrip").on('click','.btndelete', function () { 
            var current_row = $(this).parent().parent();
            current_row.remove();
      return false;
	});
	// $('.btndelete').click(function() {
		// alert($(this).parent().parent());
		// return false;
	// });

	}) // End Document
})
// $('#btndelete').click(function () { alert();
            // var current_row = $(this).parent().parent();
            // current_row.remove();
      // return false;
	// });
function localJsSaveInput(form)
{	
	var strConfirm = "\nAnda yakin akan simpan data ini?";

	if(!confirm(strConfirm)) { return false; }
	else
	{   
		$('btnSaveInput').disable();
		$('btnSaveInput').value="Sedang Dalam Proses Simpan";
		// $(form).submit();
		new Ajax.Request('ajax/input.php?&po=localAjSaveInput', {asynchronous:true, evalScripts:true,
        onSuccess:function(request){
            var hasils = request.responseText;
			console.log(hasils);
			switch(hasils)
			{	
				case '2': alert('Sukses menyimpan data'); 
						  window.location.href = 'index.php?act=input';
						  window.reload();  break;
				case '1': alert('Gagal menyimpan data'); break;
			}
			$('btnSaveInput').enable();
			$('btnSaveInput').value="Simpan";
		}, parameters:Form.serialize($(form))}); return false;
		
	}
	
}

function localJsDeleteInput(id)
{	
	var strConfirm;	
	

	strConfirm = "Anda yakin hapus data ini?";
	if(!confirm(strConfirm)) { return false; }
	else
	{   
		
		// $(form).submit();
		new Ajax.Request('ajax/input.php?&po=localAjDeleteInput&id='+id, {asynchronous:true, evalScripts:true,
        onSuccess:function(request){
            var hasils = request.responseText;
			// console.log(hasils);
			switch(hasils)
			{	case '1': alert('Gagal menghapus data ' +id); break;	
				case '2': alert('Sukses menghapus data '+id); 
						  window.location.href = 'index.php?act=input';
						  window.reload();  break;
				//default: alert(hasils); break;
			}
			
		}}); return false;
		
	}
	
}


function localResetSuratJalan()
{	
	
	$('hdtipe').value='1'; $('hdid').value=''; 
	$('txtNamaPelanggan').value=''; 
	$('hdIDPelanggan').value=''; 
	$('rdBayarC').checked=false;
	$('rdBayarH').checked=false;
	$('txtTanggal').value=convertDate(Date());
	$('txtCatatan').value=''; 
	
	var rowMuatan = jQuery('#trMuatan tr').length;
	for(var i = 0; i < rowMuatan; i++){
		$('txtJumlahBeli'+i).value = '0';
		$('txtHargaBeli'+i).value = '0';
	}
	
	row = 0;
	jQuery('#trTrip').empty();
	
}
function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat);
  return [d.getFullYear(), pad(d.getMonth()+1), pad(d.getDate())].join('-');
}
function localJsPrintInput(id)
{	
	var mywindow=window.open('ajax/input.php?po=localAjPrintInput&id='+id,'_blank','toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=50, width=1000, height=600');
}
function localJsPrintGroup()
{	
	var mywindow=window.open('ajax/input.php?po=localAjPrintGroup&id='+$('ddrExisting').value,'_blank','toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=50, width=1000, height=600');
}

function global_doLightviewNewPelanggan(formName,fieldName) { 
	Lightview.show({
		href: 'ajax/suratbalik.php?po=global_newPelanggan&formName='+formName+'&fieldName='+fieldName,
		rel: 'ajax',
		title: 'Pendaftaran',
		caption: 'Data Pelanggan Baru.',
		options: {
		topclose: false,
	    autosize: true,
	  // width: 1000,
	  // height: 1000,	
			ajax: {
				onComplete: function(){
				// once the request is complete we observe the form for a submit
				$('ajaxForm').observe('submit', global_submitAjaxFormDemonstrationNewPelanggan);
				// console.log(data);
				}
			}
		}
	});
}

function global_submitAjaxFormDemonstrationNewPelanggan(event) {
  // block default form submit
  Event.stop(event);

  // if there's no text in the box, don't do anything
  //var text = $('ajaxForm').down('input').value.strip();
  //if (!text) return;

  //var fieldName = $('ajaxForm').down(0).value;
  var formName = document.forms['ajaxForm'].elements['formName'].value;
  var fieldName = document.forms['ajaxForm'].elements['fieldName'].value;

  Lightview.show({
    href: 'ajax/suratbalik.php?po=global_newPelanggan&formName='+formName+'&fieldName='+fieldName,
    rel: 'ajax',
		title: 'Pendaftaran',
		caption: 'Data Pelanggan Baru.',
    options: {
    title: 'results',
	  topclose: false,
	  autosize: true,
	  // width: 1000,
	  // height: 1000,
      ajax: {
        parameters: Form.serialize('ajaxForm'),onComplete: function(data){
				// once the request is complete we observe the form for a submit
				$('ajaxForm').observe('submit', global_submitAjaxFormDemonstrationSetApproval);
				var hasil = data.responseText.evalJSON(true);
				// console.log(hasil);
				if(hasil.status=="success") alert("ok");
					// processSavePKK(formName, '',hasil.nopkk);
				}// the parameters from the form
      }
    }
  });
}
function localJsSuratBalikGetData(kode,div1){	 //alert(kode);
		jQuery.getJSON("ajax/suratbalik.php?po=getnamapelanggan&id="+kode,function(result){
			if(result != null){ //alert();
				jQuery('#txtNamaPelanggan').val(result.nama_pelanggan);
				jQuery('#hdIDPelanggan').val(kode);
			}
	})
}
function addTrip_1() { 
		jQuery('#RowProduk1').css('opacity','1');
         // var rowCount = jQuery('#trTrip tr').length;
         // jQuery.ajax({
             // type: 'POST',
             // dataType: "json",
             // url: 'ajax/input.php?po=global_getdatabandara',
             // success: function(data) { 
                 // if(data.status == 'success') { 
				 // //row++;
                  // addTrip_2(data.bandara, rowCount);
              // } 
             // }
         // });
        }
var row = 0; // used to increment the name for the inputs
function addTrip_2(myData, NoFrom) {
   var count = NoFrom; 
   var listBandara = ''; // alert(row);
   jQuery.each(myData, function(k, v) {
   
    listBandara += '<option value="'+v.kode+'">'+v.kode+' - '+v.keterangan+'</option>';
	
   });
   

   var DropDownAsal = '<select class="ddrbandara" id="ddrAsal'+row+'" name="ddrAsal[]" data-asal="'+row+'" data-select2="0" style="width:140px;">'+listBandara+'</select>';
   var DropDownTujuan = '<select class="ddrbandara" id="ddrTujuan['+row+']" name="ddrTujuan[]" data-tujuan="'+row+'" data-select2="0" style="width:140px;">'+listBandara+'</select>';
   var content = '<tr id="RowProduk'+row+'">';
    content += '<td align="center"><input type="text" name="txtTanggal[]" id="txtTanggal'+row+'" size=15 readonly>';
	content += '<a href="javascript:show_calendar(\'formInput.txtTanggal'+row+'\');"  ><img src="images/calendar.gif" border=0 align=absmiddle></a>';
	content += '</td>';
	content += '<td align="center">'+DropDownAsal+'</td>';
	content += '<td align="center">'+DropDownTujuan+'</td>';
    content += '<td align="center"><input type="text" name="txtHargaAsli[]" id="txtHargaAsli['+row+']" size=20 onkeypress=\"return isNumber(event)\"  onkeyup=\"CurrencyFormat(this);\" ></td>';
    content += '<td align="center"><input type="text" name="txtMarkup[]" id="txtMarkup['+row+']" size=20 onkeypress=\"return isNumber(event)\"  onkeyup=\"CurrencyFormat(this);\" ></td>';
    content += '<td align="center"><input type="text" name="txtFeeAzhar[]" id="txtFeeAzhar['+row+']" size=20 onkeypress=\"return isNumber(event)\"  onkeyup=\"CurrencyFormat(this);\" value=\"150,000\" ></td>';
	content += '</tr>';
	// jQuery('#hdnNominal2').val(count+1);  
// console.log(content);   
		jQuery('#trTrip').append(content);
        count++;
		row++;
    } 
	
function addSelect2(){
	// var article = document.getElementById('electriccars');
 
	var temp = $(".ddrbandara").dataset.select2; // "3"
	alert(temp);
}


function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		// alert("Hanya dapat diisi angka.");
        return false;
    }
    return true;
}
function CurrencyFormat(field) {
    
    // alert(('3,000,000').); return false;
	var harga = $(field).value;
	harga = harga.replace(/,/g,''); // alert (harga);
	jQuery.getJSON("ajax/input.php?po=global_getcurrencyformat&harga="+harga,function(result){
		harga = result.harga;
		$(field).value = harga;
	})
    return false;
}