<?php
include 'inc/init.inc.php';

// creation des variables vide afin d'eviter les erreur dans les value :
$titre = '';
$type = '';
$description = '';
$cp = '';
$ville = '';
$prix = '';

// puis on recupere les differents elements du post grace à $_POST[] : 
if (
    isset($_POST['titre']) &&
    isset($_POST['type']) &&
    isset($_POST['description']) &&
    isset($_POST['cp']) &&
    isset($_POST['ville']) &&
    isset($_POST['prix'])
) {

    // si tout ces elements sont recuperer alors on lis le code qui suit :

    // creation des variable avec des trim (afin de retirer les eventuels espace mis par accidents pas les users) :
    $titre = trim($_POST['titre']);
    $type = trim($_POST['type']);
    $description = trim($_POST['description']);
    $cp = trim($_POST['cp']);
    $ville = trim($_POST['ville']);
    $prix = trim($_POST['prix']);
    $erreur = true;
    // on peut faire des controle de saisies : (ici copié coller d'un controle du tp03) par manque de temps je gererais ça avec des required dans les input directment

    // controles des saises :
    // if (empty($nom)) {
    //     $erreur = false;
    //     $msg .= '<div class="alert alert-danger mb-2 rounded-pill">⚠ Le nom est obligatoire.<br> Veuillez vérifier vos saisies</div>';
    // }


    // insertion des info du form dans la BDD
    if ($erreur == true) {
        // echo '<pre>'; echo print_r($_POST); echo '</pre>'; // affichage array pour verif

        // c'est un form remplie par un user donc on utilise "prepare()" pour securisé les injections sql

        $insert = $pdo->prepare("INSERT INTO advert(id, titre, description, cp, ville, type, prix) VALUES (NULL, :titre, :description, :cp, :ville, :type, :prix)");
        $insert->bindParam(':titre', $titre, PDO::PARAM_STR);
        $insert->bindParam(':description', $description, PDO::PARAM_STR);
        $insert->bindParam(':cp', $cp, PDO::PARAM_STR);
        $insert->bindParam(':ville', $ville, PDO::PARAM_STR);
        $insert->bindParam(':type', $type, PDO::PARAM_STR);
        $insert->bindParam(':prix', $prix, PDO::PARAM_STR);
        $insert->execute();

        // puis je rajoute le fait que si l'annonce est bien enregistré en BDD sans encombre alors on redirige vers l'acceuil
        if ($erreur == true) {
            header('location: index.php');
        }
    } // FIN INSRT BDD


} // FIN ISSET



// debut des affichages
include 'inc/header.inc.php';
include 'inc/nav.inc.php';
?>

<main class="container-fluid" style="padding-left: 0px; padding-right: 0px;">
    <div class="p-3 text-center" style="width: 100%">
        <h1> <i class="fas fa-edit fw-bold"></i> Ajouté une annonce :</h1>
    </div>

    <div class="container">
        <div class="row mt-3">
            <div class="col-12"><?php echo $msg; ?></div>
            <div class="col-12">
                <form method="post" action="" class="p-3 row mt-5 bg-light border rounded"><br><br><br><br>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="titre">Quel est le titre de l'annonce ?</label>
                            <input type="text" name="titre" id="titre" class="form-control w-50" placeholder="Entrez le titre de l'annonce" value="" required>
                        </div>

                        <div class="mb-3">
                            <label for="type">Quel est le type de l'annonce ?</label><br>

                            <select name="type" id="type" class="form-control rounded-pill w-25" required>
                                <option value="location">Location</option>
                                <option value="vente">Vente</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description">Dites-nous en plus sur votre annonce :</label><br>
                            <textarea name="description" id="description" cols="40" rows="3" placeholder="Entrez une description" required></textarea>
                        </div>
                    </div>

                    <div class="col-sm-6 mt-5">
                        <div class="mb-3">
                            <label for="cp">Code postale du bien immobilier :</label>
                            <input type="text" name="cp" id="cp" class="form-control w-50" placeholder="Entrez le code postale du bien immobilier" value="" required>
                        </div>

                        <div class="mb-3">
                            <label for="ville">Ville du bien immobilier :</label>
                            <input type="text" name="ville" id="ville" class="form-control w-50" value="" placeholder="Entrez le nom la ville du bien immobilier" required>
                        </div>

                        <div class="mb-3">
                            <label for="prix">Prix du bien :</label>
                            <input type="text" name="prix" id="prix" class="form-control w-25" value="" placeholder="Entrez un prix" required>
                        </div>
                    </div>



                    <div class="col-sm-6"></div>

                    <div class=" btn-post col-sm-6 ">
                        <button type="submit" id="ajouter" class="btn bg-primary rounded-pill text-light">Poster l'annonce</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12"><br><br><br><br><br><br><br><br><br><br></div> <!-- j'ai pas eu de meilleur idées et je n'avais plus le temps de gérer ça (vraiment fait a la va vite et en plus c'est vraiment collé au bas de l'ecran.., je sais bien qu'avec les marge et padding c'est gerable mais pas le temps) -->

    <footer class="text-muted py-5  bg-light">
        <div class="container bg-light">
            <p class="float-end mb-1">
                <a class="btn_acceuil" href="index.php">Retour à l'acceuil <i class="far fa-arrow-alt-circle-right"></i></a>
            </p>
            <p class="mb-1">&copy; Le Bon Appart. Droits réservez.</p>
        </div>
    </footer>

</main>


<?php
include 'inc/footer.inc.php';
