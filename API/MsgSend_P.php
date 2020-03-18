<?php
    mysql_connect ("ХОСТ","ЛОГИН","ПАРОЛЬ");
    mysql_select_db ("БАЗА");
    mysql_query("SET NAMES utf8");
	
	$id_P = $_GET['id_P'];
	$id_S = $_GET['id_S'];
	$message = $_GET['message'];
	
	if ((empty($id_P)) && (empty($id_S)) && (empty($message)))
	    echo "ERROR=100";
	else
	{
		$query = mysql_query("SELECT * FROM teachers WHERE id_P='$id_P'");
		$sql = $query or die(mysql_error());
		
		if (mysql_num_rows($sql) > 0)
		{
			$query = mysql_query("SELECT * FROM users WHERE id_S='$id_S'");
		    $sql = $query or die(mysql_error());
			
			if (mysql_num_rows($sql) > 0)
				echo mysql_query("UPDATE users SET message = '$message' WHERE id_S = '$id_S'");
		    else
			    echo "ERROR=101";
		}
		else
			echo "ERROR=101";
	}
?>