<?php

class Animals
{

    // Nous déterminons les propriétés de la classe Animals selon les colonnes de la table animal de la base de données.
    private int $id;
    private string $date;
    private string $couleur;
    private int $tatoue;
    private int $puce;
    private int $poids;
    private int $espece;
    private int $race;
    private string $nom;
    private int $sexe;
    private string $titre;
    private string $description;
    private string $image;


    /**
     * Ajouter un animal dans la base de données
     * @param array $inputs Tableau contenant les données du formulaire
     * @return bool Retourne true si l'animal a bien été ajouté, false sinon
     */
    public function addAnimal(array $inputs)
    {
        try {
            // Creation d'une instance de connexion à la base de données
            $pdo = Database::createInstancePDO();

            // requête SQL pour ajouter un animal avec des marqueurs nominatifs
            $sql = 'INSERT INTO `animal` (`nom`, `couleur`, `tatoue`, `puce`, `poids`, `e`, `r`, `image`, `sexe`,`date`,`titre`,`description`) VALUES (:name, :couleur, :tatoue, :puce, :poids, :espece, :race, :image, :sexe, :date,:titre,:description)';

            // On prépare la requête avant de l'exécuter
            $stmt = $pdo->prepare($sql);

            // On injecte les valeurs dans la requête et nous utilisont la méthode bindValue pour se prémunir des injections SQL
            $stmt->bindValue(':name', Form::safeData($inputs['name']), PDO::PARAM_STR);
            $stmt->bindValue(':couleur', Form::safeData($inputs['color']), PDO::PARAM_STR);
            $stmt->bindValue(':tatoue', Form::safeData($inputs['tatoue']), PDO::PARAM_INT);
            $stmt->bindValue(':puce',  Form::safeData($inputs['puce']), PDO::PARAM_INT);
            $stmt->bindValue(':poids', Form::safeData($inputs['poids']), PDO::PARAM_INT);
            $stmt->bindValue(':espece', Form::safeData($inputs['espece']), PDO::PARAM_INT);
            $stmt->bindValue(':race', Form::safeData($inputs['race']), PDO::PARAM_INT);
            $stmt->bindValue(':date', Form::safeData($inputs['date']), PDO::PARAM_STR);
            $stmt->bindValue(':image', Form::safeData($inputs['img']), PDO::PARAM_STR);
            $stmt->bindValue(':sexe', Form::safeData($inputs['sexe']), PDO::PARAM_INT);
            $stmt->bindValue(':titre', Form::safeData($inputs['titre']), PDO::PARAM_STR);
            $stmt->bindValue(':description', Form::safeData($inputs['description']), PDO::PARAM_STR);

            // On exécute la requête, elle sera true si elle a réussi, dans le cas contraire il y aura une exception
            return $stmt->execute();
        } catch (PDOException $e) {
            // test unitaire pour vérifier que l'animal n'a pas été ajouté et connaitre la raison
            // echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    public static function getAllAnimal()
    {
        $mysqlClient = Database::createInstancePDO();

        // Si tout va bien, on peut continuer

        // On récupère tout le contenu de la table animal
        $sqlQuery = 'SELECT animal.*, espece.nom AS espece, race.nom AS race
        FROM animal
        LEFT JOIN espece ON animal.e = espece.id_e
        LEFT JOIN race ON animal.r = race.id LIMIT 8';

        $animalStatement = $mysqlClient->prepare($sqlQuery);
        $animalStatement->execute();

        $animal = $animalStatement->fetchAll();

        return $animal;
    }

    public function deleteAnimalbyid($deleteId)
    {

        $mysqlClient = Database::createInstancePDO();
        try {
            // Effectuer la suppression dans la base de données
            $deleteQuery = 'DELETE FROM animal WHERE id = :delete_id';
            $deleteStatement = $mysqlClient->prepare($deleteQuery);
            $deleteStatement->bindParam(':delete_id', $deleteId, PDO::PARAM_INT);
            return $deleteStatement->execute();

            // Rediriger vers la même page pour éviter la soumission multiple si nécessaire

        } catch (Exception $e) {
            error_log('Erreur lors de la suppression : ' . $e->getMessage());
            die('Une erreur est survenue lors de la suppression.');
        }
    }
}
