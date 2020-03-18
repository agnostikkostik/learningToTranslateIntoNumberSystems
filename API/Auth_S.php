<?php
    mysql_connect ("ХОСТ","ЛОГИН","ПАРОЛЬ");
    mysql_select_db ("БАЗА");
    mysql_query("SET NAMES utf8");
	
	$FIO = $_GET['login'];
	$group = $_GET['group'];
	$id_P = $_GET['id_P'];

	if (empty($FIO) || empty($group))
	    echo "ERROR=100";
	else
	{
		$query = mysql_query("SELECT * FROM users WHERE id_S='$FIO' and class='$group'");
		$sql = $query or die(mysql_error());
		
		if (mysql_num_rows($sql) > 0)
		{
			$id_user = mysql_fetch_array($query);
			$id_S = $id_user['id_S'];
			echo "id=$id_S;";			
			goto kek;
		}
		
		$query = mysql_query("SELECT * FROM users WHERE FIO='$FIO' and class='$group'");
		$sql = $query or die(mysql_error());
		
		if (mysql_num_rows($sql) > 0)
		{
			$id_user = mysql_fetch_array($query);
			$id_S = $id_user['id_S'];
			echo "id=$id_S;";
		}
		else
		{
			$date = date_create();
			$id_S = date_timestamp_get($date);
			mysql_query("INSERT INTO users (FIO, class) VALUES ('$FIO', '$group')");
		    $query = mysql_query("SELECT id_table FROM users WHERE FIO='$FIO' and class='$group'");
            $id_user = mysql_fetch_array($query);
            
            $date = date_create();
			$id_s = date_timestamp_get($date);
            $id_S = intval($id_s) + intval($id_user['id_table']);
            
			mysql_query("UPDATE users SET id_S = '$id_S' WHERE FIO='$FIO' and class='$group'");
			echo "id=$id_S;";
		}
kek:
		if (!empty($id_P))
            mysql_query("UPDATE users SET id_P = '$id_P' WHERE id_S = '$id_S'");
        else
            mysql_query("UPDATE users SET id_P = NULL WHERE id_S = '$id_S'");
	}
?>