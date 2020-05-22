<?php

/* On crée une class clik_Departments qui hérite de la classe database via extends
 * 
 */

class clik_Departments extends database {

    // Création d'attributs qui correspondent à chacun des champs de la table clik_Departments
    // et on les initialise par rapport à leurs types.
    public $idDepartments = 0;
    public $depNumbers = '';
    public $depName = '';

    // on crée une methode magique __construct()
    public function __construct() {
        // On appelle le __construct() du parent via "parent::""
        parent::__construct();
    }

    /**
     * methode qui permet d'afficher les departements dans le select du formulaire de la page form.php
     * @return type
     */
    public function getDepartmentList() {
        $query = 'SELECT * FROM `clik_Departments`';
        $queryResult = $this->database->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
    }

}
