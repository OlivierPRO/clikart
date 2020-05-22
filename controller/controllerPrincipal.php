<?php

//on initialise un tableau d'erreur
$formError = array();

//on initialise des variables a FALSE
$roleAdmin = FALSE;
$roleModeration = FALSE;

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

//on instencie un objet $havelabel de la classe clik_Users
$havelabel = new clik_Users();

//condition qui initialise la barre de recherche, uniquement sur la principal pour le moment
// à étendre sur la V2
if (isset($_POST['searchButton'])) {
    $getLabel = $havelabel->searchProfilPseudo(htmlspecialchars($_POST['search']));
} else {
    $getLabel = $havelabel->getProfilForLabel();
}

