<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>



<h2 class="text-center p-4">Bienvenue sur Afpanimals</h2>
<p class="text-center p-5 fs-5">À la recherche d'une nouvelle compagnie pleine de douceur et d'aventures ? Ne cherchez plus, notre adorable chenille d'adoption est prête à vous émerveiller avec ses couleurs chatoyantes et son caractère attachant. Préparez-vous à vivre une expérience unique en accueillant cette petite boule de bonheur dans votre foyer. Adoptez notre chenille et laissez-la tisser des liens d'amour et de complicité avec vous !</p>
<div class="container-fluid m-5">
    <div class="row">
        <?php
        foreach ( Animals::getAllAnimal() as $animals) {
        ?>
            <div class="col-md-3 ">
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo $animals['image'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $animals['nom'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $animals['espece'] ?></h6>
                        <p class="card-text"><?= $animals['sexe'] ? 'Mâle' : 'Femelle'; ?></p>
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                        <a href="../controllers/controller-animal.php?id=<?php echo $animals['id'] ?>"> <button class="btn mr-2 btn-accueil"><i class="fas fa-link"></i>+ Infos</button></a>
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