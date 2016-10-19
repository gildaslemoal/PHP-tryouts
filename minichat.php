<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" />
	<title>minichat</title>
</head>
<style>
	form, h1 {text-align: center}
</style>

<body>

	<h1>MINICHAT</h1>
	<br />

	<?php

	// Connexion à la base de données

	try
	{

		$bdd = new PDO('mysql:host=localhost;dbname=sdz;charset=utf8', 'root', '');
	}

	catch(Exception $e)
	{

		die('Erreur : '.$e->getMessage());

	}

	// Récupération du pseudo le plus récemment enregistré

	$reponse = $bdd->query('SELECT pseudo FROM minichat ORDER BY info_date DESC LIMIT 1');
	$donnees = $reponse->fetch();	 
	$reponse->closeCursor();
	?>

	<!-- Afficher le formulaire -->

	<form action="minichat_post.php" method="post" >

		<p>
			<em>Pseudo : </em>
			<!-- Affichage du dernier pseudo enregistré -->
			<input type="text" name="pseudo" value="<?php echo $donnees['pseudo']; ?>" />
			<br />
		</p>
		<p>
			<em>Message :</em>
			<input type="text" name="message" />
			<br />
		</p>
		<p>
			<input type="submit" value="Valider" />
		</p>


	</form>

	<?php	

	// Afficher les 10 derniers messages avec date en format européen et pseudo

	$reponse = $bdd->query('SELECT pseudo, message, DATE_FORMAT(info_date, \'%d/%m/%Y %Hh%im%ss\') AS infodate FROM minichat ORDER BY id DESC LIMIT 0, 10');

	while ($donnees = $reponse->fetch())
	{
		?>	
		<p>
			[<?php echo $donnees['infodate'];?>]
			<strong><?php echo $donnees['pseudo'];?></strong> : 
			<?php echo $donnees['message'];?>
		</p>

		<?php
	}

	$reponse->closeCursor();

	?>

	<br />

</body>
