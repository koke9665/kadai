<?php
include("db_def.php");
$id = $_GET["uid"];
if(! empty($id)){
	$c = pg_connect("user={$dbuser} password={$dbpasswd}");
	$sql = "SELECT * FROM users WHERE id='{$id}'";
	$rs = pg_query($c, $sql);
	if(pg_num_rows($rs) == 0) echo("有効なユーザidを入力してください");
	else                     echo("有効なユーザidであることを確認しました");
}else{
	echo("ユーザidを指定してください");
}
?>
