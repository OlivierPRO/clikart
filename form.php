<?php
include ('configuration.php');
include ('model/database.php');
include ('model/clik_Departments.php');
include ('model/clik_Users.php');
include ('controller/controllerForm.php')
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet" /> 
        <link rel="stylesheet" href="assets/css/styleForm.css" />
        <title>Formulaire d'inscription</title>
    </head>
    <body>
        <div class="background_opacity">
            <?php
            include ('view/headerBeforeConnexion.php')
            ?>
            <?php if ($addSuccess) { ?>
                <div class="alert alert-success" role="alert">
                    Vous avez bien été inscrit, vous pouvez maintenant vous connecter
                </div>
            <?php } ?>
            <?php if ($error) { ?>
                <div class="alert alert-danger" role="alert">
                    l'envoie du formaulaire à echoué
                </div>
            <?php } ?>
            <p class="mt-1 redAlert"><?= isset($formError['idRoles']) ? $formError['idRoles'] : '' ?></p>
            <form class="mt-2" action="#" method="POST">
                <h1 class="text-center font">Enregistrez-vous</h1>
                <div  class="form-group text-center mt-5">
                    <p class="font">Vous êtes ?</p>
                    <label  for="photographers" >Photographe</label>
                    <input data-toggle="tooltip" data-placement='bottom' title="ce choix ne sera plus modifiable par la suite"  type="radio" name="idRoles" value="4" id="photographers" <?= isset($_POST['idRoles']) && $_POST['idRoles'] == 4 ? 'checked' : '' ?> />
                    <input data-toggle='tooltip' data-placement='bottom' title="ce choix ne sera plus modifiable par la suite"  type="radio" name="idRoles" value="5" id="models" <?= isset($_POST['idRoles']) && $_POST['idRoles'] == 5 ? 'checked' : '' ?> />
                    <label  for="model" >modèle</label>
                </div>
                <div class = "form-row">
                    <div class = "form-group col-md-6 text-center">
                        <label for="mail">Adresse mail</label><br />
                        <input data-toggle='tooltip' data-placement='right' title="votre adresse mail doit etre de type : monadressemail@gmail.com" type="mail" name="mail" id="mail" class="form" placeholder="Votre adresse mail" value="<?= isset($_POST['mail']) ? $_POST['mail'] : '' ?>" />
                        <p class="mt-1 redAlert"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></p>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <label for="mail2">Verifiez votre mail</label><br />
                        <input data-toggle='tooltip' data-placement='left' title="votre adresse mail doit correspondre à la premiere" type="mail" name="mail2" id="mail2" class="form" placeholder="Verfiez votre adresse mail" />
                        <p class="mt-1 redAlert"><?= isset($formError['mail2']) ? $formError['mail2'] : '' ?></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 text-center">
                        <label for="password">Mot de passe</label><br />
                        <input data-toggle='tooltip' data-placement='left' title="Pour votre securité, utilisez des caractéres speciaux" type="password" name="password" id="password" class="password form" placeholder="Votre mot de passe"  />
                        <p class="mt-1 redAlert"><?= isset($formError['password']) ? $formError['password'] : '' ?></p>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <label for="password2">Verifiez votre mot de passe</label><br />
                        <input data-toggle='tooltip' data-placement='left' title="votre mot de passe doit correspondre au premier" type="password" name="password2" id="password2" class="password form" placeholder="Verfiez votre mot de passe"  />
                        <p class="mt-1 redAlert"><?= isset($formError['password2']) ? $formError['password2'] : '' ?></p>
                    </div>
                </div>
                <div class="form-row"> 
                    <div class="form-group col-md-6 text-center">
                        <label for="pseudo">Pseudo</label><br />
                        <input data-toggle='tooltip' data-placement='right' title="votre pseudo ne sera pas modifiable, choisissez le bien" type="text" name="pseudo" id="pseudo" class="pseudo form" placeholder="Votre pseudo" value="<?= isset($_POST['pseudo']) ? $_POST['pseudo'] : '' ?>" />
                        <p class="mt-1 redAlert"><?= isset($formError['pseudo']) ? $formError['pseudo'] : '' ?></p>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <label for="idDepartments">Selectionnez votre département</label><br/>
                        <select id="idDepartments" name="idDepartments" class="department form">
                            <option   value="" selected hidden>Departement</option>
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
                        <input data-toggle='tooltip' data-placement='right' title="nous rappelons que le site est interdit aux mineurs" type="date" name="birthdate" id="birthdate" class="birthdate form" placeholder="Votre date de naissance" value="<?= isset($_POST['birthdate']) ? $_POST['birthdate'] : '' ?>" />
                        <p class="mt-1 redAlert"><?= isset($formError['birthdate']) ? $formError['birthdate'] : '' ?></p>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <label for="retribution">Demande de rétribution </label><br />
                        <select data-toggle='tooltip' data-placement='left' title="Souhaitez vous etre payé pour votre production" name="retribution" id="retribution" class="retribution form"  >
                            <option value="" selected hidden>choix</option>
                            <option value="oui">Oui</option>
                            <option value="non">Non</option>
                        </select>
                        <p class="mt-1 redAlert"><?= isset($formError['retribution']) ? $formError['retribution'] : '' ?></p>
                    </div>           
                </div>
                <div class="form-group text-center ">
                    <label for="description">Décrivez vous en quelques mots, et ce que vous recherchez</label><br />
                    <textarea data-toggle='tooltip' data-placement='top' title="Décrivez ici votre personnalité, votre travail, ce que vous cherchez, vos envies et attentes" type='text' name="description" id="description" rows="4" cols="50" ><?= isset($_POST['description']) ? $_POST['description'] : '' ?></textarea>
                    <p class="mt-1 redAlert"><?= isset($formError['description']) ? $formError['description'] : '' ?></p>
                </div>
                <div class=" text-center mb-3">
                    <input class="btn btn-dark" type="submit" name="sendForm" value="VALIDER" />
                    <p class="mt-1 redAlert error pb-5"><?= isset($formError['add']) ? $formError['add'] : '' ?></p>
                </div>
            </form>
        </div>
        <?php
        include ('view/footerForm.php');
        ?> 
        <script src="assets/JS/script.js" type="text/javascript"></script>
        <script src="assets/JS/JSclikart.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script  src="assets/JS/canvas.js" type="text/javascript"></script>
    </body>
</html>







