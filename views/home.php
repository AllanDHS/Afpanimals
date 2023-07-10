<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>




<?php
try {
    // On se connecte à MySQL
    $mysqlClient = new PDO('mysql:host=localhost;dbname=animals;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table animal
$sqlQuery = 'SELECT animal.*, espece.nom AS espece, race.nom AS race
FROM animal
LEFT JOIN espece ON animal.e = espece.id_e
LEFT JOIN race ON animal.r = race.id LIMIT 8';
$animalStatement = $mysqlClient->prepare($sqlQuery);
$animalStatement->execute();
$animal = $animalStatement->fetchAll();

// On affiche chaque recette une à une
?>
<div class="container m-5">
    <div class="row">
        <?php
        foreach ($animal as $animals) {
        ?>

            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo $animals['image'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $animals['nom'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $animals['espece'] ?></h6>
                        <p class="card-text"><?= $animals['sexe'] ? 'Mâle' : 'Femelle'; ?></p>
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                        <a href="#" class="btn mr-2 btn-accueil"><i class="fas fa-link"></i> Visit Site</a>
                        <!-- <a href="#" class="btn "><i class="fab fa-github"></i> Github</a> -->
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>


<?php include "components/footer.php" ?>