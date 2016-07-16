<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/travelelo/config/conn.php');

function sql_query($q){
	global $conn;
	// echo $q;
	$result = $conn->query($q);
	return $result;
}
function sql_fetchassoc($q){
	global $conn;
	$result = $q->fetch_assoc();
	return $result;
}
function sql_fetchrow($q){
	global $conn;
	$result = $q->fetch_array();
	return $result;
}
function sql_numrows($q){
	global $conn;
	$result = mysqli_num_rows($q);
	return $result;
}
?>
