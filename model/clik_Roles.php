<?php

/* On crée une class clik_Departments qui hérite de la classe database via extends
 * 
 */

class clik_Roles extends database {

    // Création d'attributs qui correspondent à chacun des champs de la table clik_Roles
    // et on les initialise par rapport à leurs types.
    public $id = 0;
    public $roles = '';

    // on crée une methode magique __construct()
    public function __construct() {
        // On appelle le __construct() du parent via "parent::""
        parent::__construct();
    }

    /**
     * methode qui permet d'afficher les departements dans le select du formulaire de la page form.php
     * @return type
     */
    public function getRolesList() {
        $query = 'SELECT * FROM `clik_Roles`';
        $queryResult = $this->database->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
    }

}
