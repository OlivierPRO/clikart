<?php
session_start();

include ('configuration.php');
include ('model/database.php');
include ('model/clik_Users.php');
include ('model/clik_Departments.php');
include ('model/clik_Comments.php');
include ('model/clik_Glasses.php');
include ('model/clik_Hair.php');
include ('model/clik_Eyes.php');
include ('model/clik_Infos.php');
include ('controller/controllerMyProfil.php');
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/styleForm.css" />
        <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet" /> 
        <link href="assets/fancybox-master/dist/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
        <title>Mon profil</title>
    </head>
    <body>
        <div class="background_opacity">
            <?php
            include ('view/header.php')
            ?> 
            <!--si l'enregistrement a bien ete prit en compte-->
            <?php if ($updateSucces) { ?>
                <div class="alert alert-success" role="alert">
                    Votre modification a bien été prise en compte
                </div>
            <?php } ?>
            <!--si l'enregistrement a bien ete prit en compte-->
            <?php if ($errorInfosForm) { ?>
                <div class="alert alert-danger" role="alert">
                    Merci de remplir tous les chammps
                </div>
            <?php } ?>
            <!--affichage du profil selectionné -->
            <div class="profilCSS">
                <h1 class="text-center font"><u><strong>Selectionnez votre photo de profil</strong></u></h1>
                <form class="mt-2"  method="POST" action="#" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 mt-1 ">
                            <div class="form-group text-center mt-2">
                                <label for='photoProfil'>Séléctionnez votre photo de profil et validez (jpeg, jpg, png, 2Mo max)</label><br />
                                <input class="text-center btn btn-sm" type="file" name="photoProfil"/>
                                <p><?= isset($formError['photoProfil']) ? $formError['photoProfil'] : '' ?></p>
                                <div class=" text-center mb-3">
                                    <input class="btn btn-success" type="submit" name="updatePhotoProfil" value="VALIDER" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form class="mt-2"  method="POST" action="#" enctype="multipart/from-data">
                    <div class="row">
                        <div class="col-md-12 mt-1 ">
                            <div class="form-group text-center mt-2">
                                <img src="<?= $idUser->photoProfil ?>" width="150" alt="photo de profil" class="rounded img-thumbnail" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <input class="btn btn-danger text-center" type="submit" name="deletePhotoProfil" value="supprimer photo" />
                    </div>   
                </form>
            </div>
            <div class="profilCSS">
                <form class="mt-2"  method="POST" action="#">
                    <h1 class="text-center font mt-3 mb-3"><u><strong>Vos infos</strong></u></h1>
                    <div class="form-row">
                        <div class="form-group col-md-6 text-center">
                            <label for="mail">Adresse mail</label><br />
                            <input type="mail" name="mail" id="mail" class="mail form" placeholder="Votre adresse mail" value="<?= $idUser->mail ?>" />
                            <p class="redAlert mt-1"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></p>
                        </div>
                        <div class="form-group col-md-6 text-center">
                            <label for="idDepartments">Selectionnez votre département</label><br/>
                            <select id="idDepartments" name="idDepartments" class="department form">
                                <option value=""  selected hidden>Departement</option>
                                <?php foreach ($getDepartment AS $department) { ?>
                                    <option value="<?= $department->id ?>"><?= $department->depNumbers . '-' . $department->depName ?></option>
                                <?php } ?>
                            </select>
                            <p class="mt-1 redAlert"><?= isset($formError['idDepartments']) ? $formError['idDepartments'] : '' ?></p>
                        </div>
                    </div>
                    <div class="form-row">               
                        <div class="form-group col-md-6 text-center">
                            <label for="birthdate">Date de naissance</label><br />
                            <input type="date" name="birthdate" id="birthdate" class="birthdate form" placeholder="Votre date de naissance" value="<?= $idUser->birthdate ?>" />
                            <p class="redAlert mt-1"><?= isset($formError['birthdate']) ? $formError['birthdate'] : '' ?></p>
                        </div>
                        <div class="form-group col-md-6 text-center">
                            <label for="retribution">Demande de rétribution</label><br />
                            <select name="retribution" id="residencePlace" class="retribution form">
                                <option value="" selected hidden>Choix</option>
                                <option value="oui">Je demande une rétribution</option>
                                <option value="non">Je ne demande pas de rétribution</option>
                            </select>
                            <p class="mt-1 redAlert"><?= isset($formError['retribution']) ? $formError['retribution'] : '' ?></p>
                        </div>           
                    </div>
                    <div class="form-group text-center ">
                        <label for="description">Décrivez vous en quelques mots, et ce que vous recherchez</label><br />
                        <textarea type='text' name="description" id="description" rows="4" cols="30" ><?= $idUser->description ?></textarea>
                        <p class="mt-1 redAlert"><?= isset($formError['description']) ? $formError['description'] : '' ?></p>
                    </div>
                    <div class=" text-center mb-3">
                        <input class="btn btn-dark mb-3" type="submit" name="updateForm" value="Enregistrer la mofification" />
                        <p  class="mt-1"><?= isset($formError['add']) ? $formError['add'] : '' ?></p>
                    </div>
                </form>
            </div>
            <!-- FORMULAIRE REMPLIE UNIQUEMENT PAR LE ROLE MODEL -->
            <?php if ($roleModel) { ?>
                <div class="profilCSS">
                    <form class="mt-2"  method="POST" action="#">
                        <h1 class="text-center font"><u><strong>description physique</strong></u></h1>
                        <div class="form-row"> 
                            <div class="form-group col-md-6 text-center">
                                <label for="idGlasses">lunettes</label><br/>
                                <select id="idGlasses" name="idGlasses" class="glasses form">
                                    <option value='' hidden selected>lunettes</option>
                                    <?php foreach ($getGlasses AS $glasses) { ?>
                                        <option value="<?= $glasses->id ?>"><?= $glasses->glasses ?></option>
                                    <?php } ?>
                                </select>
                                <p class="mt-1 redAlert"><?= isset($formError2['idGlasses']) ? $formError2['idGlasses'] : '' ?></p>
                            </div>
                            <div class="form-group col-md-6 text-center">
                                <label for="idHair">Cheveux</label><br/>
                                <select id="idHair" name="idHair" class="hair form">
                                    <option value='' hidden selected>Cheveux</option>
                                    <?php foreach ($getHair AS $hair) { ?>
                                        <option value="<?= $hair->id ?>"><?= $hair->hairColor ?></option>
                                    <?php } ?>
                                </select>
                                <p class="mt-1 redAlert"><?= isset($formError2['idHair']) ? $formError2['idHair'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row"> 
                            <div class="form-group col-md-6 text-center">
                                <label for="idEyes">yeux</label><br/>
                                <select id="idEyes" name="idEyes" class="eyes form">
                                    <option value='' hidden selected>yeux</option>
                                    <?php foreach ($getEyes AS $eyes) { ?>
                                        <option value="<?= $eyes->id ?>"><?= $eyes->eyesColor ?></option>
                                    <?php } ?>
                                </select>
                                <p class="mt-1 redAlert"><?= isset($formError2['idEyes']) ? $formError2['idEyes'] : '' ?></p>
                            </div>
                        </div>
                        <div class=" text-center mb-3">
                            <input class="btn btn-dark" type="submit" name="updateModelForm" value="Enregistrer la mofification" />
                            <p class="mt-1 redAlert"><?= isset($formError2['add']) ? $formError2['add'] : '' ?></p>
                        </div>
                    </form>
                </div>
            <?php } ?>     
            <div class="profilCSS">
                <h1 class="text-center font"><u><strong>Votre book photo</strong></u></h1>
                <div class = "row">
                    <div class = "ml-5 mr-5">
                        <?php
                        if ($dossier = opendir('assets/members/photos/' . $idUser->id)) {
                            while (false !== ($fichier = readdir($dossier))) {
                                if ($fichier != '.' && $fichier != '..' && $fichier != 'index.html') {
                                    $nb_fichier++; // On incrémente le compteur de 1
                                    echo '<a class="mr-3 ml-3" data-fancybox="gallery" href="assets/members/photos/' . $idUser->id . '/' . $fichier . '"><img class="mt-2" src="assets/members/thumbnails/' . $idUser->id . '/' . $fichier . '"></a>';
                                }
                            }
                            closedir($dossier);
                        } else {
                            echo 'Le dossier n\' a pas pu être ouvert';
                        }
                        ?>
                    </div>
                </div>
                <form class="mt-2"  method="POST" action="#" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 mt-1 ">
                            <div class="form-group text-center mt-2">
                                <label for='photoBook'>Selectionez vos photos de book (jpeg, png, 4Mo max)</label><br />
                                <input class="text-center btn btn-sm" type="file" name="photoBook" multiple/>
                                <p><?= isset($formError['photoProfil']) ? $formError['photoProfil'] : '' ?></p>
                                <div class=" text-center mb-3">
                                    <input class="btn btn-dark" type="submit" name="updatePhotoBook" value="VALIDER" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="profilCSS">
                <!--Modal qui sert a confirmer la suppression de son compte -->
                <!-- Button trigger modal -->
                <button type="button" class="offset-md-5 btn btn-dark mt-5 mb-5 mx-auto d-block" data-toggle="modal" data-target="#exampleModal">
                    SUPPRIMER MON COMPTE
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">SUPPRESSION DE COMPTE</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center"><u>Attention vous etes sur le point de supprimer votre compte</u></p>
                                <p class="text-center">Toute suppression sera <u><strong>irreversible</strong></u></p>
                                <p class="text-center">Si vous appuyez sur supprimer vous serez redirigé(e) sur la page d'accueil et vous ne pourrez plus vous connecter</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Désolé, je me suis trompé(e)</button>
                                <a href="?eraseCount=<?= $_SESSION['id'] ?>" class="btn btn-danger">Je supprime quand meme</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include ('view/footer.php');
        ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="assets/fancybox-master/dist/jquery.fancybox.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="assets/JS/JSclikart.js" type="text/javascript"></script>
        <script src="assets/JS/canvas.js" type="text/javascript"></script>
    </body>
</html>


