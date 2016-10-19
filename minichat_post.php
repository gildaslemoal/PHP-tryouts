<?php

//Connexion à la base de données

try
{

	$bdd = new PDO('mysql:host=localhost;dbname=sdz;charset=utf8', 'root', '');

}

catch(Exception $e)
{

	die('Erreur : '.$e->getMessage());

}


// Récupérer le message et le pseudo envoyé par minichat.php et prévenir les failles XSS

$pseudo = htmlspecialchars($_POST['pseudo']);
$message = htmlspecialchars($_POST['message']);

// Enregistrer le message dans la bdd

$req = $bdd-> prepare('INSERT INTO minichat (pseudo, message, info_date) VALUES (?, ?, NOW())');
$req->execute(array(
	$pseudo,
	$message,
	));

// Rediriger vers minichat.php

header('Location: minichat.php');
?>
