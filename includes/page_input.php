<?php
global $urlsite;

$localPageName = $_GET['act'];

include("controller/".$localPageName.".php");

?> 
	<script>var localPageName = "<?php echo $localPageName; ?>"</script>	
	<script type="text/javascript" language="JavaScript" src="js/<?php echo $localPageName; ?>.js"></script>
	<div id="table-list"><?php localInputMenuControl($localPageName); ?></div>

