<?php
include_once('functions.php');
// dump($_POST);

    // Etablissement de la connexion avec la BDD
    $host = 'localhost';
    $db   = 'test';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO('mysql:host='.$host.'; port=3306; dbname='.$db,$user,$pass);
    

   // enregistrer en BDD le formulaire
   if(isset($_POST['bouton'])) {
        // le formulaire est soumis
        // echo "soumis";
        $is_active = $_POST["bouton"];
        $id = $_POST['id'];
        // insertion de données
        $sql = "UPDATE `clients` SET `etat` = :etat WHERE `id` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':etat', $is_active, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // récupérer les informations de la BDD pour les afficher dans le tableau
    $sql = "SELECT * FROM `clients`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row):
    endforeach;
        
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP</title>
        <link rel="stylesheet" href="unsubscribe.css">

    </head>
    <body>
        <div class="a">
            <a href="index.php" class="a">Page d'inscription</a>
        </div>
        <h1>NewsLetter</h1>
        <br>
        <h2>Désinscription de la newsletter</h2>
        <br>
        <h5>(vous ne recevrez plus de mails pour vous notifier des nouvelles newsletters)</h5>
        <!-- Action vide => renvoi ver sla page elle-même -->
        
        <!-- Method = POST ou GET (par défaut) -->
        <form action="" method="POST">
            <div>
                <label for="mail">Adresse mail</label>
                <input id="mail" type="email" name="mail" placeholder="exemple@gmail.com" required>
            </div>
            <div>
                <button type="submit">Se désinscrire</button>
            </div>
        </form>
    </body>
</html>