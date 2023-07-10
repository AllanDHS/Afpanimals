<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>

<main>
    <?php if ($showForm) { ?>
        <form action="#" method="post">
            <div class="form-group">
                <label for="date_entree">Date d'entrée:</label>
                <input type="date" class="form-control" id="date_entree" name="date">
                <span><?= $errors['date'] ?? "" ?></span>
            </div>
            <div class="form-group">
                <label for="espece">Espèce:</label>
                <select class="form-control" id="espece" name="type">
                    <option value="" selected disabled>Choisissez une espèce</option>
                    <option value="2" name="chien">Chien</option>
                    <option value="1" name="chat">Chat</option>
                </select>
            </div>
            <div class="form-group">
                <label for="race">Race:</label>
                <select class="form-control" id="race" name="race">
                    <option value="" selected disabled>Choisissez une race</option>
                    <option value="4" name="dog">Dog</option>
                    <option value="3" name="caniche">Caniche</option>
                    <option value="2" name="berger">Berger Allemand</option>
                    <option value="1" name="persan">Persan</option>
                    <option value="5" name="siamois">Siamois</option>
                    <option value="6" name="bengal">Bengal</option>
                </select>
            </div>
            <div class="form-group">
                <label for="couleur">Couleur:</label>
                <select class="form-control" id="couleur" name="color">
                    <option value="" selected disabled>Choisissez une couleur</option>
                    <option value="noir">Noir</option>
                    <option value="blanc">Blanc</option>
                    <option value="marron">Marron</option>
                    <option value="gris">Gris</option>
                    <option value="roux">Roux</option>
                </select>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="tatou" name="tatou" value="1">
                    <label class="form-check-label" for="tatou">Tatoué</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="puce" name="puce" value="1">
                    <label class="form-check-label" for="puce">Pucé</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="sexe_male" name="sexe" value="1" <?php if (isset($_POST['sexe']) && $_POST['sexe'] == "1") echo "checked"; ?>>
                    <label class="form-check-label" for="sexe_male">Mâle</label>
                    <span><?= $errors['sexe'] ?? "" ?></span>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="sexe_femelle" name="sexe" value="0" <?php if (isset($_POST['sexe']) && $_POST['sexe'] == "0") echo "checked"; ?>>
                    <label class="form-check-label" for="sexe_femelle">Femelle</label>
                    <span><?= $errors['sexe'] ?? "" ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" id="nom" name="name">
                <span><?= $errors['name'] ?? "" ?></span>
            </div>
            <div class="form-group">
                <label for="poids">Poids:</label>
                <input type="text" class="form-control" id="poids" name="poids">
                <span><?= $errors['poids'] ?? "" ?></span>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="text" class="form-control-file" id="img" name="img">
            </div>
            <button type="submit" class="btn btn-primary">Soumettre</button>
        </form>
        </div>
    <?php } else { ?>
        <h1>L'animal a bien été enregistrer dans la base de donnée</h1>
        <a href="../views/admin.php"><button>Retour</button></a>
        <div>
            <?php
            try {
                $dbh = new PDO('mysql:host=localhost;dbname=animals;charset=utf8', 'root', 'root');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }


            $name = $_POST['name'];
            $couleur = $_POST['color'];
            $tatoue = $_POST['tatou'];
            $puce = $_POST['puce'];
            $poids = $_POST['poids'];
            $espece = $_POST['type'];
            $race = $_POST['race'];
            $date = $_POST['date'];
            $image = $_POST['img'];
            $sexe = $_POST['sexe'];
            $stmt = $dbh->prepare("INSERT INTO animal (nom, couleur, tatoue, puce, poids, e, r, image, sexe,date) VALUES (:name, :couleur, :tatoue, :puce, :poids, :espece, :race, :image, :sexe, :date)");

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':tatoue', $tatoue);
            $stmt->bindParam(':puce', $puce);
            $stmt->bindParam(':couleur', $couleur);
            $stmt->bindParam(':poids', $poids);
            $stmt->bindParam(':espece', $espece);
            $stmt->bindParam(':race', $race);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':sexe', $sexe);






            $stmt->execute();
            ?>
        </div>
    <?php } ?>
</main>


</body>

</html>

<?php include "components/footer.php" ?>