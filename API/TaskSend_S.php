<?php
    mysql_connect ("ХОСТ","ЛОГИН","ПАРОЛЬ");
    mysql_select_db ("БАЗА");
    mysql_query("SET NAMES utf8");
	
	$id_S = $_GET['id_S'];
	$answer = $_GET['answer'];
	
	if (empty($id_S) || empty($answer))
	    echo "ERROR=100";
	else
	{
		$query = mysql_query("SELECT * FROM users WHERE id_S='$id_S'");
		$sql = $query or die(mysql_error());
		
		if (mysql_num_rows($sql) > 0)
		{
			$fp = fopen('Data/'.$id_S.'.xml', "a");
			echo "1";
			
			fwrite($fp, "$answer");
			fwrite($fp, '</answer>'."\r\n");
			fwrite($fp, '	</task>'."\r\n");
			fclose($fp);
		}
		else
		{
			echo "ERROR=101";
		}
	}
?>