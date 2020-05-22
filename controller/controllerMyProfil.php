<?php

//on initialise le tableau $formError
$formError = array();
$formError2 = array();

//initilise les varaibles a false
$isSuccess = FALSE;
$roleAdmin = FALSE;
$roleModeration = FALSE;
$roleModel = FALSE;
$fancybox = FALSE;
$addSuccess = FALSE;
$updateSucces = FALSE;
$errorInfosForm = FALSE;
$nb_fichier = 0;

//creation des regex pour controler les informations
$regexBirthdate = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';

// si la session concerne le model on rajoute des champs à remplir dans le profil 
if ($_SESSION['roles'] == '3' OR $_SESSION['roles'] == '5') {
    $roleModel = TRUE;
}

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

//on instencie un nouvel obket $upload
$upload = new clik_Users;
//j'y inset l'id grace à la session de connection
$upload->id = ($_SESSION['id']);


// si mon boouton est remplie eet que la superglobale $_files aussi
if (isset($_POST["updatePhotoProfil"]) && isset($_FILES['photoProfil']) && !empty($_FILES['photoProfil']['name'])) {
    //on initialise une variable $tailleMax à une taille de 2 mega
    $tailleMax = 2097152;
    //j'initliase un tableau dans le quel j'insert les seules extensions accpetées
    $extensionValid = array('jpg', 'jpeg', 'png');
    //condition qui verfie si la taille est inferieur a la taille initialisé dans la variable tailleMax
    if ($_FILES['photoProfil']['size'] <= $tailleMax) {
        //strtolower — Renvoie une chaîne en minuscules
        //substr — Retourne un segment de chaîne
        //strrchr — Trouve la dernière occurrence d'un caractère dans une chaîne
        $extensionUpload = strtolower(substr(strrchr($_FILES['photoProfil']['name'], '.'), 1));
        //in_array — Indique si une valeur appartient à un tableau
        // verifie ce qui est entré et le compar a ce qui est attendu
        if (in_array($extensionUpload, $extensionValid)) {
            $upload->photoLoad = $extensionUpload;
            //j'initilise le chemain dans la variable $way
            $way = 'assets/members/profilPhoto/' . $_SESSION['id'] . '.' . $extensionUpload;
            //move_uploaded_file — Déplace un fichier téléchargé
            //on nome le fichier à deplacer puis le chemin oui il doit s'enregistrer
            $result = move_uploaded_file($_FILES['photoProfil']['tmp_name'], $way);
            if ($result) {
                $upload->photo = 'img' . $_SESSION['id'] . '.' . $upload->photoLoad;
                $upload->photoProfil = $way;
                $upload->updatePhotoProfil();
                $updateSucces = TRUE;
            } else {
                $formError['photoProfil'] = 'erreur lors du deplacements de votre photo';
            }
        } else {
            $formError['photoProfil'] = 'votre format de photo ne correspond pas il doit être au format jpg, jpeg, gif ou png';
        }
    } else {
        $formError['photoProfil'] = 'votre photo ne doit pas depasser 2mo';
    }
}

// On instancie un nouveau $glasses objet comme classe clik_glasses
$haveGlasses = new clik_Glasses();
$getGlasses = $haveGlasses->getGlassesList();

// On instancie un nouveau $hair objet comme classe clik_Hair
$haveHair = new clik_Hair();
$getHair = $haveHair->getColorHairList();

// On instancie un nouveau $hair objet comme classe clik_Hair
$haveyes = new clik_Eyes();
$getEyes = $haveyes->getColorEyesList();

// On instancie un nouveau $departments objet comme classe clik_departments
$departments = new clik_Departments();
$getDepartment = $departments->getDepartmentList();

// On instancie un nouveau idUsers objet comme classe clik_Users
//permet d'afficher les infos du profil user
$idUser = new clik_Users();
//on recupere l'id par la session et on s'en sert en le transformant en objet
$idUser->id = $_SESSION['id'];
$profilFind = $idUser->getProfilById();

// On instancie un nouveau $comments objet comme classe clik_clik_comments
// pemet d'afficher les commentaires dans le profil
$comments = new clik_Comments();
//on recupere l'id par la session et on s'en sert en le transformant en objet
$comments->id = $_SESSION['id'];
$commentFind = $comments->getComments();

//permet à l'utilisateur de suprimer sa photo de profil
if (!empty($_POST['deletePhotoProfil'])) {
    $idUser->id = htmlspecialchars($_SESSION['id']);
    $idUser->erasePhoto();
    header('location: myProfil.php');
    exit();
}

// je verifie mes posts et les infos des inputs avant de les pusher vers la bdd :
//On test la valeur mail dans l'array $_POST, si elle existe via premier if
if (isset($_POST['mail'])) {
    if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
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

//verificaion que le mail mit a jour ne soit pas deja prit dans la DB, on le compare avec celui de la session
// s'il est different c'est qu'il vient d'etre modifier par l'iutlisateur
if (!empty($_POST['mail']) AND $_POST['mail'] != $_SESSION['mail']) {
    // on verifier en appelant la methode chekFreeMail()
    $checkFreeMail = $idUser->checkFreeMail();
    //la methode compte le nombre de mail corrspondant, s'il est egal a 1, un compte existe deja
    if ($checkFreeMail >= 1) {
        //on envoie une erreur dans nle tableau 
        $formError['mail'] = 'un compte existe deja avec ce mail';
    }
}

//On test la valeur idDepartment dans l'array $_POST, si elle existe via premier if
if (isset($_POST['idDepartments'])) {
    // Variable idDepartments qui vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $idUser->id_clik_Departments = htmlspecialchars($_POST['idDepartments']);
    // Si le post est vide
    if (empty($idUser->id_clik_Departments)) {
        // J'affiche le message d'erreur
        $formError['idDepartments'] = 'Champs obligatoire';
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
    // Variable description qui vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $idUser->description = htmlspecialchars($_POST['description']);
    // Si le post est vide
    if (empty($idUser->description)) {
        // J'affiche le message d'erreur
        $formError['description'] = 'Champs obligatoire';
    }
}

//on vérifie que nous avons crée une entrée submit dans l'array $_POST, si présent on éxécute la méthode updatePhotographProfil()
if (count($formError) == 0 && isset($_POST['updateForm'])) {
    if (!$idUser->updatePhotographProfil()) {
        $formError['add'] = 'l\'envoie du formulaire à échoué';
    } else {
        $updateSucces = TRUE;
    }
}

$haveInfos = new clik_Infos;
$haveInfos->id = $_SESSION['id'];
//On test la valeur idEyes dans l'array $_POST, si elle existe via premier if
if (isset($_POST['idEyes'])) {
    // Variable idEyes qui vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $haveInfos->idEyes = htmlspecialchars($_POST['idEyes']);
    // Si le post est vide
    if (empty($haveInfos->idEyes)) {
        // J'affiche le message d'erreur
        $formError2['idEyes'] = 'Champs obligatoire';
    }
}

//On test la valeur idHair dans l'array $_POST, si elle existe via premier if
if (isset($_POST['idHair'])) {
    // Variable idHair qui vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $haveInfos->idHair = htmlspecialchars($_POST['idHair']);
    // Si le post est vide
    if (empty($haveInfos->idHair)) {
        // J'affiche le message d'erreur
        $formError2['idHair'] = 'Champs obligatoire';
    }
}

//On test la valeur idGlasses dans l'array $_POST, si elle existe via premier if
if (isset($_POST['idGlasses'])) {
    // Variable idGlasses qui vérifie que les caractères speciaux soit converties en entité html via htmlspecialchars = protection
    $haveInfos->idGlasses = htmlspecialchars($_POST['idGlasses']);
    // Si le post est vide
    if (empty($haveInfos->idGlasses)) {
        // J'affiche le message d'erreur
        $formError2['idGlasses'] = 'Champs obligatoire';
    }
}

//condition qui verfie si le nombre d'erreur du formaulaire 2 est egal a 0
//si le bouton est isset alors on compte si l'id clé etrangére id_clik_Users existe
//si elle existe on appel la methose update, si elle n'existe pas on appel la methode insert
if (count($formError2) == 0 && isset($_POST['updateModelForm'])) {
    $checkFreeInfos = $haveInfos->checkForModelInfos();
    if ($checkFreeInfos == 1) {
        $updateInfos = $haveInfos->updateModelProfil();
        $updateSucces = TRUE;
    } else if ($checkFreeInfos != 1) {
        $insertInfos = $haveInfos->insertModelInfos();
        $updateSucces = TRUE;
    }
}

if (count($formError2) >= 1 && isset($_POST['updateModelForm'])) {
    $formError2['add'] = 'Merci de remplir tous les champs';
    $errorInfosForm = TRUE;
}

//supprimer son compte
if (!empty($_GET['eraseCount'])) {
    $idUser->id = htmlspecialchars($_GET['eraseCount']);
    //on designe le dossier à suivre
    $folder = 'assets/members/photos/' . $_SESSION['id'];
    //on ouvre le fichier
    $open = opendir($folder);
    //on créé une boucle qui va effacer le fichiers
    while (false !== ($file = readdir($open))) {
        $way = $folder . '/' . $file;
        if ($file != '..' AND $file != '.' AND ! is_dir($file)) {
            //unlink — Efface un fichier
            unlink($way);
        }
    }
    closedir($open);
    //on designe le dossier à suivre
    $folder = 'assets/members/thumbnails/' . $_SESSION['id'];
    //on ouvre le fichier
    $open = opendir($folder);
    //on créé une boucle qui va effacer le fichiers
    while (false !== ($file = readdir($open))) {
        $way = $folder . '/' . $file;
        if ($file != '..' AND $file != '.' AND ! is_dir($file)) {
            //unlink — Efface un fichier
            unlink($way);
        }
    }
    closedir($open);
    //rmdir — Efface un dossier si celui ci est vide,
    //d'ou l'importance de faire une boucle avec pour en effacer le contenu
    rmdir('assets/members/photos/' . $_SESSION['id']);
    rmdir('assets/members/thumbnails/' . $_SESSION['id']);
    //une fois que tous les fichiers sont effaceés on peu appeler la methode qui effecera l'id de l'utilsiateurs 
    // de la base en cascade
    $idUser->deleteProfil();
    //on redirige sur la premiere page
    header('location: index.php');
    exit();
}

//conditions qui va permettre l'enregistrement des photos de book dans un fichier
//enregistre la photo et créé une miniature pour afficher plus rapidement les photos lors de la visualisation
//permet d'éviter des ralentissements duent à une faible bande passante, et de soliciter le serveur inutilement
if (isset($_POST["updatePhotoBook"]) && isset($_FILES['photoBook']) && !empty($_FILES['photoBook']['name'])) {
    $tailleMax2 = 4000000;
    if ($_FILES['photoBook']['size'] <= $tailleMax2) {
        $current_img = $_FILES['photoBook']['name'];
        //substr — Retourne un segment de chaîne
        //strrchr — Trouve la dernière occurrence d'un caractère dans une chaîne
        $extension = substr(strrchr($current_img, '.'), 1);
        //uniqid — Génère un identifiant unique
        $new_image = uniqid();
        //  uniqid()— Génère un identifiant unique
        $originalImage = "assets/members/photos/" . $_SESSION['id'] . "/" . $new_image . $extension;
        $destination = "assets/members/thumbnails/" . $_SESSION['id'] . "/" . $new_image . $extension;
        //move_uploaded_file — Déplace un fichier téléchargé
        $action = move_uploaded_file($_FILES['photoBook']['tmp_name'], $originalImage);
        $max_upload_width = 100;
        $max_upload_height = 100;
        $updateSucces = TRUE;
        if ($_FILES["photoBook"]["type"] == "image/jpeg" || $_FILES["photoBook"]["type"] == "image/pjpeg") {
            //imagecreatefromwjpeg — Crée une nouvelle image depuis un fichier ou une URL
            $image_source = imagecreatefromjpeg($originalImage);
        }
        if ($_FILES["photoBook"]["type"] == "image/bmp") {
            //imagecreatefromwbmp — Crée une nouvelle image depuis un fichier ou une URL
            $image_source = imagecreatefromwbmp($originalImage);
        }
        if ($_FILES["photoBook"]["type"] == "image/png") {
            //imagecreatefromwpng — Crée une nouvelle image depuis un fichier ou une URL
            $image_source = imagecreatefrompng($originalImage);
        }
        //imagejpeg — Affichage de l'image vers le navigateur ou dans un fichier
        imagejpeg($image_source, $destination, 100);
        //chmod — Change le mode du fichier
        chmod($destination, 0644);
        //getimagesize — Retourne la taille d'une image
        list($image_width, $image_height) = getimagesize($destination);
        //getimagesize() — Retourne la taille d'une image
        if ($image_width > $max_upload_width || $image_height > $max_upload_height) {
            $proportions = 1.33;
            if ($image_width > $image_height) {
                $new_width = $max_upload_width;
                $new_height = round($max_upload_width / $proportions);
            } else {
                $new_height = $max_upload_height;
                //round — Arrondit un nombre à virgule flottante
                $new_width = round($max_upload_height * $proportions);
            }
            $new_image = imagecreatetruecolor($new_width, $new_height);
            $image_source = imagecreatefromjpeg($destination);
            //imagecopyresampled — Copie, redimensionne, rééchantillonne une image
            imagecopyresampled($new_image, $image_source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
            //imagejpeg — Affichage de l'image vers le navigateur ou dans un fichier
            imagejpeg($new_image, $destination, 100); // save
            //imagedestroy — Détruit une image
            imagedestroy($new_image);
        } else {
            $formError['photoBook'] = '- Votre photo doit être au format jpg, jpeg, gif ou png.';
        }
    } else {
        $formError['photoBook'] = 'votre photo ne doit pas depasser 4mo';
    }
}
