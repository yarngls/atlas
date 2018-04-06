<?php

	require_once "../config/db_config.php";
	
	$db=connection();

	$want = $_SERVER["REQUEST_METHOD"];

	switch ($want) {
		case 'POST':
			$user = json_decode(file_get_contents("php://input"), true);

			$username = $user['username'];
			$password = $user['password'];

			$select_all=$db->query("INSERT into utilizadores(username,password)
									values('$username', '$password');") 
								or die(mysqli_error($db));

			$id=mysqli_insert_id($db);
			$user["id"] = $id;

			echo json_encode($user);

		break;
		case 'GET':

			if(isset($_GET["username"])){
				$id = $_GET["id"];
				$db=connect();

				$select_all=$db->query("SELECT * FROM cliente where id='$id';");

				$data = mysqli_fetch_assoc($select_all);

				echo json_encode($data);
			}
		break;
		case 'PUT':
			$user = json_decode(file_get_contents("php://input"),true);
			$username = $user['username'];
			$password = $user['password'];
			

			$select_all=$db->query("SELECT COUNT(username) as total FROM utilizadores where username='$username'
										and password='$password';
										;");
			$total = mysqli_fetch_assoc($select_all);			
			echo json_encode($total);

		break;
		default:
			echo json_decode(["erro"=>"404"]);	
		break;
	}

?>

