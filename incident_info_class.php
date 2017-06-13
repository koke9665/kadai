<?php //不審者情報を統合したデータモデルのクラス定義，テーブルに相当するリストのクラス定義

class incident_info{

	var $id; //incidentのid
	var $content; //不審者情報の本文
	var $date; //不審者情報の日付
	var $time; //不審者情報の時間帯
	var $register_name; //登録者のユーザ名
	var $loc_name; //不審者情報に紐づけされた位置の名称
	var $lat; //不審者情報に紐づけされた位置の緯度
	var $lng; //不審者情報に紐づけされた位置の経度
	var $e_dist; //不審者情報に紐づけされた小学校区
	var $j_dist; //不審者情報に紐づけされた中学校区

	function incident_info($arr){ //コンストラクタ（インスタンス化のタイミングで実行されるメソッド）
		foreach($arr as $k => $v) $this -> $k = $v;  //DBのフィールド名をそのまま同名のプロパティにデータの流し込み
	}
}


//不審者情報統合したデータをリストで保持するためのクラス
class incident_infoList{
	//プロパティ
	public $incident_info_list = array();	//クラスincident_infoのインスタンスを配列で保持するプロパティ
	//メソッド
	function add($arr){	//ユーザ情報(incident_info型インスタンス１つに相当）をリストに追加するメソッド
		$tmp = new incident_info($arr);
		$this -> incident_info_list[] = $tmp;
	}
	function getHtml($detailurl = ""){	//現在クラスが保持するリストをHTMLで出力するメソッド
		$src = "<table id='incident_infolist'>";
		foreach($this -> incident_info_list as $item){	//要素の数だけ繰り返し
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
	function getJson(){	//現在クラスが保持するincident_infoリストをJSON形式で出力するメソッド
		$data = json_encode($this);
		return($data);
	}
}


?>