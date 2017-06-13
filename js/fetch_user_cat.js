$(function(){
	$('select[name="cat_id"]').ready(function(){ //読み込み完了(ready)時の処理
		var url = "http://www.shonan.bunkyo.ac.jp/~hidenao/ProB_sd_2017/user_cat_json.php";
		$('select[name="cat_id"]').html("");
		$.ajax({url:url, cache:false, dataType: "json", success:function(res){
			//$("#result").html(res);
			$.each(res["user_cat_list"], function(i){
				$("<option id=" + this["id"] + ">" + this["cat_name"] + "</option>").appendTo('select[name="cat_id"]');
			});
		}});
	});
});