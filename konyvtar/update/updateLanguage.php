<?php 
	if(isset($_GET["languageid"])){
		require_once "../db.php";
		$db = db::get();
		$id = $db->escape($_GET["languageid"]);
		if(isset($_POST["submitForm"])){
			$language = $db->escape($_POST["language"]);
			if(empty($language)){
				$errorMsg  = "Minden mező kitöltése kötelező";
			}else{
				$updateString = "UPDATE languages SET
					`language`='".$language."'
				WHERE id=".$id;
				$db->query($updateString);
				header("Location: listLanguage.php");
			}
		}
		$selectString = "SELECT * FROM languages WHERE id=".$id;
		$languages = $db->getRow($selectString);
	}else{
		header("Location: listLanguage.php");
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
		.input
		{
			-webkit-box-shadow: inset 13px 6px 26px -2px rgba(0,0,0,0.75);
			-moz-box-shadow: inset 13px 6px 26px -2px rgba(0,0,0,0.75);
			box-shadow: inset 13px 6px 26px -2px rgba(0,0,0,0.75);
		}
		</style>
	</head>
	<body class="bg">
		<form class="container form-group text-center" action="" method="POST">
				Műfaj:
			<input type="text" class="input form-control" name="language" value="<?php echo (isset($languages)) ? $languages["language"] : "" ; ?>"><br>
			<button type="submit" name="submitForm" class="btn btn-success">Mentés</button>
			<a href="listLanguage.php" class="btn btn-primary">Vissza</a>
		</form>
	</body>
</html>