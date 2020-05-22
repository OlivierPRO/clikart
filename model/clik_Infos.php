<?php

/* On crée une class clik_Departments qui hérite de la classe database via extends
 * 
 */

class clik_Infos extends database {

// Création d'attributs qui correspondent à chacun des champs de la table clik_Departments
// et on les initialise par rapport à leurs types.
    public $id_clik_Users = 0;
    public $id_clik_Hair = 0;
    public $id_clik_Glasses = 0;
    public $id_clik_Roles = 0;
    public $id_clik_Eyes = 0;
    public $idEyes = 0;
    public $idHair = 0;
    public $idGlasses = 0;
    public $role = 0;
    public $eyesColor = '';
    public $hairColor = '';
    public $glasses = '';

// on crée une methode magique __construct()
    public function __construct() {
// On appelle le __construct() du parent via "parent::""
        parent::__construct();
    }

    /**
     * methode qui compte si un id existe deja
     * @return type
     */
    public function checkForModelInfos() {
        $query = 'SELECT COUNT(`id`) AS `takenInfos` FROM `clik_Infos` WHERE `id_clik_Users` = :id';
        $freeInfos = $this->database->prepare($query);
        $freeInfos->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($freeInfos->execute()) {
            $resultObject = $freeInfos->fetch(PDO::FETCH_OBJ);
            return $result = $resultObject->takenInfos;
        }
    }

    /**
     * methodequi insert les infos du model dans la table
     * @return type
     */
    public function insertModelInfos() {
        $result = array();
        $query = 'INSERT INTO `clik_Infos` (`id_clik_Hair`, `id_clik_Glasses`, `id_clik_Eyes`, `id_clik_Users`)'
                . 'VALUES (:idHair, :idGlasses, :idEyes, :id)';
        $addModelInfos = $this->database->prepare($query);
        $addModelInfos->bindValue(':idHair', $this->idHair, PDO::PARAM_INT);
        $addModelInfos->bindValue(':idGlasses', $this->idGlasses, PDO::PARAM_INT);
        $addModelInfos->bindValue(':idEyes', $this->idEyes, PDO::PARAM_INT);
        $addModelInfos->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $addModelInfos->execute();
    }

    /**
     * methode qui met à jour les infos du profil model
     * @return type
     */
    public function updateModelProfil() {
        $query = 'UPDATE `clik_Infos` SET `id_clik_Hair` = :idHair, `id_clik_Glasses` = :idGlasses, `id_Clik_Eyes` = :idEyes WHERE `id_clik_Users` = :id';
        $updateProlfil = $this->database->prepare($query);
        $updateProlfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        $updateProlfil->bindValue(':idHair', $this->idHair, PDO::PARAM_INT);
        $updateProlfil->bindValue(':idGlasses', $this->idGlasses, PDO::PARAM_INT);
        $updateProlfil->bindValue(':idEyes', $this->idEyes, PDO::PARAM_INT);
        return $updateProlfil->execute();
    }

    /**
     * methode qui recupere les informations du model pour l'afficher sur la page profil
     * @return type
     */
    public function getModelInfos() {
        $resultList = array();
        $query = 'SELECT clik_Eyes.eyesColor, clik_Glasses.glasses, clik_Hair.hairColor, clik_Users.id_clik_Roles, clik_Users.id
                   FROM clik_Users
                   LEFT JOIN clik_Infos
                   ON clik_Users.id = clik_Infos.id_clik_Users
                   LEFT JOIN clik_Eyes
                   ON clik_Eyes.id = clik_Infos.id_clik_Eyes
                   LEFT JOIN clik_Glasses
                   ON clik_Glasses.id = clik_Infos.id_clik_Glasses
                   LEFT JOIN clik_Hair
                   ON clik_Hair.id = clik_Infos.id_clik_Hair
                   WHERE clik_Users.id = :id';
        $queryResult = $this->database->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $resultList = $queryResult->fetch(PDO::FETCH_OBJ);
            if (is_object($resultList)) {
                $this->eyesColor = $resultList->eyesColor;
                $this->glasses = $resultList->glasses;
                $this->hairColor = $resultList->hairColor;
                $this->id_clik_Roles = $resultList->id_clik_Roles;
                $this->id = $resultList->id;
            }
            return $resultList;
        }
    }

}
