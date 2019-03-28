<?php
	session_start();
	require_once "../db.php";
	
	if ($_SESSION["username"] != "admin") {
		header("location: ../index.php");
	}
	
	$db = db::get();
	$selectString = "SELECT * FROM languages";
	$alllanguages = $db->getArray($selectString);
	
	if (isset($_GET["error"])) {
	$error = $db->escape($_GET["error"]);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once("../head.php"); ?>
	<link rel="stylesheet" href="../css/sweetalert2.min.css">
	<script src="../js/sweetalert2.all.min.js"></script>
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
	<script>
		function errormsg(errortext)
		{
			Swal.fire({
				type: 'error',
				title: 'Hiba',
				text: errortext + "!",
			})
		}
	</script>
</head>
<body class="bg">
	<?php
		switch ($error) {
			case 'empty':
			echo "<script>errortext = 'Jelenleg nincs egy nyelv sem, töltsön fel párat!'; errormsg(errortext);</script>";
			break;
			default:
			# code..
			break;
		}
	?>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Adatszerkesztés</a>
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
						<a class="nav-link" href="listBook.php">Könyv kiadás szerkesztés</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="listWriter.php">Író szerkesztés</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="listCategory.php">Műfaj szerkesztés</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="listLanguage.php">Nyelv szerkesztés</a>
					</li>
				<?php endif; ?>
				</ul>
			</div>
		</nav>

		<?php if(count($alllanguages) == 0):?>
			<?php echo "<script>window.location.href='listLanguage.php?error=empty'</script>"; ?>
		<?php else:?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Nyelv</th>
						<th>Szerkesztés</th>
					</tr>
				</thead>
				<tbody>
			<?php foreach($alllanguages as $languages):?>
				<tr>
					<td><?php echo $languages["id"]; ?></td>
					<td><?php echo $languages["language"]; ?></td>
					<td><a href="updateLanguage.php?languageid=<?php echo $languages["id"];?>">Szerkesztés</a></td>
				</tr>
			<?php endforeach;?>
		<?php endif;?>
		
	</body>
</html>