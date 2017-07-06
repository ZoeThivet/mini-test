<?php

$seuil = 65;

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
	if($score / sizeof($bonnesReponses) * 100 < $seuil){
		$messageScore = $messageScore." Il faudrait monter jusqu'à ".$seuil."&nbsp;%. Courage&nbsp;!";
	} else {
		$messageScore = $messageScore." C'est suffisant, il fallait ".$seuil."&nbsp;% de réponses justes. Bravo&nbsp;!";
	}

?>

?>