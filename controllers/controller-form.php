<?php 




// de base le formulaire est affiché car true
$showForm = true;

// Regex du Nom : seul les petites et grandes lettres ok
$regexName = '/^[a-zA-Z]+$/';
$regexPoids = '/^[0-9]+$/';

// Création d'une tableau d'erreurs
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Vérification de l'input name
    if (isset($_POST['name'])) {
        $name = $_POST['name'];

        // verification si c vide
        if (empty($name)) {
            $errors['name'] = 'Champs osbligatoire';
            // verification du format
        } else if (!preg_match($regexName, $name)) {
            $errors['name'] = 'Mauvais format';
        }
    }

    // Vérification de l'input poids
    if (isset($_POST['poids'])) {
        $poids = $_POST['poids'];

        // verification si c vide
        if (empty($poids)) {
            $errors['poids'] = 'Champs obligatoire';
            // verification du format
        } else if (!preg_match($regexPoids, $poids)) {
            $errors['poids'] = 'Mauvais format';
        }
    }


    // Vérification de l'input race
    if (isset($_POST['race'])) {
        $race = $_POST['race'];

        // verification si c vide
        if (empty($race)) {
            $errors['race'] = 'Champs obligatoire';
        }
    }


    // Vérification de l'input type
    if (isset($_POST['type'])) {
        $type = $_POST['type'];

        // verification si c vide
        if (empty($type)) {
            $errors['type'] = 'Champs obligatoire';
        }
    }

    // Vérification de l'input color
    if (isset($_POST['color'])) {
        $color = $_POST['color'];

        // verification si c vide
        if (empty($color)) {
            $errors['color'] = 'Champs obligatoire';
        }
    }



    // Vérification de l'input sexe

    if(isset($_POST['sexe']) && $_POST['sexe'] == "1") echo "checked";{
        $sexe = $_POST['sexe'];
    }

    // Vérification de l'input date

    if (isset($_POST['date'])) {
        $date = $_POST['date'];

        // verification si c vide
        if (empty($date)) {
            $errors['date'] = 'Champs obligatoire';
        }
    }

    // Vérification de l'input titre

    if (isset($_POST['titre'])) {
        $titre = $_POST['titre'];

        // verification si c vide
        if (empty($titre)) {
            $errors['titre'] = 'Champs obligatoire';
        }
    }

    // Vérification de l'input description


    // à la fin des verifs on check le tableau $errors
    if (count($errors) == 0) {
        $showForm = false;
    }
}

include "../views/form.php";





?>