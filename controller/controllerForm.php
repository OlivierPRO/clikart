<?php

//creation d'un tableau pour retranscrire les erreurs lors du remplisqge du formaulaire
$formError = array();

//initilaiser $addsucces en false pour afficher les messages
$addSuccess = FALSE;
$error = FALSE;

// On instancie un nouveau $departments objet comme classe clik_departments
$departments = new clik_Departments();
$getDepartment = $departments->getDepartmentList();

// On instancie un nouvel objet idUsers comme classe clik_Users
$idUser = new clik_Users();

//creation des regex pour controler les donnees du formulaire
$regexPseudo = '/^[0-9a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ-]+$/';
$regexBirthdate = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';

//On test la valeur firstname dans l'array $_POST, si elle existe via premier if
if (isset($_POST['pseudo'])) {
    // Variable pseudo qui vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $idUser->pseudo = htmlspecialchars($_POST['pseudo']);
    // On test que la variable n'est pas égale à la regeX
    if (!preg_match($regexPseudo, $idUser->pseudo)) {
        // je crée le message d'erreur suivant dans le tableau d'erreur
        $formError['pseudo'] = 'Votre pseudo ne doit contenir que des lettres et des chiffres';
    }
    // Si le post pseudo n'est pas rempli (donc vide)
    if (empty($idUser->pseudo)) {
        // je crée le message d'erreur suivant dans le tableau d'erreur
        $formError['pseudo'] = 'Champs obligatoire';
    }
}

//on verifie que les mots de passe soient identiques
if (isset($_POST['password'])) {
    if ($_POST['password'] != $_POST['password2']) {
        $formError['password'] = 'vos mots de passe ne sont pas identiques';
    }
}

//On test la valeur password dans l'array $_POST, si elle existe via premier if
if (isset($_POST['password'])) {
    // fonction password_hash() — Crée une clé de hachage pour un mot de passe
    $idUser->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // Si le post est vide
    if (empty($_POST['password'])) {
        // J'affiche le message d'erreur
        $formError['password'] = 'Champs obligatoire';
    }
}

//On test la valeur mail dans l'array $_POST, si elle existe via premier if
if (isset($_POST['password2'])) {
    // fonction password_hash() — Crée une clé de hachage pour un mot de passe
    $idUser->password2 = password_hash($_POST['password2'], PASSWORD_DEFAULT);
    // Si le post est vide
    if (empty($_POST['password2'])) {
        // J'affiche le message d'erreur
        $formError['password2'] = 'Champs obligatoire';
    }
}

//on verifie que les mails soient identiques entre mail et mail2 dans les input
if (isset($_POST['mail'])) {
    if ($_POST['mail'] != $_POST['mail2']) {
        // si differents j'affiche une erreur
        $formError['mail'] = 'vos mails ne sont pas identiques';
    }
}

//On test la valeur mail dans l'array $_POST, si elle existe via premier if
if (isset($_POST['mail'])) {
    // fonction filter_var() — Filtre une variable avec un filtre spécifique
    //on utilise ici avec le filtre validate_email
    if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        // Variable mail qui vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
        $idUser->mail = htmlspecialchars($_POST['mail']);
    } else {
        $formError['mail'] = 'le champs n\'est pas valide';
    }
    // Si le post est vide
    if (empty($_POST['mail'])) {
        // J'affiche le message d'erreur
        $formError['mail'] = 'Champs obligatoire';
    }
}

//On test la valeur mail dans l'array $_POST, si elle existe via premier if
if (isset($_POST['mail2'])) {
    if (filter_var($_POST['mail2'], FILTER_VALIDATE_EMAIL)) {
        $idUser->mail2 = htmlspecialchars($_POST['mail2']);
    } else {
        $formError['mail2'] = 'le champs n\'est pas valide';
    }
    // Si le post est vide
    if (empty($_POST['mail2'])) {
        // J'affiche le message d'erreur
        $formError['mail2'] = 'Champs obligatoire';
    }
}

//On test la valeur birthdate dans l'array $_POST, si elle existe via premier if
if (isset($_POST['birthdate'])) {
    // Variable birthdate qui vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $idUser->birthdate = htmlspecialchars($_POST['birthdate']);
    // On test que la variable n'est pas égale à la regeX
    if (!preg_match($regexBirthdate, $idUser->birthdate)) {
        // J'affiche l'erreur
        $formError['birthdate'] = 'Votre date de naissance doit être de type 30/10/1985';
    }
    // Si le post est vide
    if (empty($idUser->birthdate)) {
        // J'affiche le message d'erreur
        $formError['birthdate'] = 'Champs obligatoire';
    }
}

//On test la valeur retribution dans l'array $_POST, si elle existe via premier if
if (isset($_POST['retribution'])) {
    // Variable retribution qui vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $idUser->retribution = htmlspecialchars($_POST['retribution']);
    // Si le post est vide
    if (empty($_POST['retribution'])) {
        // J'affiche le message d'erreur
        $formError['retribution'] = 'Champs obligatoire';
    }
}

//On test la valeur description dans l'array $_POST, si elle existe via premier if
if (isset($_POST['description'])) {
    // Variable mail qui vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $idUser->description = htmlspecialchars($_POST['description']);
    // Si le post est vide
    if (empty($idUser->description)) {
        // J'affiche le message d'erreur
        $formError['description'] = 'Champs obligatoire';
    }
}

//On test la valeur idDepartments dans l'array $_POST, si elle existe via premier if
if (isset($_POST['idDepartments'])) {
    //  vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $idUser->id_clik_Departments = htmlspecialchars($_POST['idDepartments']);
    // Si le post est vide
    if (empty($idUser->id_clik_Departments)) {
        // J'affiche le message d'erreur
        $formError['idDepartments'] = 'Champs obligatoire';
    }
}

//On test la valeur roles dans l'array $_POST, si elle existe via premier if
if (isset($_POST['idRoles'])) {
    //vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $idUser->id_clik_Roles = htmlspecialchars($_POST['idRoles']);
    //si le post est egaal à 4 on insert une photo de profil par defaut
    if ($idUser->id_clik_Roles == 4) {
        $idUser->photoProfil = 'assets/members/profilPhoto/default/photographDefault.jpg';
    }
    if ($idUser->id_clik_Roles == 5) {
        $idUser->photoProfil = 'assets/members/profilPhoto/default/modelDefault.jpg';
    }
}
if (isset($_POST['idRoles']) AND empty($_POST['idRoles'])) {
    $formError['idRoles'] = 'Merci d\'indiquer si vous etes photographe ou modèle';
}
//si le post est egal à 5 on insert une photo de profil par defaut
//on verifie que le mail ne corresponde pas a un amil deja inscrit de la base de donnéé
//grace a la methode checkFreeMail
if (!empty($_POST['mail'])) {
    // on verifier en appelant la methode chekFreeMail()
    $checkFreeMail = $idUser->checkFreeMail();
    //la methode compte le nombre de mail corrspondant, s'il est egal a 1, un compte existe deja
    if ($checkFreeMail >= 1) {
        //on envoie une erreur dans le tableau 
        $formError['mail'] = 'un compte existe deja avec ce mail';
    }
}

//on verifie que le Pseudo ne corresponde pas deja à inscrit de la base de donnéé
//grace a la methode checkFreePseudo
if (!empty($_POST['pseudo'])) {
    $checkFreePseudo = $idUser->checkFreePseudo();
    //la methode compte le nombre de pseudo corrspondant, s'il est egal a 1, un compte existe deja
    if ($checkFreePseudo >= 1) {
        //on envoie une erreur dans nle tableau 
        $formError['pseudo'] = 'Ce pseudo est deja prit, merci d\'en changer';
    }
}

//on vérifie que nous avons crée une entrée submit dans l'array $_POST, si présent on éxécute la méthode addUser()
if (count($formError) == 0 && isset($_POST['sendForm'])) {
    if (!$idUser->addUser()) {
        $error = TRUE;
    } else {
        $addSuccess = TRUE;
        // au succes de la creation du compte on créé 2 dossiers avec pour valeur l'id grace a la fonction lastInsertId();
        mkdir('assets/members/photos/' . $idUser->lastInsertId);
        mkdir('assets/members/thumbnails/' . $idUser->lastInsertId);
        //création de 2 index.html pour éviter que l'on puisse accéder aux dossiers de l'utilissateur via l'URL
        //fonction php fopen —> Ouvre un fichier ou une URL
        //'c' -> "parametre mode" Ouvre le fichier pour écriture seulement. Si le fichier n'existe pas, il sera crée, s'il existe, il n'est pas tronqué
        $handle1 = fopen('assets/members/photos/' . $idUser->lastInsertId . '/' . 'index.html', 'c');
        fclose($handle1);
        $handle2 = fopen('assets/members/thumbnails/' . $idUser->lastInsertId . '/' . 'index.html', 'c');
        fclose($handle2);
    }
}
