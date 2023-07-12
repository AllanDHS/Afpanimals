<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>

<?php
try {
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=animals;charset=utf8', 'root', 'root');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activer le mode d'exception
} catch (Exception $e) {
    error_log('Erreur de connexion à la base de données : ' . $e->getMessage());
    die('Une erreur est survenue, veuillez réessayer plus tard.');
}

function countSpecies($specie, $bdd)
{
    try {
        $sqlQuery = 'SELECT COUNT(e) FROM animal WHERE e = :specie'; // On compte le nombre d'animaux d'espèce 
        $animalStatement = $bdd->prepare($sqlQuery);
        $animalStatement->bindvalue(':specie', $specie, PDO::PARAM_INT);
        $animalStatement->execute();
        $animals = $animalStatement->fetch();
        return $animals['COUNT(e)'];
    } catch (Exception $e) {
        error_log('Erreur lors de la récupération des données : ' . $e->getMessage());
        die('Une erreur est survenue lors de la récupération des données.');
    }
}


function countbreed($breed, $bdd)
{
    try {
        $sqlQuery = 'SELECT COUNT(r) FROM animal WHERE r = :breed'; // On compte le nombre de race
        $animalStatement = $bdd->prepare($sqlQuery);
        $animalStatement->bindvalue(':breed', $breed, PDO::PARAM_INT);
        $animalStatement->execute();
        $animals = $animalStatement->fetch();
        return $animals['COUNT(r)'];
    } catch (Exception $e) {
        error_log('Erreur lors de la récupération des données : ' . $e->getMessage());
        die('Une erreur est survenue lors de la récupération des données.');
    }
}
?>


<main>

    <h2>Bienvenue sur la page admin</h2>

    <div class="contenu-admin">
        <div class="card m-2 text-center p-5" style="width: 18rem;">

            <p>Nous avons actuellement : <span class="espece"> <?= countSpecies(2, $bdd); ?></span> <br>Chien(s)</p>
            <p>Dont : </p>
            <div class="list">
                <ul>
                    <li><span class="race"><?= countbreed(3, $bdd); ?></span> <br>caniche(s)</li>
                    <li><span class="race"><?= countbreed(4, $bdd); ?></span> <br>Dog(s)</li>
                    <li><span class="race"><?= countbreed(2, $bdd); ?></span><br>Berger(s)</li>
                </ul>
            </div>
        </div>

        <div class="card m-2 text-center p-5" style="width: 20rem;">
            <p>Nous avons actuellement : <span class="espece"><?= countSpecies(1, $bdd); ?> </span> <br> Chat(s)</p>
            <p>Dont : </p>
            <div class="list">
                <ul>
                    <li><span class="race"><?= countbreed(5, $bdd); ?></span> <br>Siamois</li>
                    <li><span class="race"><?= countbreed(1, $bdd); ?></span><br> piersan(s)</li>
                    <li><span class="race"><?= countbreed(6, $bdd); ?></span> <br>Bengal(s)</li>
                </ul>
            </div>
        </div>
    </div>
    <p>Que voulez vous faire ?</p>

    <div class="button">

        <a href="../controllers/controller-form.php"><button type="button" class="btn-bleu">Ajouter un Animal</button></a>
        <a href="../controllers/controller-liste.php"><button type="button" class="btn-bleu2">Liste des Animaux</button></a>
    </div>
</main class="admin">













<?php include "components/footer.php" ?>