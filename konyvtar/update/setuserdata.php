<?php 
	session_start();
	require_once "../db.php";
	$db = db::geT();
	$selectUserPassConfQuery = "SELECT password, id FROM users WHERE username ='".$_SESSION["username"]."'";
	$getPassConf = $db->getArray($selectUserPassConfQuery);
	foreach ($getPassConf as $passconf) {
		$passwordconf = $passconf["password"];
		$userid = $passconf["id"];
	}
	$email = $db->escape($_POST["emailAddress"]);
	$birthday = $db->escape($_POST["birthday"]);
	$passconfEntered = $db->escape($_POST["currentPassword"]);
	$passconfEntered = md5($passconfEntered);
	$newPassword = $db->escape($_POST["newPassword"]);
	$tmp = $db->escape($_POST["newPassword"]);
	$newPassword = md5($newPassword);
	$newPassword2 = $db->escape($_POST["newPassword2"]);
	$newPassword2 = md5($newPassword2);
if (empty($email) || empty($birthday) || empty($passconfEntered)) {
	echo "<script>window.location.href='listMyUser.php?error=empty'</script>";
}
else
{
	if ($passwordconf == $passconfEntered) {
		if (!(empty($newPassword2)) || !(empty($newPassword2))) {
			if ($newPassword2 == $newPassword) {
				if (strlen($tmp) >= 8) {
					$updateWithNewPasswordQuery = "UPDATE `users` SET `password` = '$newPassword', `email` = '$email', `birthday` = '$birthday' WHERE `users`.`id` = ".$userid;
					$update = $db->query($updateWithNewPasswordQuery); echo strlen($newPassword);
					echo "<script>window.location.href='listMyUser.php?success=donePW'</script>";
				}
				else
				{
					echo "<script>window.location.href='listMyUser.php?error=shortPW'</script>";
				}
			}
			else
			{
				echo "<script>window.location.href='listMyUser.php?error=noMatch'</script>";
			}
		}
		elseif (empty($newPassword2) && empty($newPassword)) {
			$updateWithNewPasswordQuery = "UPDATE `users` SET `email` = '$email', `birthday` = '$birthday' WHERE `users`.`id` = ".$userid;
				$update = $db->query($updateWithNewPasswordQuery);
				echo "<script>window.location.href='listMyUser.php?success=done'</script>";
			}
			else
			{
				echo "<script>window.location.href='listMyUser.php?error=invalidPW'</script>";
			}
		}
		else
		{
			echo "<script>window.location.href='listMyUser.php?error=wrongPW'</script>";
		}
	}
	
 ?>