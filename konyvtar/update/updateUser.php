<?php 
	if(isset($_GET["usersid"])){
		require_once "../db.php";
		$db = db::get();
		$id = $db->escape($_GET["usersid"]);
		if(isset($_POST["submitForm"])){
			$username = $db->escape($_POST["username"]);
			$email = $db->escape($_POST["email"]);
			if(empty($username) ||empty($email)){
				$errorMsg  = "Minden mező kitöltése kötelező";
			}else{
				$checkEsersQuery = "SELECT * FROM users WHERE username ='".$username."'";
				$check = $db->getArray($checkEsersQuery);
				if (empty($check)) {
					$updateString = "UPDATE users SET
						`username`='".$username."',
						`email`='".$email."'
						WHERE id=".$id;
						$db->query($updateString);
						header("Location: listUser.php");
						echo "<script>window.location.href='listUser.php?success=done'</script>";
					}else{
						echo "<script>window.location.href='listUser.php?error=copy'</script>";
					}	
				}
			}
		$selectString = "SELECT * FROM users WHERE id=".$id;
		$users = $db->getRow($selectString);
	}else{
		header("Location: listUser.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once("../head.php"); ?>
		<style>
        .bg
        {
            background-image: url("http://www.budaorsiinfo.hu/wp-content/uploads/2013/12/konyv_illusztr.jpg");
            background-size: cover;
            background-repeat: none;
        }
 
        .bg img
        {
            height: 100%;
            width: 100%;
        }
 
    </style>
	</head>
	<body class="bg">
	<div class="container">
		<form class="container form-group text-center" action="" method="POST">
			<label>Neve:</label>
			<input type="text" class="input form-control" name="username" value="<?php echo (isset($users)) ? $users["username"] : "" ; ?>"><br>
			<label>E-mail cím:</label>
			<input type="email" class="input form-control" name="email" value="<?php echo (isset($users)) ? $users["email"] : "" ; ?>"><br>
			<button type="submit" class="btn btn-success" name="submitForm">
				Mentés
			</button>
		</form>
	</div>
	</body>
</html>
