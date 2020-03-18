<?php
    mysql_connect ("ХОСТ","ЛОГИН","ПАРОЛЬ");
    mysql_select_db ("БАЗА");
    mysql_query("SET NAMES utf8");
	
	$id_P = $_GET['id_P'];
	$id_S = $_GET['id_S'];
	
	if (empty($id_P))
	    echo "ERROR=100";
	else
	{
		$query = mysql_query("SELECT * FROM teachers WHERE id_P='$id_P'");
		$sql = $query or die(mysql_error());
		
		if (mysql_num_rows($sql) > 0)
		{
		    if (file_exists("Data/$id_S.xml"))
			{
			    $xml = simplexml_load_file("Data/$id_S.xml");
				echo count($xml);
				
				foreach ($xml as $value)
				{
					//echo "$i=$value;";
					//$i++;
				}
			    print_r($xml);
			}
			else
				echo "ERROR=102";
		}
		else
		{
			echo "ERROR=101";
		}
	}
?>