<?php
    mysql_connect ("ХОСТ","ЛОГИН","ПАРОЛЬ");
    mysql_select_db ("БАЗА");
    mysql_query("SET NAMES utf8");
	
	$id_P = $_GET['id_P'];
	
	if (empty($id_P))
	    echo "ERROR=100";
	else
	{
		$query = mysql_query("SELECT * FROM teachers WHERE id_P='$id_P'");
		$sql = $query or die(mysql_error());
		
		if (mysql_num_rows($sql) > 0)
		{
			$result = mysql_query("SELECT FIO FROM users WHERE id_P=$id_P");
			$i = 0;
			$students = array();
			
            while ($row = mysql_fetch_assoc($result))
		    {
                foreach ($row as $key => $value)
				{
					echo "$i=$value;";
					$i++;
				}
            }
		}
		else
		{
			echo "ERROR=101";
		}
	}
?>