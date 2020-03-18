<?php
    mysql_connect ("ХОСТ","ЛОГИН","ПАРОЛЬ");
    mysql_select_db ("БАЗА");
    mysql_query("SET NAMES utf8");
	
	$id_S = $_GET['id_S'];
	
	if (empty($id_S))
	    echo "ERROR=100";
	else
	{
		$query = mysql_query("SELECT * FROM users WHERE id_S='$id_S'");
		$sql = $query or die(mysql_error());
		
		if (mysql_num_rows($sql) > 0)
		{
			$id_user = mysql_fetch_array($query);
			
			if ($id_user['message'] <> "")
            {
				echo "message=".$id_user['message'].";";
                mysql_query("UPDATE users SET message = NULL WHERE id_S = '$id_S'");
            }
			else
				echo "message=NULL;";
		}
		else
		{
			echo "ERROR=101";
		}
	}
?>