<?php

$forbifdden = FALSE;
$date_18 = 0;
$date_naissance = 0;
$birthdateInsert = 0;

// on initialise un tableau d'erreur
$formError = array();
//on initilaise une variable a false
$isSuccess = FALSE;

$age = [];

//CALCUL DE L'AGE
// on décortique la date d'aujourd'hui (jour,mois et année):
$an_now = date("Y");
$mois_now = date("m");
$jour_now = date("d");

if (isset($_POST['ageButton'])) {
    //on transforme la date US qui arrive en date FR
    $birthdateInsert = strftime('%d-%m-%Y', strtotime($_POST['birthDate']));
    $date_naiss = $birthdateInsert;
//on décortique la date de naissance (jour,mois et année):
    $an = substr($date_naiss, 6, 4);
    $mois = substr($date_naiss, 3, 2);
    $jour = substr($date_naiss, 0, 2);
//on soustrait l'année de naissance de l'année actuelle :
    $age = $an_now - $an;
//si le jour de naissance n'est pas encore passé, on retire une année :
    if (($mois > $mois_now) or ( ($mois == $mois_now) and ( $jour > $jour_now))) {
        $age = $age - 1;
    }
    //si la varibale $age est inferieur à 18 on interdit l'acces
    if ($age < 18) {
        $forbifdden = TRUE;
        // sinon on dirige vers le formulaire    
    } elseif ($age >= 18) {
        header('location: form.php');
        exit();
    }
}



          
          
