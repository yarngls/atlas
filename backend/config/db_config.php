<?php

		//include_once(any thing);

	//------   Servidor Local Host 	----------
	$db_host		= "127.0.0.1";
	$db_user 		= "root";
	$db_password 	= "";
	$db_name 		= "snirh";


	// ------   Servidor OnLine ----------
	/*$db_host = "127.0.0.1";
	$db_user = "root";
	$db_password = "b3nl1t3ch18";
	$db_name = "credenciais";*/



	$connection = mysqli_connect($db_host,$db_user,$db_password,$db_name);
	if(mysqli_connect_errno($connection)){
		die();
	}	
	header("Content-Type: application/json");

?>