<?php //ユーザ情報関連のクラス定義，テーブルに相当するリストのクラス定義

class user_cat{

	var $id; //userカテゴリのid
	var $p_id; //userカテゴリの親id
	var $cat_name; //userカテゴリの名称

  	function user($arr){ //コンストラクタ（インスタンス化のタイミングで実行されるメソッド）
		foreach($arr as $k => $v) $this -> $k = $v;  //DBのフィールド名をそのまま同名のプロパティにデータの流し込み
	}

}

class user{

	var $id; //userのid
	var $cat_id; //userのカテゴリid
	var $name; //userの名前
	var $contact; //userの連絡先（メールアドレス，Twitterアカウント，ハッシュタグなど）
	var $password; //ユーザのパスワード（sha1というアルゴリズムでハッシュ化した文字列）

	function user($arr){ //コンストラクタ（インスタンス化のタイミングで実行されるメソッド）
		foreach($arr as $k => $v) $this -> $k = $v;  //DBのフィールド名をそのまま同名のプロパティにデータの流し込み
	}
}

//ユーザカテゴリ情報をリストで保持するためのクラス
class user_catList{
	//プロパティ
	public $user_cat_list = array();	//クラスuser_catのインスタンスを配列で保持するプロパティ
	//メソッド
	function add($arr){	//ユーザカテゴリ情報(user型インスタンス１つに相当）をリストに追加するメソッド
		$tmp = new user_cat($arr);
		$this -> user_cat_list[] = $tmp;
	}
	function getHtml(){	//現在クラスが保持するリストをHTMLで出力するメソッド
		$src = "<table id='user_catlist'>";
		foreach($this -> user_cat_list as $item){	//要素の数だけ繰り返し
			$src .= "<tr>";
			$props = $item->getProperties();	//各要素（インスタンス）のプロパティを取り出し
			foreach($props as $prop){
				$src .= "<td>{$prop}</td>";	//テーブルの各行の要素にする
			}
			$src .= "</tr>";
		}
		$src .= "</table>";
		return($src);
	}
	function getJson(){	//現在クラスが保持するuserリストをJSON形式で出力するメソッド
		$data = json_encode($this);
		return($data);
	}
}

//ユーザ情報をリストで保持するためのクラス
class userList{
	//プロパティ
	public $user_list = array();	//クラスuserのインスタンスを配列で保持するプロパティ
	//メソッド
	function add($arr){	//ユーザ情報(user型インスタンス１つに相当）をリストに追加するメソッド
		$tmp = new user($arr);
		$this -> user_list[] = $tmp;
	}
	function getHtml($detailurl = ""){	//現在クラスが保持するリストをHTMLで出力するメソッド
		$src = "<table id='userlist'>";
		foreach($this -> user_list as $item){	//要素の数だけ繰り返し
			$src .= "<tr>";
			$props = $item->getProperties();	//各要素（インスタンス）のプロパティを取り出し
			foreach($props as $prop){
				$src .= "<td>{$prop}</td>";	//テーブルの各行の要素にする
			}
			$src .= "</tr>";
		}
		$src .= "</table>";
		return($src);
	}
	function getJson(){	//現在クラスが保持するuserリストをJSON形式で出力するメソッド
		$data = json_encode($this);
		return($data);
	}
}


?>