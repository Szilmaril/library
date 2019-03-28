<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	require_once "../db.php";
	
	if ($_SESSION["username"] != "admin") {
		header("location: index.php");
	}
	$db = db::get();
	if (isset($_GET["success"])) {
	$success = $db->escape($_GET["success"]);
	}
	if (isset($_GET["error"])) {
	$error = $db->escape($_GET["error"]);
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
		
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Adatfeltöltés</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
				<?php if($_SESSION["username"] == "admin"): ?>
					<li class="nav-item">
						<a class="nav-link" href="../list.php">Főoldal</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="uploadBook.php">Könyv kiadás feltöltés</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="uploadWriter.php">Író feltöltés</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="uploadCategory.php">Műfaj feltöltés</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="uploadLanguage.php">Nyelv feltöltés</a>
					</li>
				<?php endif; ?>
				</ul>
			</div>
		</nav>
	<div class="container">	
		<form class="container form-group text-center" action="" method="POST">
			
			<label>Műfaj: </label>
			<input type="text" name="genre" class="input form-control" value="<?php echo (isset($category)) ? $category["genre"] : "" ; ?>" required="true"><br>
	
			<button class="btn btn-success" type="submit" name="submitForm">Mentés</button>
		</form>
	</div>
<?php
	if(isset($_POST["submitForm"])){
		$genre = $db->escape($_POST["genre"]);
		
	if(empty($genre)){
		echo "Minden mező kitöltése kötelező!";
	}else{
		$insertString = "INSERT INTO category(
				`genre`
				) VALUE(
				'".$genre."'
				);";
			$db->query($insertString);
		}
	}
?>
</body>
</html>