<?php
include("db_def.php");
$id = $_GET["lid"];
if(! empty($id)){
	$c = pg_connect("user={$dbuser} password={$dbpasswd}");
	$sql = "SELECT * FROM locations WHERE id='{$id}'";
	$rs = pg_query($c, $sql);
	if(pg_num_rows($rs) == 0) echo("有効な位置情報idを入力してください");
	else                     echo("有効な位置情報idであることを確認しました");
}else{
	echo("位置情報idを指定してください");
}
?>
