# README

Ce projet PHP permet de générer rapidement un quiz en ligne en monopage.

## Pourquoi ce projet est trop cool ?

Le quiz ne nécessite pas de base de données.  
A la fin du quiz, l'utilisateur reçoit les résultats par mail.

## Paramétrage

Le quiz est chronométré. La **durée du quiz** se paramètre dans test.php (variable $dureeMinutesTest).  
Toutes les **questions et réponses** sont gérées dans le fichier questions.php.  
N'oubliez pas de configurer l'**adresse e-mail de l'envoyeur** dans le fichier reponses-test.php.  
Le **seuil de réussite** du quiz peut être configuré dans fonctions-resultats.php.
