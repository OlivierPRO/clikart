<?php

/* On crée une class clik_Departments qui hérite de la classe database via extends
 * 
 */

class clik_Comments extends database {

    // Création d'attributs qui correspondent à chacun des champs de la table clik_Departments
    // et on les initialise par rapport à leurs types.
    public $comments = '';
    public $id_clik_Users = 0;
    public $id_clik_Users_have5 = 0;
    public $pseudo = '';
    public $id = 0;
    public $idComments = 0;

    // on crée une methode magique __construct()
    public function __construct() {
        // On appelle le __construct() du parent via "parent::""
        parent::__construct();
    }

    /**
     * methode qui sert a recuperer les commentaires pour les afficher sous le profil du user
     * @return type
     */
    public function getComments() {
        $query = 'SELECT *, `clik_Users`.`id` AS writed 
            FROM `clik_Users` 
            LEFT JOIN `clik_Comments` ON `clik_Comments`.`id_clik_Users` = `clik_Users`.`id` 
            WHERE `clik_Users`.`id` = `clik_Comments`.`id_clik_Users';
        $queryResult = $this->database->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $resultList = $queryResult->fetchAll(PDO::FETCH_OBJ);
            if (is_object($resultList)) {
                $this->id = $resultList->id;
                $this->comments = $resultList->comments;
                $this->id_clik_Users = $resultList->id_clik_Users;
                $this->pseudo = $resultList->pseudo;
            }
            return $resultList;
        }
    }

    /**
     * methode qui sert a inserer dans la table clik_Comments les commentaires laissé sur les profils
     * @return type
     */
    public function haveComment() {
        $query = 'INSERT INTO `clik_Comments` (`comments`, `id_clik_Users`, `id_clik_Users_have5`)'
                . 'VALUES (:comments, :id_clik_Users, :id_clik_Users_have5)';
        $addcomment = $this->database->prepare($query);
        $addcomment->bindValue(':comments', $this->comments, PDO::PARAM_STR);
        $addcomment->bindValue(':id_clik_Users', $this->id_clik_Users, PDO::PARAM_INT);
        $addcomment->bindValue(':id_clik_Users_have5', $this->id_clik_Users_have5, PDO::PARAM_INT);

        return $addcomment->execute();
    }

    /**
     * methode qui permet d'afficher le commentaire et le pseudo de celui qui commente sur la page profil de la personne concernée 
     * @return type
     */
    public function getPseudoComment() {
        $query = 'SELECT `clik_Users`.`pseudo`, `clik_Comments`.`comments`, `clik_Comments`.`id_clik_Users`, `clik_Comments`.`id_clik_Users_have5`,`clik_Comments`.`id` AS `idComments`
                    FROM `clik_Users`
                    LEFT JOIN `clik_Comments`
                    ON `clik_Users`.`id` = `clik_Comments`.`id_clik_Users`
                    WHERE `clik_Comments`.`id_clik_Users_have5` = :id';
        $queryResult = $this->database->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $resultList = $queryResult->fetchAll(PDO::FETCH_OBJ);
            if (is_object($resultList)) {
                $this->pseudo = $resultList->pseudo;
                $this->comments = $resultList->comments;
                $this->id_clik_Users = $resultList->id_clik_Users;
                $this->id_clik_Users_have5 = $resultList->id_clik_Users_have5;
                $this->idComments = $resultList->idComments;
                $this->id = $resultList->id;
            }
            return $resultList;
        }
    }

    /**
     * methode qui permet à l'admin d'effacer un commentaire laisser sur un page profil
     * @return type
     */
    public function deleteCommentsByAdmin() {
        $query = 'DELETE FROM `clik_Comments` WHERE `id` = :idComments';
        $queryResult = $this->database->prepare($query);
        $queryResult->bindValue(':idComments', $this->idComments, PDO::PARAM_INT);
        $result = $queryResult->execute();
        return $result;
    }

}
