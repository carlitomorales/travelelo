<?php
  function getDMYFormatDate($datetime,$time=""){
    $exp=explode(" ",$datetime);
    $ymd=explode("-",$exp[0]);
    if($ymd[1]=="01"){$bulan="Januari";}
    else if($ymd[1]=="02"){$bulan="Februari";}
    else if($ymd[1]=="03"){$bulan="Maret";}
    else if($ymd[1]=="04"){$bulan="April";}
    else if($ymd[1]=="05"){$bulan="Mei";}
    else if($ymd[1]=="06"){$bulan="Juni";}
    else if($ymd[1]=="07"){$bulan="Juli";}
    else if($ymd[1]=="08"){$bulan="Agustus";}
    else if($ymd[1]=="09"){$bulan="September";}
    else if($ymd[1]=="10"){$bulan="Oktober";}
    else if($ymd[1]=="11"){$bulan="November";}
    else if($ymd[1]=="12"){$bulan="Desember";}
    $dmy[0]=$ymd[2];
    $dmy[1]=$bulan;
    $dmy[2]=$ymd[0];
    $dmyFormat=implode(" ",$dmy);
    if($time==1)$dmyFormat.=" - $exp[1]";
    return $dmyFormat;
  }
?>