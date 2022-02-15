<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/../../db/dbinit.inc.php");
	
	//Если нажата кнопка "Зарегистрировать"
	if(isset($_POST["btn_Go"])) {
		/*echo "<pre>";
		print_r($_POST);
		echo "</pre>";*/
		
		$name=$_POST["tb_Name"];
		$work=$_POST["tb_Work"];
		$languages0="";
		foreach($_POST["tb_Language"] As $v)				
				$languages0.=$v." ";		
			
		$languages="";
		foreach($_POST["mycheckbox"] As $v)							
				$languages.=$v." ";
		
		$rb_day=$_POST["rb_day"];
		$tx_info=$_POST["tx_info"];
		
		$message=" Имя: [".$name."]\n Вид занятости: [".$work."] \n Знание языков: [".$languages0."]\n Знание языков программирования: [".$languages."]\n Рабочий день: [".$rb_day."]\n Дополнительная информация: [".$tx_info."]";
		
		mysqli_query($cms_db_link,"INSERT INTO Users(Name,Work,Languages,ProgLangs,Day,Info) VALUES('$name','$work','$languages0','$languages','$rb_day','$tx_info')");
		
		//Перезагрузка страницы с целью сброса полей формы
		//и предотвращения дублирования информации
		header("Location: $_SERVER[PHP_SELF]"); 
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Форма регистрации пользователя</title>
		<script type="text/javascript" src="jquery-3.6.0.min.js"></script>
		<script type="text/javascript">
			$(function(){
				$("#btn_Go").click(function(){
					var name=$("#tb_Name").val();
					var work=$("#tb_Work").val();
					var languages0="";
					$("#tb_Language option:selected").each(function(idx,item){
							//alert(item);
							languages0+=$(item).val()+" ";
					});
						
					var languages="";
					$(".mycheckbox:checked").each(function(idx,item){							
							languages+=$(item).val()+" ";
					});
					var rb_day=$(".rb_day:checked").val();
					var tx_info=$("#tx_info").val();
					
					var message=" Имя: ["+name+"]\n Вид занятости: ["+work+"] \n Знание языков: ["+languages0+"]\n Знание языков программирования: ["+languages+"]\n Рабочий день: ["+rb_day+"]\n Дополнительная информация: ["+tx_info+"]";
					
					alert(message);
				});
			});
		</script>
	</head>
	<body>
		<xmp><?=$message?></xmp>
		<form action="" method="POST">
		Имя:<br/>
		<input name="tb_Name" id="tb_Name" type="text" size="10"/><br/>
		Вид занятости:<br/>
		<select name="tb_Work" id="tb_Work">
			<option value="Безработный">Безработный</option>
			<option value="Студент">Студент</option>
			<option value="Работающий">Работающий</option>
		</select><br/>
		Знание языков: <br/>
		<select name="tb_Language[]" id="tb_Language" multiple>
			<option value="Русский">Русский</option>
			<option value="Английский">Английский</option>
			<option value="Французский">Французский</option>
		</select><br/>
		Знание языков программирования:<br/>
		<input name="mycheckbox[]" class="mycheckbox" id="cb1" type="checkbox" value="С"><label for="cb1">С</label><br/>
		<input name="mycheckbox[]" class="mycheckbox" id="cb2" type="checkbox" value="С++"><label for="cb2">С++</label><br/>
		<input name="mycheckbox[]" class="mycheckbox" id="cb3" type="checkbox" value="С#">С#<br/>
		<input name="mycheckbox[]" class="mycheckbox" id="cb4" type="checkbox" value="PHP">PHP<br/>
		Рабочий день:<br/>
		<input class="rb_day" name="rb_day" type="radio" value="Полный">Полный<br/>
		<input class="rb_day" name="rb_day" type="radio" value="Неполный">Неполный<br/>
		Дополнительная информация: <br/>
		<textarea name="tx_info" id="tx_info" rows="10" cols="50"></textarea><br/>
		<input id="btn_Go" type="submit" value="Зарегистрировать (JS)"/>
		<input name="btn_Go" type="submit" value="Зарегистрировать (PHP)"/>
		<input type="reset" value="Очистить"/>
		</form>
	</body>
</html>
