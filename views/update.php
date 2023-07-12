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



if (isset($_POST['id'])) {
    $updateId = $_POST['id'];
    $name = $_POST['name'];
    $couleur = $_POST['color'];
    $tatoue = $_POST['tatou'];
    $puce = $_POST['puce'];
    $poids = $_POST['poids'];
    $espece = $_POST['espece'];
    $race = $_POST['race'];
    $date = $_POST['date'];
    $image = $_POST['img'];
    $sexe = $_POST['sexe'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    try {
        // Effectuer la suppression dans la base de données
        $uptadeQuery = 'UPDATE animal
      SET e = :espece, r = :race, poids = :poids, tatoue = :tatoue, puce = :puce, sexe = :sexe, nom = :nom, couleur = :couleur, titre = :titre, description = :description, image = :image, date = :date
      WHERE id = :id';


        $uptadeStatement = $bdd->prepare($uptadeQuery);
        $uptadeStatement->bindParam(':id', $updateId, PDO::PARAM_INT);
        $uptadeStatement->bindParam(':nom', $name, PDO::PARAM_STR);
        $uptadeStatement->bindParam(':tatoue', $tatoue, PDO::PARAM_INT);
        $uptadeStatement->bindParam(':puce', $puce, PDO::PARAM_INT);
        $uptadeStatement->bindParam(':couleur', $couleur, PDO::PARAM_STR);
        $uptadeStatement->bindParam(':poids', $poids, PDO::PARAM_INT);
        $uptadeStatement->bindParam(':espece', $espece, PDO::PARAM_INT);
        $uptadeStatement->bindParam(':race', $race, PDO::PARAM_INT);
        $uptadeStatement->bindParam(':date', $date, PDO::PARAM_STR);
        $uptadeStatement->bindParam(':image', $image, PDO::PARAM_STR);
        $uptadeStatement->bindParam(':sexe', $sexe, PDO::PARAM_INT);
        $uptadeStatement->bindParam(':titre', $titre, PDO::PARAM_STR);
        $uptadeStatement->bindParam(':description', $description, PDO::PARAM_STR);
        $uptadeStatement->execute();



        // Rediriger vers la même page pour éviter la soumission multiple si nécessaire
        header('Location: ../controllers/controller-liste.php');
        exit();
    } catch (Exception $e) {
        error_log('Erreur lors de la suppression : ' . $e->getMessage());
        die($e->getMessage());
    }
}

?>


<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h2>Formulaire d'ajout</h2>
        </div>
    </div>
    <form action="#" method="post">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="date_entree">Date d'entrée:</label>
                        <input type="date" class="form-control" id="date_entree" name="date" value="<?= $animals['date'] ?>">
                        <span><?= $errors['date'] ?? "" ?></span>
                    </div>
                </div>



                <div class="col">
                    <div class="form-group">
                        <label for="espece">Espèce:</label>
                        <select class="form-control" id="espece" name="espece">

                            <option value="2" <?= $animals['espece'] == 'chien' ? "selected" : "" ?>>Chien</option>
                            <option value="1" <?= $animals['espece'] == 'chat' ? "selected" : "" ?>>Chat</option>
                        </select>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="race">Race:</label>
                            <select class="form-control" id="race" name="race">
                                <option value="4" <?= $animals['race'] == 4 ? "selected" : "" ?>>Dog</option>
                                <option value="3" <?= $animals['race'] == 3 ? "selected" : "" ?>>Caniche</option>
                                <option value="2" <?= $animals['race'] == 2 ? "selected" : "" ?>>Berger Allemand</option>
                                <option value="1" <?= $animals['race'] == 1 ? "selected" : "" ?>>Persan</option>
                                <option value="5" <?= $animals['race'] == 5 ? "selected" : "" ?>>Siamois</option>
                                <option value="6" <?= $animals['race'] == 6 ? "selected" : "" ?>>Bengal</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="couleur">Couleur:</label>
                    <select class="form-control" id="color" name="color">
                        <option value="<?= $animals['couleur'] ?>"><?= $animals['couleur'] ?></option>
                        <option value="noir">Noir</option>
                        <option value="blanc">Blanc</option>
                        <option value="marron">Marron</option>
                        <option value="gris">Gris</option>
                        <option value="roux">Roux</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="tatou" name="tatou" <?= $animals['tatoue'] ? "checked" : "" ?> value="<?= $animals['tatoue'] ?>">
                        <label class="form-check-label" for="tatou">Tatoué</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="puce" name="puce" <?= $animals['puce'] ? "checked" : "" ?> value="<?= $animals['puce'] ?>">
                        <label class="form-check-label" for="puce">Pucé</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="sexe_male" name="sexe" <?= $animals['sexe'] === 1 ? "checked" : "" ?> value="1">
                        <label class="form-check-label" for="sexe_male">Mâle</label>
                        <span><?= $errors['sexe'] ?? "" ?></span>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="sexe_femelle" name="sexe" <?= $animals['sexe'] === 0 ? "checked" : "" ?> value="0">
                        <label class="form-check-label" for="sexe_femelle">Femelle</label>
                        <span><?= $errors['sexe'] ?? "" ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="nom">Nom:</label>
                            <input type="text" class="form-control" id="nom" name="name" value="<?= $animals['nom'] ?>">
                            <span><?= $errors['name'] ?? "" ?></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="poids">Poids:</label>
                            <input type="text" class="form-control" id="poids" name="poids" value="<?= $animals['poids'] ?>">
                            <span><?= $errors['poids'] ?? "" ?></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="titre">Titre:</label>
                            <input type="text" class="form-control" id="titre" name="titre" value="<?= $animals['titre'] ?>">
                            <span><?= $errors['titre'] ?? "" ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="floatingTextarea2">Comments</label>
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="description" value="<?= $animals['description'] ?>"></textarea>
                </div>
                <span><?= $errors['description'] ?? "" ?></span>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="text" class="form-control" id="img" name="img" value="<?= $animals['image'] ?>">
            </div>
            <div class="center-button">
                <input type="hidden" name="id" value="<?= $animals['id'] ?>">
                <a href="#" onclick="return confirm('Êtes-vous sûr de vouloir modifier cet animal ?')""><button type=" submit" class="btn-bleu2">Modifier</button></a>
            </div>
    </form>
</div>
</div>