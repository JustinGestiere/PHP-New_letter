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
?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP</title>
        <link rel="stylesheet" href="admin.css">

    </head>
    <body>
    <div class="wrapper">
        <div class="a">
            <a href="index.php" class="a">Page d'inscription</a>
        </div>


<?php
$mdp = "mdp";

    if (isset($_GET['mdp'])) : //$_GET n'est pas sécurisé car le mdp s'affiche dans l'url du navigateur si on veut que ca soir secur 
        //il faut mettre $_POST car les elements sont enregistrer dans un tableau avec une cle et il ressort l'element en fonction de la cle

        // Vérifier si le mot de passe saisi est correct
        if ($_GET['mdp'] === $mdp) :?>
            <h2>Clients</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Adresse Mail</th>
                        <th>Activé / Désactivé</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- tableau ici -->
                    <?php foreach ($results as $row): ?>

                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nom']; ?></td>
                            <td><?php echo $row['prenom']; ?></td>
                            <?php if($row['etat'] == 1): ?>
                                <td class="mail"><?php echo $row['mail']; ?></td>
                            <?php else: ?>
                                <td class=""><?php echo $row['mail']; ?></td>
                            <?php endif; ?>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <?php if($row["etat"]==1): ?>
                                        <button type="submit" name="bouton" value="0">Desactiver</button>
                                    <?php else: ?>
                                        <button type="submit" name="bouton" value="1">Activer</button>
                                    <?php endif; ?>
                                </form>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>

            <div>
                <br><button id="copie_email" type="submit" class="copie_email">Copie des emails</button>
            </div>
        <?php
            else:
                // Mot de passe incorrect
                echo "Mot de passe incorrect.";
        ?>

            <h2>Se connecter</h2>
                <form action="">
                <div>
                        <label for="mdp">Mot de passe</label>
                        <input id="mdp" type="password" name="mdp" placeholder="mdp">
                    </div>
                    <div>
                        <button type="submit">Entrer</button>
                    </div>
                </form>

        <?php
                endif;
            else:
                // Mot de passe non fourni
                echo "Veuillez fournir un mot de passe.";
        ?>

            <h2>Se connecter</h2>
                <form action="">
                <div>
                        <label for="mdp">Mot de passe</label>
                        <input id="mdp" type="password" name="mdp" placeholder="mdp">
                    </div>
                    <div>
                        <button type="submit">Entrer</button>
                    </div>
                </form>

        <?php
            endif;
        ?>

    </div>
    <script src="main.js"></script>
    </body>
</html>