<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>



<?php


// Vérifier si une demande de suppression a été soumise


if (isset($_GET['delete_id'])) {
  $animal = new Animals();
  if ($animal->deleteAnimalbyid($_GET['delete_id'])) {
    header('Location: ../controllers/controller-admin.php');
    exit();
  }
}

// Récupération des données

?>

<h3 class="text-center p-4 fs-2">Liste des animaux</h3>

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
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach (Animals::getAllAnimal() as $animal) : ?>
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
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="../controllers/controller-animal.php?id=<?php echo $animal['id'] ?>"><button class="btn-bleuListe">+ Infos</button></a>
            <a href="../controllers/controller-uptade.php?id=<?php echo $animal['id'] ?>"><button class="btn-bleuListe">Modifier</button></a>
            <a href="?delete_id=<?= $animal['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?')""><button class=" btn-bleuListe2">Supprimer</button></a>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>



<div class="center-button">


  <a href="../controllers/controller-admin.php"><button  class="btn-bleu">Retour</button></a>
  <a href="../controllers/controller-form.php"><button type="button" class="btn-bleu2">ajouter</button></a>
</div>
<?php include "components/footer.php" ?>