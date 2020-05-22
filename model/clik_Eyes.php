<?php

/* On crée une class clik_Departments qui hérite de la classe database via extends
 * 
 */

class clik_Eyes extends database {

    // Création d'attributs qui correspondent à chacun des champs de la table clik_Eyes
    // et on les initialise par rapport à leurs types.
    public $id = 0;
    public $eyesColor = '';

    // on crée une methode magique __construct()
    public function __construct() {
        // On appelle le __construct() du parent via "parent::""
        parent::__construct();
    }

    /**
     * methode qui permet d'afficher la couleur des yeux dans le select du formulaire de la page form.php
     * @return type
     */
    public function getColorEyesList() {
        $query = 'SELECT `id`,`eyesColor` FROM `clik_Eyes`';
        $queryResult = $this->database->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
    }

}
