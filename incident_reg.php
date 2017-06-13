<?php
require('db_def.php'); //データベース接続用の定数を定義したファイルを読み込む

if(isset($_POST["method"])){//hiddenタイプで送信されたmethodの値を使って登録動作かどうかを判断
	$method = $_REQUEST["method"];
	if($method === "doRegist"){//登録動作(doRegist)が指定されていた場合

		//データベースへの接続を行う
		$connect = pg_connect("host=$dbhost user=$dbuser password=$dbpasswd");

		//FORMから送信された値を読み取る
		//idはデータベース側で自動採番のため省略\
		$cat_id = htmlspecialchars($_REQUEST["cat_id"]);//HTML表示に影響する文字列をエスケープ
		$cat_id = pg_escape_string($connect,$cat_id);//SQL中の不正文字をエスケープ
		$user_id = htmlspecialchars($_REQUEST["user_id"]);//HTML表示に影響する文字列をエスケープ
		$user_id = pg_escape_string($connect,$user_id);
		$loc_id = htmlspecialchars($_REQUEST["loc_id"]);//HTML表示に影響する文字列をエスケープ
		$loc_id = pg_escape_string($connect,$loc_id);

		$contact = htmlspecialchars($_REQUEST["contact"]);
		$contact = pg_escape_string($connect,$contact);//SQL中の不正文字をエスケープ
		$date = htmlspecialchars($_REQUEST["date"]);//HTML表示に影響する文字列をエスケープ
		$date = pg_escape_string($connect,$date);
		$time = htmlspecialchars($_REQUEST["time"]);//HTML表示に影響する文字列をエスケープ
		$time = pg_escape_string($connect,$time);

		$fieids = {$cat_id,$user_id,$loc_id,$contact,$date,$time}

		//INSERT文を生成
		$sql = "INSERT INTO locations {$fields} VALUES (";
		$sql .="'$cat_id'";
		$sql .="'$user_id'";
		$sql .="'$loc_id'";
		$sql .="'$content'";
		$sql .="'$date'";
		$sql .="'$time'";
		$sql .= ");";

		if(!empty($connect)){ //データベースに接続されているかを確認して
			$result = @pg_query($connect,$sql);
			echo "{$sql}\n";
			echo "を実行しました。\n\n";
			if(! $result){ echo "$sqlの実行に失敗しました。\n\n"; }
			pg_close($connect);
		}
		else{
			echo "データベースにユーザ名$dbuser，パスワード$dbpasswdで接続できませんでした。";
		}
	}
}

?>
