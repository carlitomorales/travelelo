
jQuery.noConflict();

function localJsPrintReport()
{	
	var bulan = trim($('ddrBulan').value,' '); 		
	var tahun = trim($('ddrTahun').value,' '); 
	var tipe = trim($('ddrTipe').value,' '); 
	// var produk = trim($('ddrProduk').value,' ');
	
	var mywindow=window.open('ajax/report.php?po=localAjPrintReport&bulan='+bulan+'&tahun='+tahun+'&tipe='+tipe,'_blank','toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=50, width=1000, height=600');
}
function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat);
  return [d.getFullYear(), pad(d.getMonth()+1), pad(d.getDate())].join('-');
}
function trim(str, chars) {	return ltrim(rtrim(str, chars), chars);}
function ltrim(str, chars) {	chars = chars || "\\s";	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");}
function rtrim(str, chars) {	chars = chars || "\\s";	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");} 