<?php
// Informations d'identification
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'registration');
 
// Connexion à la base de données MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Vérifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
} else {
    echo '<script>console.log("Connexion à la base de données MYSQL réussie et établie"); </script>';
}


function enregistrer_utilisateur($conn){
    if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])){
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($conn, $username); 
        // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($conn, $email);
        // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        //requéte SQL + mot de passe crypté
            $query = "INSERT into users (username, email, password)
                    VALUES ('$username', '$email', '".hash('sha256', $password)."')";
        // Exécuter la requête sur la base de données
            $res = mysqli_query($conn, $query);
    }
    return  $res;
    
}

?>	
