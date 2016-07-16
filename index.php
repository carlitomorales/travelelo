<?php
if(!empty($_REQUEST['act'])){
	$act = $_REQUEST['act']; 
}else
{
	$act = 'input';
}

session_start();
//$_SESSION['usersessid'] = 'admin';
include('config/conn.php');
if(!empty($act)){
include_once('function/sqlfunction.php');
}
require_once('function/tmplfunction.php');
require_once('function/mainfunction.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Travelelo</title>
	<link href="themes/theme-default/default.css" rel="stylesheet" type="text/css" media="screen" >
	<link href="css/cssreset.css"		rel="stylesheet" type="text/css" media="all" />
	<link href="css/plugins.css"		rel="stylesheet" type="text/css" />
	<link href="css/custom.css"			rel="stylesheet" type="text/css" />
	<style type="text/css">
	.square {
		width: 180px;
		height: 160px;
		float: left;
		margin: 10px;
		padding: 10px 20px;
		color: #000;
		background: #fff;
		font-family: Helvetica, Arial, Sans-Serif;
	}
	</style>
	
	<link href="css/custom2.css" rel="stylesheet" type="text/css">
	<link href="css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.timer.js"></script>
	<script type="text/javascript" src="js/jquery.msgbox.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="JavaScript" src="function/date-picker.js"></script>
	<!--<script type="text/javascript" src="js/dataTables.tableTools.js"></script>-->
	<script type="text/javascript" src="js/jquery.dataTables.columnFilter.js"></script>
	<link href="css/tooltipster.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>
	<script>
  	function maxLengthCheck(object) {
	    if (object.value.length > object.maxLength)
	      object.value = object.value.slice(0, object.maxLength)
	}
	</script>
	<script type="text/javascript" src="js/prototype.js"></script>
    <script type="text/javascript" src="js/js_p2k/scriptaculous.js"></script>
    <script type="text/javascript" src="js/js_p2k/effects.js"></script>
    <script type="text/javascript" src="js/tablesort.js"></script>
    <script type="text/javascript" src="js/paginate.js"></script>
    <script type="text/javascript" src="js/js_p2k/lightview.js"></script>
    <script type="text/javascript" src="js/select2-4.0.3/dist/js/select2.min.js"></script>
    <link type="text/css" href="js/js_p2k/lightview.css" rel="stylesheet" /> 
    <link type="text/css" href="js/select2-4.0.3/dist/css/select2.min.css" rel="stylesheet" /> 
	<link type="text/css" href="min/allCSS.min.css" rel="stylesheet" />
</head>

<body>
	<?php if($act == 'input'){ ?>
	<div id="main">
	<?php } ?>
	<div id="hheaderCont">
	<div id="hheader">
    <div class="headerLogo" >
		<a href="?"><img src="images/logo.png" width="182" height="45"></a>
	</div>
		
		</div></div>
	<div id="content">
		<?php showpage('',$act);?>
	</div>
	
	<?php if($act == 'input'){ ?>
	</div>
	<?php } ?>
</body>
</html>

