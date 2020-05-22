<?php
session_start();

include ('configuration.php');
include ('model/database.php');
include ('model/clik_Departments.php');
include ('model/clik_Users.php');
include ('model/clik_Roles.php');
include ('controller/controllerAdminRoles.php')
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet" /> 
        <link rel="stylesheet" href="assets/css/styleForm.css" />
        <title>Administration des rôles</title>
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
                        <th>Role</th>
                        <th>modifier role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getProfilForAdmin AS $profilUser) { ?>
                    <form method="POST" action="#">
                        <tr>
                            <td><img src="<?= $profilUser->photoProfil ?>" alt="photo de profil" width="50"/></td>
                            <td><?= $profilUser->pseudo ?></td>
                            <td><?= $profilUser->roles ?></td>
                            <td>
                                <label for = "id_clik_Roles"></label>
                                <select id = "id_clik_Roles" name = "id_clik_Roles" class = "Roles form">
                                    <option value = '' disabled selected>Selectionnez le role</option>
                                    <?php
                                    foreach ($getRoles AS $role) {
                                        ?>
                                        <option  value="<?= $role->id ?>"><?= $role->roles ?></option>
                                    <?php } ?>
                                </select>
                                <form method="POST" action="#">
                                    <input type = "hidden" name = "userId" value = "<?= $profilUser->id ?>" />
                                    <input class = "btn btn-outline-dark" type = "submit" name = "sendForm" value = "OK" />
                                    <p role=alert class="mt-1 error"><?= isset($formError['add']) ? $formError['add'] : '' ?></p>
                            </td>
                        </tr>
                        </tbody>
                    </form>
                <?php } ?>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="assets/JS/canvas.js" type="text/javascript"></script>
    </body>
</html>










