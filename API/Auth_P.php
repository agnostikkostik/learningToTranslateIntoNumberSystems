<?php
    mysql_connect ("ХОСТ","ЛОГИН","ПАРОЛЬ");
    mysql_select_db ("БАЗА");
    mysql_query("SET NAMES utf8");
	
	$log = $_GET['login'];
	$pass = $_GET['password'];
	
	
	if (empty($log) || empty($pass))
	    echo "ERROR=100";
	else
	{
		$query = mysql_query("SELECT * FROM teachers WHERE login='$log' and password='$pass'");
		$sql = $query or die(mysql_error());
		
		if (mysql_num_rows($sql) > 0)
		{
			do
			{
				$id_P = intval(file_get_contents("https://www.random.org/integers/?num=1&min=100&max=999&col=1&base=10&format=plain&rnd=new"));
				$temp = mysql_query("SELECT * FROM teachers WHERE id_P='$id_P'");;
				
			} while (mysql_num_rows($temp) > 0);
			
		mysql_query("UPDATE teachers SET id_P = '$id_P' WHERE login='$log' and password='$pass'");
		echo "id=$id_P;";
		}
		else
			echo "ERROR=101";
		
	}
?>