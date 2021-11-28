<?php
  // Initialiser la session
  session_start();
  require('config.php');
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!--<div class="sucess">
    <h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>
    <h3>C'est votre tableau de bord.</h3>
    <a href="logout.php"><button class="btn btn-danger">Déconnexion</button></a>
    </div>-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand text-uppercase fw-bold" href="#">Crud Operation</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Liste d'utilisateur</a>
            </li>
          </ul>
          <div class="d-flex">
            <div class="dropdown">
              <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $_SESSION['username']; ?>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="logout.php">Déconnexion</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
  <div class="container mt-4">
    <div class="row">
      <table class="table">
        <thead class="table-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">USERNAME</th>
            <th scope="col">EMAIL</th>
            <th scope="col">ACTION</th>
          </tr>
        </thead>
        <tbody>
          <?php      
            $query = "SELECT id,username,email FROM `users`";
            $result_delete = mysqli_query($conn, "DELETE FROM `users` WHERE id='$id'");
            $result = mysqli_query($conn,$query);
            while($rowtwo = mysqli_fetch_array($result)){
              echo '<tr>
                <th scope="row">'.$rowtwo['id'].'</th>
                <td>'.$rowtwo['username'].'</td>
                <td>'.$rowtwo['email'].'</td>
                <td>
                  <i class="fas fa-trash-alt mr-2" style="margin-right: 8%;"></i> 
                  <i class="fas fa-user-edit"></i>
                </td>
              </tr>';
            }
          ?>
        </tbody>
      </table>
      <div class="d-grid gap-2">
          <button class="btn btn-primary text-uppercase fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-user-plus" style="margin-right: 1%;"></i>Ajouter un utilisateur</button>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Enregistrement d'un utilisateur</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php 
                    if (enregistrer_utilisateur($conn)){
                      header("Refresh:0");
                    }
                ?>
                <form action="" method="post">
                  <div class="modal-body">
                    <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
                    <input type="email" class="box-input" name="email" placeholder="Email" required />
                    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" name="submit" class="btn btn-success">Enregistrer</button>
                  </div>
                </form>
              </div>
            </div>  
          </div>
      </div>
    </div>
  </div>
  </body>
</html>