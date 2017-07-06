<?php
	session_start();
	$_SESSION['reponses'] = [];
	include("fonctions-questions.php");
 	include_once("questions.php");
 	$urlResultats = "Location:reponses-test.php";

	$_SESSION['resultatsEnvoyes'] = false;

	$dureeMinutesTest = 30;

	$title = "Test";
	$message_bienvenue = "<p>Bienvenue dans ce test.</p><p>Vous avez ".$dureeMinutesTest." minutes pour répondre aux 20 questions.</p><p>Aidez-vous du minuteur en bas de l'écran.</p><p>Bon courage&nbsp;!</p>";
	$titre_header = "Test";
	$message_bouton_valider = "Terminé&nbsp;!";
	$message_chrono = "Temps restant&nbsp;:";
	
	if(isset($_POST["submit"])) {
		for($i = 0; $i < $_SESSION['nbQuestions']; $i++) {
			array_push($_SESSION['reponses'], $_POST[strval($i)]);
		}
		// Redirection vers les réponses en fin de test
		header($urlResultats);
		exit;
	}

?>

<!-- Contient tout le code HTML des pages de questions -->

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title><?php echo $title ?></title>
		<link type="text/css" rel="stylesheet" href="test.css"/>
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
		<meta name="viewport" content="width=device-width" />
	</head>
	<!-- Pour le suivi Google Analytics -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-5338598-54', 'auto');
		ga('send', 'pageview');
	</script>
	<body onload='loader()';>
		<div id='loader' style='font-family: Arial'><?php echo $message_bienvenue ?>
			<div id='loader-circle'></div>
  		</div>
  		<div id='test' style="display:none">
			<div id="wrapper">
				<div id="header">
					<h1><?php echo $titre_header ?></h1>
				</div>
				<div id="main_content">
					<form method="post">
						<?php
							// On affiche toutes les questions en mode "test", avec les cases à cocher (le paramètre 'solution' est à false)
							for($i = 0; $i < $_SESSION['nbQuestions']; $i++){
								echo ${"q".$i}->afficherQuestion(false, 1);
							}
						?>
						<div><input type="submit" name="submit" value="<?php echo $message_bouton_valider ?>" id="submit"></div>
						<br>
					</form>
				</div>
			</div>
			<div id="chrono">
				<img src="chrono.png" style="max-width:20px; max-height:20px; margin-bottom:-2px;">&ensp;<?php echo $message_chrono ?> 
				<span id="minutes"><?php echo $dureeMinutesTest; ?></span> min <span id="secondes">1</span> sec
			</div>
		</div>
	</body>
</html>
<?php

    $message_temps_ecoule = "Temps écoulé&nbsp;!";

?>

<!-- Script du petit timer en bas de l'écran -->

<script type="text/javascript">

var attente;
function minutageGo(){
    var secondes = window.document.getElementById("secondes").innerHTML;
    secondes = parseInt(secondes) - 1;
    window.document.getElementById("secondes").innerHTML = secondes;
    attente = setTimeout("minutageGo()", 1000);
    if(window.document.getElementById("secondes").innerHTML < 0){
    	window.document.getElementById("minutes").innerHTML = parseInt(window.document.getElementById("minutes").innerHTML) - 1;
    	window.document.getElementById("secondes").innerHTML = 59;
    }
    if(window.document.getElementById("minutes").innerHTML == 0 && window.document.getElementById("secondes").innerHTML == 0){
    	window.document.getElementById("chrono").innerHTML = "<span><strong><?php echo $message_temps_ecoule; ?></strong></span>";
    	clearTimeout(attente);
    }
}

	var consigne;
	function loader() {
	    consigne = setTimeout(showPage, 1000);
	}
	function showPage() {
		document.getElementById('loader').style.display = 'none';
		document.getElementById('test').style.display = 'block';
		minutageGo();
	}

</script>