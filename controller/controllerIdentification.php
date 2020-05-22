<?php

$errorConnection = FALSE;
//creation d'un tableau pour retranscrire les erreurs lors du remplisqge du formaulaire
$formError = array();

//si on remplie le tableau forCooexion
if (!empty($_POST['formConnexion'])) {
    //j'instencie un nouvel objet $idUser de la classe clik_Users
    $idUser = new clik_Users();
    // Variable pseudo qui vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $idUser->mailConnect = htmlspecialchars($_POST['mailConnect']);
    $idUser->password = htmlspecialchars($_POST['password']);
    if (!empty($idUser->mailConnect) AND ! empty($idUser->password)) {
        $pass = $idUser->getConnect();
        //is_object — Détermine si une variable est de type objet
        if (is_object($pass)) {
            //password_verify — Vérifie qu'un mot de passe correspond à un hachage
            if (password_verify($idUser->password, $pass->password)) {
                //si le mot de passe correspond, j'initialise mon tableau $_SESSION
                //j'y insere le role, l'id, le mail et le pseudo de l'utilisateur qui vient de se connecter
                $_SESSION['id'] = $pass->id;
                $_SESSION['roles'] = $pass->id_clik_Roles;
                $_SESSION['mail'] = $pass->mail;
                $_SESSION['pseudo'] = $pass->pseudo;
                //je redirige vers la page principale
                header('Location: principal.php');
                exit();
                // si les champs inserés ne correspondent pas, on signal juste qu'aucun compte n'a ete trouvé
                //cela evite de donner des indications à une personne malveillante
            } else {
                $errorConnection = TRUE;
            }
        } else {
            $errorConnection = TRUE;
        }
    }
}







    