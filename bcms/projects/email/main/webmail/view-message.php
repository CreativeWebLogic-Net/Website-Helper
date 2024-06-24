<?php
	include("../Admin_Include.php");
	
	$p->CheckPage(14);
	
	if($_GET['id']) $id=$_GET['id'];
	elseif($_POST['id']) $id=$_POST['id'];
	
	
	$m= new ReturnRecord();
	$m->AddTable("EMessage");
	$m->AddSearchVar($id);
	$Insert=$m->GetRecord();
	
	if(eregi('3D"',$Insert['TextBody'])) $Insert['TextBody']=eregi_replace("3D","",$Insert['TextBody']);
	$Insert['TextBody']=eregi_replace("=20","",$Insert['TextBody']);
	$Insert['TextBody']=eregi_replace('=[^"]',"",$Insert['TextBody']);
	print $Insert['TextBody'];
?>