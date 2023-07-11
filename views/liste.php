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

// Vérifier si une demande de suppression a été soumise
if (isset($_GET['delete_id'])) {
  $deleteId = $_GET['delete_id'];

  try {
    // Effectuer la suppression dans la base de données
    $deleteQuery = 'DELETE FROM animal WHERE id = :delete_id';
    $deleteStatement = $bdd->prepare($deleteQuery);
    $deleteStatement->bindParam(':delete_id', $deleteId, PDO::PARAM_INT);
    $deleteStatement->execute();

    // Rediriger vers la même page pour éviter la soumission multiple si nécessaire
    header('Location: ../controllers/controller-admin.php');
    exit();
  } catch (Exception $e) {
    error_log('Erreur lors de la suppression : ' . $e->getMessage());
    die('Une erreur est survenue lors de la suppression.');
  }
}

// Récupération des données
try {
  $sqlQuery = 'SELECT animal.*, espece.nom AS espece, race.nom AS race
                FROM animal
                LEFT JOIN espece ON animal.e = espece.id_e
                LEFT JOIN race ON animal.r = race.id';
  $animalStatement = $bdd->prepare($sqlQuery);
  $animalStatement->execute();
  $animals = $animalStatement->fetchAll();
} catch (Exception $e) {
  error_log('Erreur lors de la récupération des données : ' . $e->getMessage());
  die('Une erreur est survenue lors de la récupération des données.');
}
?>

<table class="table table-hover" style="min-height: 80%;">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Couleur</th>
      <th scope="col">Tatoué</th>
      <th scope="col">Pucé</th>
      <th scope="col">Sexe</th>
      <th scope="col">Espece</th>
      <th scope="col">Race</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($animals as $animal) : ?>
      <tr>
        <th scope="row"><?= $animal['id']; ?></th>
        <td><?= htmlspecialchars($animal['nom']); ?></td>
        <td><?= htmlspecialchars($animal['couleur']); ?></td>
        <td><?= $animal['tatoue'] ? 'Oui' : 'Non'; ?></td>
        <td><?= $animal['puce'] ? 'Oui' : 'Non'; ?></td>
        <td><?= $animal['sexe'] ? 'Mâle' : 'Femelle'; ?></td>
        <td><?= htmlspecialchars($animal['espece']); ?></td>
        <td><?= htmlspecialchars($animal['race']); ?></td>
        <td>
        <a href="../controllers/controller-animal.php?id=<?php echo $animal ['id'] ?>"><button class="btn-bleuListe">+ Infos</button></a>
        <a href="../controllers/controller-uptade.php?id=<?php echo $animal ['id'] ?>"><button class="btn-bleuListe">Modifier</button></a>
          <a href="?delete_id=<?= $animal['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?')""><button class="btn-bleuListe2">Supprimer</button></a>
          
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>



<div class="center-button">


<a href="../views/admin.php"><button type="button" class="btn-bleu">Retour</button></a>
<a href="../views/form.php"><button type="button" class="btn-bleu2">Ajout</button></a>
</div>
<?php include "components/footer.php" ?>