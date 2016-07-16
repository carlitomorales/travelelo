<?
/*---------------------------------------------------------------
  Nama File : setting.php
  Deskripsi file : setting utama untuk hrbii
  Catatan :
  Tanggal         Nama           Keterangan
  ------------    -----------    -----------------------------
  2007-Nov-26     Herman F       Created
----------------------------------------------------------------*/
/*$urlsite="http://10.247.12.28/62/";

//$server="10.110.24.142";
//$server="10.247.12.28";
//$dbusername="wom";
//$dbpassword="wom";
//$database="hrbii";

//mysql_connect($server, $dbusername, $dbpassword);
//mysql_select_db($database);*/
include('config/conn.php');

/*global $conn_ora;
$conn_ora = oci_connect("WOM_DEV2", "orange2", "(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = 10.0.9.17)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = drchrd.wom.co.id)
    )
  )");*/

/*$urlsite="localhost";//"http://10.247.12.28/wom/";
//$server="10.110.24.142";
$server="localhost";//"10.247.12.28";
$dbusername="WOM_DEV2";
$dbpassword="orange2";
$database="hrbii_db_v4";
$conn = oci_connect($dbusername, $dbpassword, "(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = 10.0.9.17)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = drchrd.wom.co.id)
    )
  )");*/
//connect DB
require_once('function/sqlfunction.php');
require_once('function/mainfunction.php');
require_once('function/tmplfunction.php');
//require_once('functions/ocifunction.php');

//setting website

$sitename="HRFasT";
$siteemail="hrfast@wom.co.id";
$sitewebmaster="Master";
$webmasteremail="hrfast@wom.co.id";
$sitefooter2="<br><a href=mailto:$webmasteremail class=nav>$sitewebmaster</a> &nbsp; | &nbsp; <a href=mailto:$webmasteremail?subject=[Kritik_Saran] class=nav title='Sampaikan kritik dan saran yang berhubungan dengan Portal HR Management'>Kritik dan Saran</a>";
// include_once("language/default.php");
$errorpage="<script>alert('"._ERRORPAGE."');window.location.href='javascript:history.back();';</script>";
$deniedpage="<script>alert('Request Url yang anda buka : DITOLAK !!!\\nKemungkinan percobaan hacking.');window.location.href=\"$urlsite/error.php?e=403\";</script> ";
$homepage="HCM Portal : HR-FasT";

$stdcolor['maroon']="#710000";

?>
