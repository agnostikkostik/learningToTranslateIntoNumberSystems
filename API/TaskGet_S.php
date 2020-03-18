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
			if (file_exists('Data/'.$id_S.'.xml'))
    			if (date("F d Y", filemtime('Data/'.$id_S.'.xml')) != date("F d Y"))
				{
					$fp = fopen('Data/'.$id_S.'.xml', "w");
				    fwrite($fp, "<data>\r\n");
				}
				else
					$fp = fopen('Data/'.$id_S.'.xml', "a");
			else
			{
				$fp = fopen('Data/'.$id_S.'.xml', "w");
				fwrite($fp, "<data>\r\n");
			}
			
			$task = intval(file_get_contents("https://www.random.org/integers/?num=1&min=1&max=100&col=1&base=10&format=plain&rnd=new"));
			fwrite($fp, "    <task>\r\n");
			fwrite($fp, "		<task>$task</task>\r\n");
			fwrite($fp, "		<SS_from>10</SS_from>\r\n");
			fwrite($fp, "		<SS_to>2</SS_to>\r\n");
			fwrite($fp, "		<answer>");
			
			fclose($fp);
			
			echo "task=$task;SS_from=10;SS_to=2;";
		}
		else
		{
			echo "ERROR=101";
		}
	}
?>