<?php
session_start();

include ('configuration.php');
include ('model/database.php');
include ('model/clik_Comments.php');
include ('model/clik_Departments.php');
include ('model/clik_Users.php');
include ('controller/controllerPrincipal.php');
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet" /> 
        <link href="assets/css/stylePrincipal.css" rel="stylesheet" type="text/css"/>
        <title>Principal</title>
    </head>
    <body>
        <?php
        include ('view/header.php')
        ?>
        <div class="row ml-5">
            <?php foreach ($getLabel as $label) { ?> 
                <div class="card ml-3 mr-3 mt-5" style="width: 14rem;">
                    <img class="card-img-top" src="<?= $label->photoProfil ?>" alt="Card image cap"   />
                    <div class="card-body">
                    </div>
                    <div class="card-footer">
                        <p class="card-title btn btn-md col-md-12 "><strong><?= $label->pseudo ?></strong></p>
                        <p class="card-text btn btn-md col-md-12"><?= $label->roles ?></p>
                        <p class="card-text btn btn-md col-md-12"><?= $label->depName ?></p>
                        <a href="profilPage.php?id=<?= $label->id ?>" class="btn btn-dark btn-block btnCard">Voir le profil</a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
        include ('view/footer.php')
        ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="assets/JS/canvas.js" type="text/javascript"></script>
    </body>
</html>