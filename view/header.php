<header>
    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
        <a href="principal.php"><input type="image" src="assets/img/clickart1.png" alt="logoClickart" class="logoClickart3"/></a>
        <canvas id="olivier" width="400" height="400"></canvas>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link font" href="principal.php">Home |<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link font" href="myProfil.php">Mon profil |<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link font" href="deconnexion.php">Me déconnecter |</a>
                </li>
                <?php if ($roleModeration) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle font" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Administration
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item font" href="admin.php">admin générale</a>
                        </div>
                    </li>
                <?php } ?>
                <?php if ($roleAdmin) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle font" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Administration
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item font" href="admin.php">admin générale</a>
                            <a class="dropdown-item font" href="adminRoles.php">Modifier les roles</a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <form method="POST" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="pseudo ou department" aria-label="Search" name="search">
                <input class="btn btn-outline-secondary my-2 my-sm-0" name='searchButton' type="submit" value="chercher" />
            </form>
        </div>
    </nav>
</header>