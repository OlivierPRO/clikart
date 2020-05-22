<?php
session_start();

include ('configuration.php');
include ('model/database.php');
include ('model/clik_Departments.php');
include ('model/clik_Users.php');
include ('model/clik_Roles.php');
include ('controller/controllerAdmin.php')
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet"> 
        <link rel="stylesheet" href="assets/css/styleForm.css" />
        <title>Formulaire d'inscription</title>
    </head>
    <body>
        <div class="background_opacity">
            <?php
            include ('view/header.php')
            ?>
            <table class="table table-stripped table-hover table-responsive-sm mt-5 text-center">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Pseudo</th>
                        <th>Mail</th>
                        <th>Role</th>
                        <th>modifier role</th>
                    </tr>
                </thead>
                <tbody>
                <form method="GET" action="#">
                    <?php foreach ($getProfilForAdmin AS $profilUser) { ?>
                        <tr>
                            <td><img src="<?= $profilUser->photoProfil ?>" alt="photo de profil" width="50"/></td>
                            <td><?= $profilUser->pseudo ?></td>
                            <td><?= $profilUser->mail ?></td>
                            <td><?= $profilUser->roles ?></td>
                            <td><a href="?erasePhoto=<?= $profilUser->id ?>" class="btn btn-outline-dark">effacer photoProfil</a></td>
                            <td>
                                <?php if ($roleAdmin) { ?>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal5">
                                        effacer compte
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression de compte</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Vous etes sur le point de <u><strong>supprimer</strong></u> un compte, souhaitez vous continuer ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <a href="?eraseCount=<?= $profilUser->id ?>" class="btn btn-primary">Effacer</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </form>
                </tbody>
            </table>
        </div>
        <script src="assets/JS/JSclikart.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="assets/JS/canvas.js" type="text/javascript"></script>
    </body>
</html>