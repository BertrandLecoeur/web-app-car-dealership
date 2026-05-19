<?php
session_start();

// Vérifier si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les données POST nécessaires sont définies
    if (isset($_POST["createlogin"]) && isset($_POST["createmdp"])) {
        $login = $_POST["createlogin"];
        $mdp = $_POST["createmdp"];

        $cheminFichier = "../data/infoUtilisateur.csv";

        // Ouvrir le fichier en mode lecture-écriture (mode append)
        $fichier = fopen($cheminFichier, "a+") or die("Impossible d'ouvrir le fichier");

        // Vérifier si le compte existe déjà
        $compteExiste = false;
        while (!feof($fichier)) {
            $ligne = fgets($fichier);
            if (!empty($ligne)) {
                $idmdp = explode(";", $ligne);
                if ($idmdp[0] == $login && $idmdp[1] == $mdp) {
                    $compteExiste = true;
                    break;
                }
            }
        }

        // Si le compte existe, afficher une erreur et rediriger
        if ($compteExiste) {
            fclose($fichier);
            echo "<script>alert('Erreur, login ou mot de passe déjà utilisés par quelqu'un !');</script>";
            header('Location: compte.PHP'); // Redirection vers compte.php
            exit;
        }

        // Créer le compte s'il n'existe pas
        $texte = "$login;$mdp;client;{$_POST['createnom']};{$_POST['createprenom']};{$_POST['sexe']};{$_POST['createmail']};{$_POST['createnumero']};{$_POST['createbirth']};{$_POST['createadresse']};{$_POST['createmetier']};" . PHP_EOL;
        fwrite($fichier, $texte);
        fclose($fichier);
        echo "<script>alert('Votre compte a bien été sauvegardé !');</script>";
        header('Location: compte.PHP'); // Redirection vers compte.php
        exit;
    }
}

// Si ce n'est pas une requête POST valide ou si des données POST sont manquantes, rediriger vers compte.php
header('Location: compte.PHP');
exit;
?>

