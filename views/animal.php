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

$id = $_GET['id'];

try {
    $sqlQuery = 'SELECT animal.*, espece.nom AS espece, race.nom AS race
                  FROM animal
                  LEFT JOIN espece ON animal.e = espece.id_e
                  LEFT JOIN race ON animal.r = race.id WHERE animal.id = :id';
    $animalStatement = $bdd->prepare($sqlQuery);
    $animalStatement->bindParam(':id', $id, PDO::PARAM_INT);
    $animalStatement->execute();
    $animals = $animalStatement->fetch();
} catch (Exception $e) {
    error_log('Erreur lors de la récupération des données : ' . $e->getMessage());
    die('Une erreur est survenue lors de la récupération des données.');
}




if (isset($id)) {
?>

    <section class="dark">
        <div class="container py-4">
            <h1 class="h1 text-center" id="pageHeaderTitle"><?=htmlspecialchars($animals['titre']); ?></h1>
            <article class="postcard dark blue">
                <a class="postcard__img_link" href="#">
                    <img class="postcard__img" src="<?= htmlspecialchars($animals['image']); ?>" alt="<?= htmlspecialchars($animals['titre']); ?>" />
                </a>
                <div class="postcard__text">
                    <h1 class="postcard__title blue"><a href="#"> <?=htmlspecialchars($animals['nom']); ?> </a></h1>
                    <div class="postcard__subtitle small">
                        <time datetime="2020-05-25 12:00:00">
                            <i class="fas fa-calendar-alt mr-2"></i><?= htmlspecialchars($animals['date']); ?>
                        </time>
                    </div>
                    <div class="postcard__bar"></div>
                    <div class="postcard__preview-txt"><?= $animals['description'] === null ? "" : htmlspecialchars($animals['description']); ?>
                    </div>
                    <ul class="postcard__tagbox">
                        <li class="tag__item"><i class="fas fa-tag mr-2"></i><?= htmlspecialchars($animals['espece']); ?></li>
                        <li class="tag__item"><i class="fas fa-clock mr-2"></i><?= htmlspecialchars($animals['race']); ?></li>
                        <li class="tag__item"><i class="fas fa-clock mr-2"></i><?= htmlspecialchars($animals['poids']); ?> Kg</li>
                        <li class="tag__item play blue">
                            <a href="#"><i class="fas fa-play mr-2"></i><?= htmlspecialchars($animals['couleur']); ?></a>
                        </li>
                    </ul>
                </div>
            </article>

        </div>
    </section>



<?php

} else {
    echo "pas ok";
}



include "components/footer.php" ?>