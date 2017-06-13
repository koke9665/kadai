<?php
//不審者情報の統合情報の一覧とid毎の情報をJSONで出力するためのPHP
include("db_def.php");				//定義用ファイルの読み込み
include("incident_info_class.php");		//クラスの読み込み
$c = pg_connect("user=b6p31099 password=B6P31099");		//DB接続用のユーザー名とパスワードを指定
$sql = "SELECT users.name as register_name ";
$sql .= ", locations.cat_id, locations.name as loc_name, locations.addr, locations.lat, locations.lng, locations.e_dist, locations.j_dist";
$sql .= ", incidents.id, incidents.cat_id, incidents.content, incidents.date, incidents.time FROM incidents";	//SQL文の生成
$sql .= " JOIN users ON incidents.user_id = users.id";
$sql .= " JOIN locations ON incidents.loc_id = locations.id";

if(isset($_REQUEST["id"]) && !empty($_REQUEST["id"])){ //incidntsをidの値によって検索
	$sql .= " WHERE incidents.id = ".$_REQUEST["id"];
}
if(isset($_REQUEST["q"]) && !empty($_REQUEST["q"])){ //incidntsのcontentの値を検索
	$sql .= " WHERE incidents.content LIKE '%".$_REQUEST["q"]."%'";
}

//echo "$sql\n";
$rs = pg_query($c, $sql);			//SQL文実行
$li = new incident_infoList();			//不審者情報を結合したリストクラスの生成
while($arr = pg_fetch_assoc($rs)){	//DBの取得件数分だけ不審者統合情報クラスを生成し，リスト用クラスに追加
	$li -> add($arr);
}
pg_close($c);						//DBを閉じる
echo($li -> getJson());				//JSONデータとして出力

?>
