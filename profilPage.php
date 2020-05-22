<?php
session_start();

include ('configuration.php');
include ('model/database.php');
include ('model/clik_Users.php');
include ('model/clik_Comments.php');
include ('model/clik_Infos.php');
include ('controller/controllerProfilPage.php');
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" />
        <link href="assets/css/stylePrincipal.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet" /> 
        <link href="assets/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/fancybox-master/dist/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
        <title>Principal</title>
    </head>
    <body>
        <?php
        include ('view/header.php')
        ?>
        <!--si le commentaire a bien ete prit en compte-->
        <?php if ($commentSuccess) { ?>
            <div class="alert alert-dark" role="alert">
                Votre commentaire a bien été prit en compte
            </div>
            <!--affichage du profil selectionné -->
        <?php } ?>
        <div class="profilCSS bgImg">
            <div class="backgroundOpacity ">
                <div class="container">
                    <div class=" row">
                        <div class="col-md-4 mt-5">
                            <img src="<?= $idUser->photoProfil ?>" class="img-fluid mx-auto d-block" alt="photo de profil" width="300"/>
                        </div>
                        <div class="col-md-4 mt-5 commentColor">
                            <p class="text-center"><strong>Je suis : </strong><?= $idUser->roles ?></p>
                            <p class="text-center"><strong>mon pseudo : </strong><?= $idUser->pseudo ?></p>
                            <p class="text-center"><strong>J'ai : </strong><?= $age . ' ans' ?></p>
                            <p class="text-center"><strong>J'habite : </strong><?= $idUser->depName ?></p>
                            <p class="text-center"><strong>Je demande une compensation : </strong><?= $idUser->retribution ?></p>
                            <!--S'affiche uniquement si le role est modele 5 ou modele moderateur 3-->
                            <?php if ($modelInfo->id_clik_Roles == 3 OR $modelInfo->id_clik_Roles == 5) { ?>
                                <p class="text-center"><strong>couleur des yeux : </strong><?= $modelInfo->eyesColor ?></p>
                                <p class="text-center"><strong>couleur des cheveux : </strong><?= $modelInfo->hairColor ?></p>
                                <p class="text-center"><strong>lunettes : </strong><?= $modelInfo->glasses ?></p>
                            <?php } ?>
                            <p class="text-center"><?= $idUser->description ?></p>
                        </div>
                        <div class="col-md-4 mt-5">
                            <!--modal pour laisser un commentaire -->
                            <span data-toggle="modal" title="laisser ici un message qui apparaitra sur le profil de la personne">
                                <button type="button" class="offset-md-5 center btn btn-dark mt-5 mx-auto d-block" data-toggle="modal" data-target="#exampleModal1" data-placement='top' title="laisser un commentaire sur mon profil" data-whatever="@getbootstrap">Laisser un commentaire</button>
                            </span>
                            <!--modal pour envoyer un mail-->
                            <span data-toggles="tooltip" data-placement='top' title="contactez moi par mail ici">
                                <button  type="button" class="btn btn-dark center-align mt-5 mx-auto d-block" data-toggle="modal" data-target="#exampleModale"  data-whatever="@mdo" >Me contacter</button>
                            </span>
                        </div>
                    </div>
                </div>
                <!--modal pour laisser un commentaire -->
                <div class = "modal fade" id = "exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class = "modal-dialog" role = "document">
                        <div class = "modal-content">
                            <div class = "modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Laisser un commentaire</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden = "true">&times;
                                    </span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    <div class="form-group">
                                        <label for="comment" class="col-form-label">Message:</label>
                                        <textarea name="comment" class="form-control" id="comment"></textarea>
                                    </div>
                                    <p role=alert class="mt-1"><?= isset($formError['add']) ? $formError['add'] : '' ?></p>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                                    <button type="submit" name="commentSend" class="btn btn-success">Envoyer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--modal pour envoyer un mail-->
                <div class="modal fade" id="exampleModale" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nouveau message</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">objet :</label>
                                        <input type="text" name="recipient-name" class="form-control" id="recipient-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Message :</label>
                                        <textarea class="form-control" name="message-text" id="message-text"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <button type="button" name="modalProfilPageSend" class="btn btn-primary">Envoyer message</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--boucle qui affiche les commentaires laisés par d'autres utilisateurs -->
        <div class="profilCSS">
            <?php foreach ($displayComments AS $com) { ?>
                <div class="container">
                    <div class="row">
                        <p class="commentColor"><strong><?= $com->pseudo ?></strong> : "<?= $com->comments ?>"</p>
                        <?php if ($roleAdmin OR $roleModeration OR $com->id_clik_Users == $_SESSION['id']) { ?>
                            <form action="#" method="POST">
                                <input type="hidden" name="idComments" value="<?= $com->idComments ?>"/>
                                <button type="submit" name="deleteButton"><img width="15" alt="delete" src="assets/img/deleteButton.png"/></button>
                            </form>
                        <?php } ?>
                       
                    </div>
                </div>
            <?php } ?>
        </div>
        <!--Utilisation de Fancybox -->
        <div class="profilCSS">
            <div class="container">
                <div class="row mt-5 mb-5 ml-3">
                    <?php
                    if ($dossier = opendir('assets/members/photos/' . $idUser->id)) {
                        while (false !== ($fichier = readdir($dossier))) {
                            if ($fichier != '.' && $fichier != '..' && $fichier != 'index.html') {
                                $nb_fichier++; // On incrémente le compteur de 1
                                echo '<a class="mr-2 ml-2 mt-2 mb-2" data-fancybox="gallery" href="assets/members/photos/' . $idUser->id . '/' . $fichier . '"><img src="assets/members/thumbnails/' . $idUser->id . '/' . $fichier . '"></a>';
                            } // On ferme le if (qui permet de ne pas afficher index.php, etc.)
                        } // On termine la boucle
                        closedir($dossier);
                    } else {
                        echo 'Le dossier n\' a pas pu être ouvert';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        include ('view/footer.php')
        ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="assets/JS/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="assets/fancybox-master/dist/jquery.fancybox.min.js" type="text/javascript"></script>
        <script src="assets/JS/JSclikart.js" type="text/javascript"></script>
        <script src="assets/JS/canvas.js" type="text/javascript"></script>
    </body>
</html>

