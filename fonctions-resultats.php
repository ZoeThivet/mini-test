<?php

if(sizeof($bonnesReponses) != sizeof($_SESSION['reponses'])){
		header("Location:test.php");
		exit;
	}

	// Calcul du score
	$score = 0;
	$messageScore;
	for($i = 0; $i < sizeof($bonnesReponses); $i++){
		if(intval($bonnesReponses[$i]) == intval($_SESSION['reponses'][$i])){
			$score ++;
		}
	}

	$messageScore = "Vous avez bien répondu à ".$score." question(s) sur ".sizeof($bonnesReponses).", soit ".number_format(($score / sizeof($bonnesReponses) * 100), 2)."&nbsp;% de réussite.";
	if($score / sizeof($bonnesReponses) < 0.65){
		$messageScore = $messageScore." Il faudrait monter jusqu'à 65&nbsp;%. Courage&nbsp;!";
	} else {
		$messageScore = $messageScore." C'est suffisant pour l'examen ISTQB qui demande 65&nbsp;% de réponses justes. Bravo&nbsp;!";
	}

?>

?>