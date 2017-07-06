<?php
	session_start();
	include("fonctions-questions.php");
	include_once("questions.php");
	include("fonctions-resultats.php");

	$titreFormulaire = "On vous envoie vos résultats&nbsp;!";
	$inputMail = "Votre adresse e-mail&nbsp;";
	$titreConfirmation = "Parfait&nbsp;!";
	$corpsConfirmation = "<p>Si vous avez indiqué une adresse e-mail correcte, vous allez recevoir vos résultats dans un instant.</p>";
	$messageMail = "<p>Vous recevez ce courriel car vous avez réalisé un test.</p>";
	$subject     = 'Votre score au test';
	$title = "Résultats du test";
	$titre_header = "Résultats du test";

?>
	
	<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <link type="text/css" rel="stylesheet" href="test.css"/>
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
        <meta name="viewport" content="width=device-width" />
    </head>
   
<?php
	if (isset($_POST["submitMail"])) {
		if(preg_match("/.*@.*\..*/", $_POST["email"])){
			// Gestion du contenu du mail
	    	$message = "
	            <body>
	                <div id='wrapper'>
	                    <div id='header'>
	                        <h1>" . $titre_header . "</h1>
	                    </div>
	                    <div id='main_content'>
	                        <div id='score'>" . $messageScore . "</div>
	                        ";
						    for ($i = 0; $i < $_SESSION['nbQuestions']; $i++) {
						        $reponseJuste = false;
						        if (intval($bonnesReponses[$i]) == intval($_SESSION['reponses'][$i])) {
						            $reponseJuste = true;
						        }
						        $message = $message . ${"q" . $i}->afficherQuestion(true, $bonnesReponses[$i]);
						        $message = $message . ${"q" . $i}->afficherReponse($reponseJuste);
						    }
						    $message = $message . "
	                    </div>
	                </div>
	            </body>
	        ";
		    $messageMail = $messageMail . $message;
		    $to          = $_POST['email'];
		    $headers     = "From: zthivet@gmail.com\r\n";
		    $headers     = $headers . "Content-Type: text/html; charset=UTF-8\r\n";
		    mail($to, $subject, $messageMail, $headers);

		    $_SESSION['resultatsEnvoyes'] = true;
		    header("Location:#");
		    exit;
		} else {
			echo '<p style="display:\'inline-block\'; background-color:orange; padding:20px">Le format de l\'adresse e-mail indiquée est incorrect.</p>';
		}
	    
	}

	// Affichage du formulaire
	if (!$_SESSION['resultatsEnvoyes']) {
	    echo "
	        <body>
	            <div id='wrapper'>
	                <div id='header'>
	                    <h1>" . $titre_header . "</h1>
	                </div>
	                <div id='main_content'>
	                    <form method='post'>
	                        <h2>".$titreFormulaire."</h2>
	                        ".$inputMail.": <input type='text' name='email' id='email' placeholder='cestparti@monkiki.com'></input><br><br>
	                        <p>&ensp;</p>
	                        <input type='submit' name='submitMail' id='submitMail' value='OK'>
	                    </form>
	                </div>
	            </div>
	        </body>";
	    // Remerciements si formulaire rempli
	} else {
	    echo "
	        <body>
	            <div id='wrapper'>
	                <div id='header'>
	                    <h1>" . $titre_header . "</h1>
	                </div>
	            <div id='main_content'>
	                <h2>".$titreConfirmation."</h2>"
	                	.$corpsConfirmation."
	                </div>
	            </div>
	        </body>";
	}

?>
</html>