<?php

//j'initialise un tableau d'erreur
$formError = array();
//j'initialise mes variables a false
$addSuccess = FALSE;
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

// On instancie un nouvel objet user avec comme classe clik_Users
$user = new clik_Users();
$getProfilForAdmin = $user->getAllProfilForAdminPage();

// on instencie un nouvel objet $haveRoles 
//appel la methode getRolesLsit qui permet d'afficher les roles
$haveRoles = new clik_Roles();
$getRoles = $haveRoles->getRolesList();

//on insencie un nouvel objet $updateRoles
$updateRoles = new clik_Users();

//si mon tableau $_POST recoit id_clik_roles
if (!empty($_POST['id_clik_Roles'])) {
    // je protege 
    $updateRoles->id_clik_roles = htmlspecialchars($_POST['id_clik_Roles']);
    $updateRoles->id = htmlspecialchars($_POST['userId']);
}

//si mon tableau $formError ne comporte pas d'erreurs
if (count($formError) == 0 && isset($_POST['sendForm'])) {
    //si mon tableau ne corrspond pas a ce que la methode attend
    if (!$updateRoles->updateRoleInAdminPage()) {
        //j'en voie une erreur dans mon tableau $formError
        $formError['add'] = 'l\'envoie du formulaire à échoué';
    } else {
        //sinon je valide via mon bolleen initialisé a false plus haut
        $addSuccess = true;
        //je rafraichis ma page
        header('location: adminRoles.php');
        exit();
    }
}
    