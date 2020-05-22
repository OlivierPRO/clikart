<?php

// on initialise un tableau d'erreur
$formError = array();

//on initilise des variables a false 
$roleAdmin = FALSE;
$roleModeration = FALSE;
$addSuccess = FALSE;
$commentSuccess = FALSE;
$modeleInfoSucces = FALSE;

$nb_fichier = 0;

//si ma session est egal a 1 je suis admin
//me permet d'afficher les options d'admin
if ($_SESSION['roles'] == '1') {
    $roleAdmin = TRUE;
}

//si ma session est egal a 2 ou 3 je suis moderateur
//permet d'afficher les options de moderateur
if ($_SESSION['roles'] == '2' OR $_SESSION['roles'] == '3') {
    $roleModeration = TRUE;
}

// On instancie un nouveau idUsers objet comme classe clik_Users
$idUser = new clik_Users();
$idUser->id = htmlspecialchars($_GET['id']);
$profilFind = $idUser->getProfilForProfilPage();

//permet d'afficher les informations du model 
$modelInfo = new clik_Infos;
$modelInfo->id = htmlspecialchars($_GET['id']);
$getModelInfo = $modelInfo->getModelInfos();

// permet à l'admin de supprimer les commentaires
$deleteComment = new clik_Comments();
if (isset($_POST['deleteButton'])) {
    $deleteComment->idComments = htmlspecialchars($_POST['idComments']);
    $deleteComment->deleteCommentsByAdmin();
}

//on instencie un nouvel objet de la classe clik_Comments
$comments = new clik_Comments();

//On test la valeur mail dans l'array $_POST, si elle existe via premier if
if (isset($_POST['comment'])) {
    // Variable mail qui vérifie que les caractères speciaux soient converties en entité html via htmlspecialchars = protection
    $comments->comments = htmlspecialchars($_POST['comment']);
    // Si le post est vide
    if (empty($comments->comments)) {
        // J'affiche le message d'erreur
        $formError['comment'] = 'le champs n\'est pas remplie';
    }
}

if (count($formError) == 0 && isset($_POST['commentSend'])) {
    $comments->id_clik_Users = $_SESSION['id'];
    $comments->id_clik_Users_have5 = $_GET['id'];
    $comments->haveComment();
    $commentSuccess = TRUE;
}

//instencie un objet pour afficher les commentaires grace a la methode getPseudoComment()
$commented = new clik_Comments();
$commented->id = htmlspecialchars($_GET['id']);
$displayComments = $commented->getPseudoComment();

//CALCUL DE L'AGE
// on décortique la date d'aujourd'hui (jour,mois et année):
$an_now = date("Y");
$mois_now = date("m");
$jour_now = date("d");
$date_naiss = $idUser->birthdate;
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
