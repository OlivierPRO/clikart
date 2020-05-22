<?php
session_start();

include ('configuration.php');
include ('model/database.php');
include ('model/clik_Users.php');
include ('model/clik_Infos.php');
include ('controller/controllerIdentification.php');
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet" /> 
        <link rel="stylesheet" href="assets/css/style.css" />
        <title>Connection</title>
    </head>
    <body>
        <?php
        include ('view/headerBeforeConnexion.php')
        ?>
        <?php if ($errorConnection) { ?>
            <div class="alert alert-danger" role="alert">
                mail ou mot de passe invalide
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-8 mt-5 text-center presentation font">                
                <p>Le site qui met en contact les modèles et les photographes</p>
            </div>
        </div>
        <div>
            <img class="clickart1" src="assets/img/clickart1.png" />
        </div>
        <div class="row">
            <div class="col-md-8  inscription text-center validInscription">
                <form method="POST">
                    <div class="mail">
                        <label for="mailConnect">votre mail : </label>
                        <input  type="mail" name="mailConnect" id="mailConnect" placeholder="votre mail" />
                        <p class="mt-1"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></p>
                    </div>
                    <div class="password">
                        <label for="password">votre mot de passe :</label>
                        <input type="password" name="password" id="password" placeholder="votre mot de passe" />
                        <p class="mt-1"><?= isset($formError['password']) ? $formError['password'] : '' ?></p>
                        <p class="mt-1"><?= isset($formOK['password']) ? $formOK['password'] : '' ?></p>
                    </div>
                    <input type="submit" value="se connecter" name="formConnexion" class="btn btn-dark"/>
                    <p  class="mt-1"><?= isset($formError['formConnexion']) ? $formError['formConnexion'] : '' ?></p>
                </form>
            </div>
        </div>
        <script src="assets/JS/canvas.js" type="text/javascript"></script>
    </body>
</html>
