<?php
include ('configuration.php');
include ('controller/controllerIndex.php');
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet" /> 
        <link rel="stylesheet" href="assets/css/style.css" />
        <title>CLICKART</title>
    </head>
    <body>
        <?php
        include ('view/headerBeforeConnexion.php')
        ?>
        <?php if ($forbifdden) { ?>
            <div class="alert alert-dark" role="alert">
                Il faut etre majeur pour accéder au site
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12 textPresentation ">
                <div class="col-md-8 mt-3 text-center presentation font">                
                    <p>Le site qui met en contact les modèles et les photographes</p>
                </div>
                <div class="col-md-8 mt-2 text-center presentation font">                
                    <p>Site interdit aux moins de 18 ans</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <img class="clickart1" src="assets/img/clickart1.png" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8 mt-3 text-center birthDate">
                    <form  method="POST">
                        <label for="birthDate">Quelle est votre date de naissance ? </label>
                        <input data-toggle='tooltip' data-placement='left' title="Le site pouvant contenir des photos sensibles, il est interdit aux mineurs" id="birthDate" name="birthDate" type="date" placeholder="type 01/01/2019"/>
                        <input type="submit" value="OK" name="ageButton" class="btn btn-dark"/>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="assets/JS/canvas.js" type="text/javascript"></script>
        <script src="assets/JS/JSclikart.js" type="text/javascript"></script>
    </body>
</html>