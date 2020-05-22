<?php

/* On crée une class clik_Users qui hérite de la classe database via extends
 * La classe clik_Users va nous permettre d'accéder à la table clik_Users
 */

class clik_Users extends database {

// Création d'attributs qui correspondent à chacun des champs de la table clik_Users
// et on les initialise par rapport à leurs types.
    public $id = 0;
    public $pseudo = '';
    public $password = '';
    public $mail = '';
    public $birthdate = '2000-01-01';
    public $retribution = '';
    public $description = '';
    public $photoProfil = '';
    public $id_clik_Departments = 0;
    public $id_clik_Roles = 0;
    public $mailConnect = '';
    public $roles = '';
    public $idRoles = '';
    public $userId = 0;
    public $extensionUpload = '';

// on crée une methode magique __construct()
    public function __construct() {
// On appelle le __construct() du parent via "parent::""
        parent::__construct();
    }

    /**
     * methode qui permet l'insertion en base d'un nouvel utilisateur via la page form.php
     * @return type
     */
    public function addUser() {
        $result = array();
// Insertion des données de l'utilisateur à l'aide d'une requête préparée avec un INSERT INTO et le nom des champs de la table
// Insertion des valeurs des variables via les marqueurs nominatifs, ex :lastname).
        $query = 'INSERT INTO `clik_Users` (`pseudo`, `password`, `mail`, `birthdate`, `retribution`, `description`, `photoProfil`, `id_clik_Roles`, `id_clik_Departments`)
                VALUES ( :pseudo, :password, :mail, :birthdate, :retribution, :description, :photoProfil, :idRoles, :idDepartments)';
        $addUser = $this->database->prepare($query);
// on attribue les valeurs via bindValue et on recupère les attributs de la classe via $this
        $addUser->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        $addUser->bindValue(':password', $this->password, PDO::PARAM_STR);
        $addUser->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $addUser->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $addUser->bindValue(':retribution', $this->retribution, PDO::PARAM_STR);
        $addUser->bindValue(':description', $this->description, PDO::PARAM_STR);
        $addUser->bindValue(':photoProfil', $this->photoProfil, PDO::PARAM_STR);
        $addUser->bindValue(':idRoles', $this->id_clik_Roles, PDO::PARAM_INT);
        $addUser->bindValue(':idDepartments', $this->id_clik_Departments, PDO::PARAM_INT);
        $executeResult = $addUser->execute();
        if ($executeResult) {
//lastInsertId() - >fonction qui Retourne l'id de la dernière ligne insérée 
            $this->lastInsertId = $this->database->lastInsertId('id');
        }
        return $executeResult;
    }

    /**
     * création d'une méthode qui va verfifier si l'email entré dans le formulaire d'inscription
     * ne corrspond pas deja à un compte existant  
     * @return type
     */
    public function checkFreeMail() {

        $query = 'SELECT COUNT(`mail`) AS `takenMail` FROM `clik_Users` WHERE `mail` = :mail ';
        $freeMail = $this->database->prepare($query);
        $freeMail->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        if ($freeMail->execute()) {
            $resultObject = $freeMail->fetch(PDO::FETCH_OBJ);
            $result = $resultObject->takenMail;
        }
        return $result;
    }

    /**
     * création d'une méthode qui va verfifier si le pseudo entré dans le formulaire d'inscription
     * ne correspond pas deja à celui d'un compte existant   
     * @return type
     */
    public function checkFreePseudo() {
        $result = FALSE;
        $query = 'SELECT COUNT(`pseudo`) AS `takenPseudo` FROM `clik_Users` WHERE `pseudo` = :pseudo';
        $freePseudo = $this->database->prepare($query);
        $freePseudo->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        if ($freePseudo->execute()) {
            $resultObject = $freePseudo->fetch(PDO::FETCH_OBJ);
            $result = $resultObject->takenPseudo;
        }
        return $result;
    }

    /**
     * methode pour verifier  que l'utilisateur existe 
     * @return type
     */
    public function getConnect() {
        $result = FALSE;
        $query = 'SELECT *  FROM `clik_Users` WHERE `mail` = :mail';
        $checkPwdAndMail = $this->database->prepare($query);
        $checkPwdAndMail->bindValue(':mail', $this->mailConnect, PDO::PARAM_STR);
        if ($checkPwdAndMail->execute()) {
            $resultObject = $checkPwdAndMail->fetch(PDO::FETCH_OBJ);
        }
        return $resultObject;
    }

    /**
     * AFFICHE LE PROFIL DU USER QUAND IL APPUIE SUR LE BOUTON PROFIL DE LA PAGE PRINCIPAL.php
     */
    public function getProfilById() {

        $query = 'SELECT `id`, `mail`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`,'
                . '`retribution`, `description`, `photoProfil`, `id_clik_Roles`, `id_clik_Departments`, `pseudo`'
                . 'FROM `clik_Users` WHERE `id` = :id';
        $findProfil = $this->database->prepare($query);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_STR);
        if ($findProfil->execute()) {
            $profil = $findProfil->fetch(PDO::FETCH_OBJ);
            if (is_object($profil)) {
                $this->mail = $profil->mail;
                $this->birthdate = $profil->birthdate;
                $this->retribution = $profil->retribution;
                $this->description = $profil->description;
                $this->photoProfil = $profil->photoProfil;
                $this->id_clik_Roles = $profil->id_clik_Roles;
                $this->id_clik_Departments = $profil->id_clik_Departments;
                $this->pseudo = $profil->pseudo;
            }
        }
    }

    /**
     * methode qui met à jour les infos du profil Photographe
     * @return type
     */
    public function updatePhotographProfil() {
        $query = 'UPDATE clik_Users SET mail = :mail, id_clik_Departments = :idDepartments, birthdate = :birthdate, retribution = :retribution, description = :description WHERE id = :id';
        $updatePatient = $this->database->prepare($query);
        $updatePatient->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $updatePatient->bindValue(':idDepartments', $this->id_clik_Departments, PDO::PARAM_INT);
        $updatePatient->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $updatePatient->bindValue(':retribution', $this->retribution, PDO::PARAM_STR);
        $updatePatient->bindValue(':description', $this->description, PDO::PARAM_STR);
        $updatePatient->bindValue(':id', $this->id, PDO::PARAM_STR);
        return $updatePatient->execute();
    }

    /**
     * methode qui permet de recuperer la liste des informations des USERS et afficher sur la page ADMIN
     * @return type
     */
    public function getAllProfilForAdminPage() {
        $result = array();
        $query = 'SELECT `clik_Users`.`photoProfil`, `clik_Roles`.`roles`, `clik_Users`.`pseudo`, `clik_Users`.`mail`, `clik_Users`.`id`
                FROM `clik_Users`
                LEFT JOIN `clik_Roles`
                ON `clik_Users`.`id_clik_Roles` = `clik_Roles`.`id`';
        $queryResult = $this->database->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
    }

    /**
     * methode qui permet au compte user de supprimer les photos des USERS en remplacant par un string vide
     * @return type
     */
    public function erasePhoto() {
        $query = 'update `clik_Users` set `photoProfil` = "assets/members/profilPhoto/default/clikart.jpg" WHERE `clik_Users`.`id` = :id';
        $deletePhoto = $this->database->prepare($query);
        $deletePhoto->bindvalue(':id', $this->id, PDO::PARAM_INT);
        return $deletePhoto->execute();
    }

    /**
     * methode qui permet d'afficher les etiquttes de la page principale
     * @return type
     */
    public function getProfilForLabel() {
        $query = 'SELECT `clik_Users`.`photoProfil`,`clik_Users`.`retribution`, `clik_Roles`.`roles`,`clik_Users`.`id_clik_Roles`,`clik_Roles`.`id`,`clik_Users`.`pseudo`, `clik_Users`.`id`, `clik_Departments`.`depNumbers`,`clik_Departments`.`depName`
                FROM `clik_Users`
                LEFT JOIN `clik_Roles`
                ON `clik_Users`.`id_clik_Roles` = `clik_Roles`.`id`
                LEFT JOIN `clik_Departments`
                ON `clik_Users`.`id_clik_Departments` = `clik_Departments`.`id`';
        $queryResult = $this->database->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
    }

    /**
     * methode qui recupere le profil pour l'afficher sur la page profil
     * @return type
     */
    public function getProfilForProfilPage() {
        $query = 'SELECT clik_Users.id, clik_Users.pseudo, clik_Users.mail, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, clik_Users.retribution, clik_Users.description, clik_Users.photoProfil, clik_Comments.comments, clik_Roles.roles, clik_Departments.depName
                    FROM clik_Users
                    LEFT JOIN clik_Comments
                    ON clik_Users.id = clik_Comments.id_clik_Users_have5
                    LEFT JOIN clik_Roles
                    ON clik_Users.id_clik_Roles = clik_Roles.id
                    LEFT JOIN clik_Departments
                    ON clik_Users.id_clik_Departments = clik_Departments.id
                    WHERE clik_Users.id = :id';
        $queryResult = $this->database->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $resultList = $queryResult->fetch(PDO::FETCH_OBJ);
            if (is_object($resultList)) {
                $this->pseudo = $resultList->pseudo;
                $this->mail = $resultList->mail;
                $this->birthdate = $resultList->birthdate;
                $this->retribution = $resultList->retribution;
                $this->description = $resultList->description;
                $this->photoProfil = $resultList->photoProfil;
                $this->comments = $resultList->comments;
                $this->roles = $resultList->roles;
                $this->depName = $resultList->depName;
                $this->id = $resultList->id;
            }
            return $resultList;
        }
    }

    /**
     * methode qui sert a supprimer un compte
     * @return type
     */
    public function deleteProfil() {
        $query = 'DELETE FROM `clik_Users` WHERE `id` = :id';
        $queryResult = $this->database->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $result = $queryResult->execute();
        return $result;
    }

    /**
     * methode qui met à jour les infos du profil model
     * @return type
     */
    public function updateRoleInAdminPage() {
        $query = 'UPDATE `clik_Users` SET `id_clik_Roles` = :id_clik_roles WHERE `id` = :id';
        $updateProlfil = $this->database->prepare($query);
        $updateProlfil->bindValue(':id_clik_roles', $this->id_clik_roles, PDO::PARAM_INT);
        $updateProlfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $updateProlfil->execute();
    }

    /**
     * methode qui permet de mttre à jour sa photo de profil dans la db
     * @return type
     */
    public function updatePhotoProfil() {
        $query = 'UPDATE `clik_Users` SET `photoProfil` = :photoProfil WHERE `id` = :id';
        $updatePhotoProfil = $this->database->prepare($query);
        $updatePhotoProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        $updatePhotoProfil->bindValue(':photoProfil', $this->photoProfil, PDO::PARAM_STR);
        return $updatePhotoProfil->execute();
    }

    /**
     * methode qui permet la recherche par pseudo ou par departement
     * @param type $search
     * @return type
     */
    public function searchProfilPseudo($search) {
        $query = 'SELECT `clik_Users`.`photoProfil`,`clik_Users`.`retribution`, `clik_Roles`.`roles`,`clik_Users`.`id_clik_Roles`,`clik_Roles`.`id`,`clik_Users`.`pseudo`, `clik_Users`.`id`, `clik_Departments`.`depNumbers`,`clik_Departments`.`depName`
                FROM `clik_Users`
                LEFT JOIN `clik_Roles`
                ON `clik_Users`.`id_clik_Roles` = `clik_Roles`.`id`
                LEFT JOIN `clik_Departments`
                ON `clik_Users`.`id_clik_Departments` = `clik_Departments`.`id`
                WHERE `pseudo`
                LIKE :search
                UNION ALL
                SELECT `clik_Users`.`photoProfil`,`clik_Users`.`retribution`, `clik_Roles`.`roles`,`clik_Users`.`id_clik_Roles`,`clik_Roles`.`id`,`clik_Users`.`pseudo`, `clik_Users`.`id`, `clik_Departments`.`depNumbers`,`clik_Departments`.`depName`
                FROM `clik_Users`
                LEFT JOIN `clik_Roles`
                ON `clik_Users`.`id_clik_Roles` = `clik_Roles`.`id`
                LEFT JOIN `clik_Departments`
                ON `clik_Users`.`id_clik_Departments` = `clik_Departments`.`id`
                WHERE `depName`
                LIKE :search';

        $result = $this->database->prepare($query);
        $result->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $result->execute();
        $resultList = $result->fetchAll(PDO::FETCH_OBJ);
        return $resultList;
    }

}
