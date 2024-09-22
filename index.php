<?php

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

    // echo("<pre>");
    // echo("<code>");
    // var_dump($_POST);
    // echo("</code>");
    // echo("</pre>");

    // enregistrer en BDD le formulaire
    if(count($_POST) > 0) {
        // le formulaire est soumis
        // echo "soumis";

        // insertion de données
        $sql = "INSERT INTO `clients` (`nom`, `prenom`, `mail`) VALUES (:nom, :prenom, :mail)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $stmt->bindParam(':mail', $_POST['mail'], PDO::PARAM_STR);
        $stmt->execute();
    }

    // récupérer les informations de la BDD pour les afficher dans le tableau
    $sql = "SELECT * FROM `clients`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP</title>
        <link rel="stylesheet" href="index.css">
    </head>



    <body>
        <div class="a">
            <a href="admin.php" class="a">Page Admin</a>
        </div>
        <h1>News Letters</h1>
        <br>
        <h2>Ajout d'un client</h2>
        <!-- Action vide => renvoi ver sla page elle-même -->
        
        <!-- Method = POST ou GET (par défaut) -->
        <form action="" method="POST">
            <div>
                <label for="nom">Nom</label>
                <input id="nom" type="text" name="nom" placeholder="Nom">
            </div>
            <div>
                <label for="prenom">Prénom</label>
                <input id="prenom" type="text" name="prenom" placeholder="Prénom">
            </div>
            <div>
                <label for="mail">Adresse mail</label>
                <input id="mail" type="email" name="mail" placeholder="exemple@gmail.com" required>
            </div>
            <div>
                <button type="submit">S'inscrire</button>
            </div>
            <div class="b">
                <a href="unsubscribe.php" class="b">Page désinscription</a>
            </div>
        </form>

        <div class="sun"></div>
        <div class="river">
            <div class="boat"></div>
        </div>
        <div class="hot-air-balloon">
            <div class="balloon">
                <div class="stripes"></div>
                <div class="stripes"></div>
                <div class="stripes"></div>
                <div class="flame"></div>
            </div>
            <div class="basket">
                <div class="sandbags"></div>
                <div class="sandbags"></div>
                <div class="sandbags"></div>
            </div>
        </div>
    </body>
</html>