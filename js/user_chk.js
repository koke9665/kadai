$(function(){
	$(".checkdata").on("submit", function(){
		var flg = true;
		var err = "";
		$(".checkdata input").each(function(){
			$(this).css("background-color", "");
		});
		$(".checkdata .cNum").each(function(){
			if(!isFinite($(this).val())){
				err += "数値データ以外が入力されています\n";
				$(this).css("background-color", "#FFA");
				flg = false;
			}
		});
		$(".checkdata .cNN").each(function(){
			if($(this).val() == ""){
				err += "必須項目に値が入力されていません\n";
				$(this).css("background-color", "#FAA");
				flg = false;
			}
		});
		if(!flg){
			err += "\n赤色：必須項目チェック、黄色：データ型チェック\n";
			alert(err);
			return false;
		}
	});
	$(".checkdata .name_check").on("keyup", function(){
		var url = "http://www.shonan.bunkyo.ac.jp/~学籍番号/フォルダ名/user_name_check.php?name=" + $(this).val();
		$.ajax({url:url, cache:false, success:function(res){
			$("#result").html(res);
		}});
	});
});
