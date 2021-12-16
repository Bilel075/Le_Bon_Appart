<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= URL ?>index.php"><b>Le Bon Appart <i class="fas fa-house-user"></i></i></b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Informations <i class="far fa-question-circle"></i></a> <!-- je l'ai laissé pour faire un peu d'habillage, le lien ne renvoie vers rien -->
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Favoris <i class="far fa-heart"></i></i></a> <!-- je l'ai laissé pour faire un peu d'habillage, le lien ne renvoie vers rien -->
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-bolder text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Annonce(s)
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

            <li><a class="dropdown-item" href="<?= URL ?>ajouter_annonce.php"><b>Ajouté une annonce <i class="fas fa-scroll"></i></b></a></li>

            <li><hr class="dropdown-divider"></li>

            <li><a class="dropdown-item" href="<?= URL ?>acceuil.php"><b>Consulter toutes les annonces <i class="far fa-eye"></i></b></a></li>

          </ul>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2 rounded-pill" type="search" placeholder="Rechercher une annonce" aria-label="Search">
        <button class="btn btn-outline-primary rounded-pill" type="submit">Rechercher</button>
      </form>
    </div>
  </div>
</nav>