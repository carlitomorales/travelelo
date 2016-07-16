<?php
function showpage($headtext,$act){
    if(empty($act))$act="main";
    $mainfile="includes/page_$act.php";
  if(is_file($mainfile)){	
  	//echo headpage($headtext);
	//echo "<div id='mainTitle' style='background: #66FF66'>".headpage($headtext)."</div>";
	echo "<div id='mainTitle' style='background: #450607l;'>".headpage($headtext)."</div>";
    	echo "<div class=\"content-padding\" >";
    	include "$mainfile";
    	echo"</div>";
  }else{
  	echo headpage("Halaman Tidak Tersedia");
    	echo "<div class=\"content-padding\" >";
    	echo "<br><br><center>Maaf, halaman yang anda buka tidak tersedia atau sedang dalam proses pengembangan.</center><br><br><br>";
    	echo"</div>";
  }
}
function headpage($headtext){
    $output="<h3>$headtext</h3>";
    return $output;
}
function getTooltipMenuRight($content="",$title="",$width=175){
if(!empty($title)) $showtitle="<strong>$title</strong><hr>";
$output="<table width=$width border=0 cellpadding=0 cellspacing=0>"
    ."<tr>"
		."<td width=9 height=16 background=images/tooltip/tooltips_03a.gif></td>"
		."<td background=images/tooltip/tooltips_02.gif></td>"
		."<td width=16 background=images/tooltip/tooltips_01a.gif></td>"
	."</tr>"
    ."<tr>"
		."<td background=images/tooltip/tooltips_06a.gif></td>"
		."<td bgcolor=#F6F6F6 class=tip_content>$showtitle $content</td>"
		."<td background=images/tooltip/tooltips_04a.gif></td>"
	."</tr>"
    ."<tr>"
		."<td height=9 background=images/tooltip/tooltips_09a.gif></td>"
		."<td background=images/tooltip/tooltips_08.gif></td>"
		."<td background=images/tooltip/tooltips_07a.gif></td>"
	."</tr>"
."</table>";
return $output;
}
?>
<script language="JavaScript" type="text/javascript">
function getmouseposition2(e)
{
	var mousex = 0;
	var mousey = 0;
	if (!e)
	e = window.event;
	if (e.pageX || e.pageY){
		mousex = e.pageX;
		mousey = e.pageY;
	}
	else if (e.clientX || e.clientY){
		mousex = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
		mousey = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
	}    
	
	pointx= mousex-175;
	pointy= mousey+5;

	var lixlpixel_tooltip = $('tooltip');
	lixlpixel_tooltip.style.left =  pointx + 'px';
	lixlpixel_tooltip.style.top = pointy + 'px';
}
function tooltip2(tip)
{
    if(!$('tooltip')) newelement('tooltip');
    var lixlpixel_tooltip = $('tooltip');
    lixlpixel_tooltip.innerHTML = tip;
    lixlpixel_tooltip.style.display = 'block';
	lixlpixel_tooltip.style.backgroundColor = 'transparent';
    document.onmousemove = getmouseposition2;
}
function exit()
{
    $('tooltip').style.display = 'none';
}
</script>
