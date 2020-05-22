<?php

//j'initialise un tableau d'erreur
$formError = array();

//j'initialise mes variables a false
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

// On instancie un nouveau user objet comme classe clik_Users
$user = new clik_Users();
$getProfilForAdmin = $user->getAllProfilForAdminPage();

// affiche la boucle du role 
$haveRoles = new clik_Roles();
$getRoles = $haveRoles->getRolesList();

//condition qui permet à l'admin d'effecer la photo de profil
if (!empty($_GET['erasePhoto'])) {
    $user->id = htmlspecialchars($_GET['erasePhoto']);
    $user->erasePhoto();
    header('Location: admin.php');
    exit();
} 

//condition qui permet à l'admin d'effacer un compte
if (!empty($_GET['eraseCount'])) {
    $erase = new clik_Users;
    $erase->id = htmlspecialchars($_GET['eraseCount']);
    $erase->deleteProfil();
    header('location: admin.php');
    exit();
}


