<?php
session_start();

$str = $_REQUEST["str"];

// Chemin vers les fichiers
$produitFile = "../data/produit.csv";
$panierFile = "../data/Panier.csv";

// Lire le fichier produit.csv et mettre à jour le stock
$lines = file($produitFile); // Lire le fichier dans un tableau de lignes

foreach ($lines as $index => $line) {
    $idpwd = explode(";", $line);
    if ($idpwd[0] == $str) {
        $idpwd[2] = (int)$idpwd[2] + 1; // Augmenter le stock
        $lines[$index] = implode(";", $idpwd); // Mettre à jour la ligne
        break; // Sortir de la boucle une fois la mise à jour effectuée
    }
}

file_put_contents($produitFile, implode("", $lines)); // Écrire les lignes mises à jour dans le fichier

// Supprimer l'article du panier
$panierLines = file($panierFile);

foreach ($panierLines as $index => $panierLine) {
    $idpwd2 = explode(";", $panierLine);
    if ($idpwd2[0] == $str) {
        unset($panierLines[$index]); // Supprimer la ligne du panier
    }
}

file_put_contents($panierFile, implode("", $panierLines)); // Écrire les lignes mises à jour dans le fichier du panier
?>
