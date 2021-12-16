<?php
include 'inc/init.inc.php';

// insertion de la resa en BDD
if (isset($_POST['msg_resa'])) {
    // on crée la variable en supprimant les espace de debut et fin de chaine pour plus de propreter
    $msg_resa = trim($_POST['msg_resa']);
    $erreur = false;

    // enregistrement en BDD
    if (!empty($msg_resa)) { // si a la validation du form le msg_resa n'est pas vide alors on modifie en BDD

        $modif = $pdo->prepare("UPDATE advert SET reservation_message = :reservation_message WHERE id = :id");
        $modif->bindParam(':reservation_message', $msg_resa, PDO::PARAM_STR);
        $modif->execute();

        if (!empty($_GET['id'])) { // si l'id dans l'url n'est pas vide alors à la validation du form on redirige vers 'msg_envoye' 
            header('location: msg_envoye.php');
        }
    } // ça ne fonctionne pas depuis 15h20 je suis dessus..  
}


// on recup l'annonce en BDD grace a son id
$recup_annonce = $pdo->prepare("SELECT * FROM advert WHERE id = :id");
$recup_annonce->bindParam(':id', $_GET['id'], PDO::PARAM_STR);
$recup_annonce->execute();

// on peut egalement faire un rowcount sur $recup_annonce et si cela renvoie 0 on renvoie sur l'acceuil
// if ($recup_annonce->rowCount() < 1) {
//     // cas d'erreur
//     header('location:acceuil.php');
// }

// on place les infos recuperer dans l'url dans un array grace au fetch ce qui va nous aider pour le traitement des données par la suite
$info = $recup_annonce->fetch(PDO::FETCH_ASSOC);



// debut des affichages
include 'inc/header.inc.php';
include 'inc/nav.inc.php';
// echo '<pre>'; echo print_r($_GET); echo '</pre>'; // un echo afin de voir ce que notre get renvoie (ici l'id)
//  echo '<pre>'; echo print_r($info); echo '</pre>'; // un echo afin de voir ce que notre $info renvoie (toutes les infos de la BDD)
// echo '<pre>'; echo print_r($_POST); echo '</pre>';  // permet de voir la recup du msg_resa
?>
<main">
    <section class="text-center container">
        <div class="row pt-5 g-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-bolder"><?= $info['titre'] ?></h1>
                <p class="lead text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias doloribus nam natus molestiae praesentium, dolor quia facere earum.</p>
            </div>
        </div>
    </section>

    <div class="album py-4 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                <div class="col-6">
                    <div class="card shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">

                            <rect width="100%" height="100%" fill="#55595c" /><text x="37%" y="50%" fill="#eceeef" dy=".3em">Photo Bien immo</text>
                        </svg>

                        <div class="card-body border border-rounded">
                            <h5 class="text-dark text-center"><?= $info['titre']; ?></h5>
                            <div>
                                <small class="text-muted"><span class="text-dark fw-bold">Ville :</span> <?= $info['ville']; ?></small><br>
                                <small class="text-muted"><span class="text-dark fw-bold">Code postale :</span> <?= $info['cp']; ?></small><br> <!-- le cp etant en varchar 5 on a l'impression que les cp ne corresponde pas, mais en les modifiant en BDD on remarque qu'ils se modif bien.-->
                                <small class="text-muted"><span class="text-dark fw-bold">Type de l'annonce :</span> <?= $info['type']; ?></small><br>
                            </div>
                            <hr>
                            <p class="card-text"><span class="text-dark fw-bolder">Description :</span><br><?= $info['description']; ?></p><br>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted"><span class="text-dark fw-bold">Prix de l'annonce :</span> <?= $info['prix'] . '€'; ?></small>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill">Afficher l'annonce</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 ms-5">
                    <h2 class="ms-5">Le bien <?= $info['titre']; ?> vous intétesse ?</h2><br>
                    <p class="ms-5">Laissez un message de reservation au vendeur !👌</p>
                    <form action="" method="POST">
                        <textarea class="mt-2" cname="msg_resa" id="msg_resa" cols="54" rows="5" placeholder="Entrez votre message ici 💌"></textarea><br><br>

                        <div class="btn_envoye_detail">
                            <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill">Je réserve ! ✅ </buttton>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
    </main>

    <footer class="text-muted py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a class="btn_acceuil" href="index.php">Retour à l'accueil <i class="far fa-arrow-alt-circle-right"></i></a>
            </p>
            <p class="mb-1">&copy; Le Bon Appart. Droits réservez.</p>
        </div>
    </footer>

    <?php
    include 'inc/footer.inc.php';
