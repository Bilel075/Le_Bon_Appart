<?php
include 'inc/init.inc.php';
// j'ai mis la plus part du peu de css que j'ai directement dans mon html pour gagner du temps.

// j'ai galerer avec l'update sql et je me suis rendu compte que meme dans mon cours mes modifs ne fonctionee pas du tout.

$liste_annonce = $pdo->query("SELECT * FROM advert ORDER BY id DESC LIMIT 15"); // ORDER BY id DESC permet d'afficher les annonce de la plus recente a la plus ancienne grace a l'id LIMIT 15 limite le nombre d'annonce afficher à 15
$liste_annonce->execute();


// debut des affichages
include 'inc/header.inc.php';
include 'inc/nav.inc.php';
?>
<main">
    <section class="text-center container">
        <div class="bg_img row pt-5 g-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-bolder">Toutes les annonces</h1>
                <p class="lead text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias doloribus nam natus molestiae praesentium, dolor quia facere earum tenetur exercitationem at dolorem voluptate tempore. Consectetur asperiores nihil culpa quo optio?</p>
                <p>
                    <a href="ajouter_annonce.php" class="btn_accueil_form btn btn-outline-primary rounded-pill my-2">Essayez !<br>Ajouter une annonce -></a>
                </p>
            </div>
        </div>
    </section>

    <div class="album py-4 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php
                // affichage de la liste des annonces présente en BDD
                while ($ligne = $liste_annonce->fetch(PDO::FETCH_ASSOC)) {
                    // echo '<pre>'; echo print_r($ligne); echo '</pre>'; 
                ?>

                    <div class="col">
                        <div class="card shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"> <!-- j'aurais pu retiré le champs svg mais je trouve que cela fait plus "maquette présentable" comme ça -->

                                <rect width="100%" height="100%" fill="#55595c" /><text x="37%" y="50%" fill="#eceeef" dy=".3em">Photo Bien immo</text>
                            </svg>

                            <div class="card-body border border-rounded">
                                <h5 class="text-dark text-center"><?= strtoupper($ligne['titre']); ?></h5> <!-- pour la maj on aurait pu faire ça sous forme de variable mais je m'y suis rappellé que vers la fin -->
                                <div>
                                    <small class="text-muted"><span class="text-dark fw-bold">Ville :</span> <?= $ligne['ville']; ?></small><br>
                                    <small class="text-muted"><span class="text-dark fw-bold">Code postale :</span> <?= $ligne['cp']; ?></small><br> <!-- le cp etant en varchar 5 on a l'impression que les cp ne corresponde pas, mais en les modifiant en BDD on remarque qu'ils se modif bien.-->
                                    <small class="text-muted"><span class="text-dark fw-bold">Type de l'annonce :</span> <?= $ligne['type']; ?></small><br>
                                </div>
                                <hr>
                                <p class="card-text"><span class="text-dark fw-bolder">Description :</span><br><?= $ligne['description']; ?></p><br>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted"><span class="text-dark fw-bold">Prix de l'annonce :</span> <?= $ligne['prix'] .'€'; ?></small>

                                    <div class="btn-group">
                                      <a href="detail_annonce.php?id=<?= $ligne['id']; ?>"  button type="button" class="btn btn-sm btn-outline-primary rounded-pill">Afficher l'annonce</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } // fin de la boucle
                ?>
            </div>
        </div>
    </div>
    </main>

    <footer class="text-muted py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Haut de page</a>
            </p>
            <p class="mb-1">&copy; Le Bon Appart. Droits réservez.</p>
        </div>
    </footer>

    <?php
    include 'inc/footer.inc.php';
