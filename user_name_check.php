<?php
include("db_def.php");
$name = $_GET["name"];
if(! empty($name)){
	$c = pg_connect("user={$dbuser} password={$dbpasswd}");
	$sql = "SELECT * FROM users WHERE name='{$name}'";
	$rs = pg_query($c, $sql);
	if(pg_num_rows($rs) > 0) echo("既に利用されているユーザ名です");
	else                     echo("利用可能なユーザ名です");
}else{
	echo("ユーザ名を指定してください");
}
?>
