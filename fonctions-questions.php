<?php

$_SESSION['nbQuestions'] = 0;

class Question {
    public $numeroQuestion;
    public $intitule;
    public $reponse1;
    public $reponse2;
    public $reponse3;
    public $reponse4;
    
    public function __construct($numeroQuestion, $intitule, $reponse1, $reponse2, $reponse3, $reponse4, $bonneReponse) {
        $this->numeroQuestion = $numeroQuestion;
        $this->intitule       = $intitule;
        $this->reponse1       = $reponse1;
        $this->reponse2       = $reponse2;
        $this->reponse3       = $reponse3;
        $this->reponse4       = $reponse4;
        $this->bonneReponse   = $bonneReponse;
        $_SESSION['nbQuestions']++;
    }
    
    // L'affichage des questions n'est pas le même avant et après validation des résultats.
    public function afficherQuestion($isAffichageSolution, $numReponseJuste) {
        $message = "";
        if(!$isAffichageSolution){
            // Affichage des questions avec les cases à cocher
            $message = $message . "<br>";
            $message = $message . "<p><b>" . strval(intval($this->numeroQuestion) + 1) . " - " . $this->intitule . "</b></p>";
            $message = $message . "<div>";
            for($i = 0; $i < 4; $i++){
                $j = $i + 1;
                $message = $message . "<input type='radio' name='" . strval($this->numeroQuestion) . "' value='".$j."'>&nbsp;".$j.".&nbsp;" . $this->{"reponse".strval($j)} . "<br>";
            }
            // Une réponse nulle, cachée et pré-cochée (si l'utilisateur ne répond à rien, il a forcément faux)
            $message = $message . "<input type='radio' name='" . strval($this->numeroQuestion) . "' value='5' style='display:none' checked>";
            $message = $message . "</div>";
            $message = $message . "<br><hr>";
        } else {
            // Affichage des questions avec mise en valeur de la bonne réponse
            $message = $message . "<br><div><b>" . $this->intitule . "</b></div><br>";
            for($i = 0; $i < 4; $i++){
                $j = $i + 1;
                if(intval($numReponseJuste == $j)){
                    $message = $message . $j.".&nbsp;<b>" .$this->{"reponse".$j} . "</b><br>";
                } else {
                    $message = $message . $j.".&nbsp;" .$this->{"reponse".$j} . "<br>";
                }
            }
        }
        return $message;
    }

    public function afficherReponse($reponseJuste){
        $solution = "Solution";
        if($reponseJuste){
            $message = "<p style='color:green'>Vous avez trouvé la bonne réponse&nbsp;!</p><hr>";
        } else {
            $message = "<p style='color:red'>Vous n'avez pas trouvé cette réponse.</p><hr>";
        }
        return "<br><p><b>".$solution."</b></p><div>".$this->bonneReponse."</div>".$message;
    }
}

?>