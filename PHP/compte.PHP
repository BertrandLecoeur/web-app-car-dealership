<?php
session_start();
if (!isset($_SESSION["isconnect"])) {
    $_SESSION["isconnect"] = 0; //valeur par défaut
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/CSS/Style.css">
        <script src="/Js/fonction.js"></script>
    </head>

    <body>
    <?php
        if(empty($_SESSION["provenance"])){
            $_SESSION["provenance"] = 1 ;
        } 
    ?>
        <div class="page">

            <div class="logo"><img src="/img/Logo-modified.jpg" alt="Logo" style="height:160px; width:280px; margin-top:25px"></div>

            <div class="Top">
                <p style="font-size: 52px; height:29px; margin-top:200px"><b>Auto Excellence</b></p>
                    <a href="../index.PHP"><button class="NotUseButton" >Accueil</button></a>
                        <a href="/PHP/citadine.PHP"><button  class="NotUseButton" >Citadine</button></a>
                        <a href="/PHP/berline.PHP"><button  class="NotUseButton">Berline</button></a>
                        <a href="/PHP/suv.PHP"><button  class="NotUseButton">SUV</button></a>
                        <a href="/PHP/contact.PHP"><button class="NotUseButton" >Contact</button></a>
                        <a href="/PHP/compte.PHP"><button class="UseButton" >Compte</button></a> 
                        <a href="/PHP/panier.PHP"><button class="NotUseButton" >Panier</button></a>          
                    </div>

                    <div class="Mid-Left">
                    <a href="../index.PHP"><button class="NotUseButton" style="margin-top:230px" >Accueil</button></a><br>
                    <a href="/PHP/citadine.PHP"><button  class="NotUseButton">Citadine</button></a><br>
                    <a href="/PHP/berline.PHP"><button  class="NotUseButton">Berline</button></a><br>
                    <a href="/PHP/suv.PHP"><button  class="NotUseButton">SUV</button></a><br>
                    <a href="/PHP/contact.PHP"><button class="NotUseButton" >Contact</button></a><br>
                    <a href="/PHP/compte.PHP"><button class="NotUseButton" >Compte</button></a> <br>
                    <a href="/PHP/panier.PHP"><button class="NotUseButton" >Panier</button></a>  <br>
            </div>

            <div class="Mid-Right" id = "Mid-Right">
            <?php
                if ($_SESSION["isconnect"] == 0 ) {
                    echo "<div style='height: 1700px ;width: 700px; float: left;margin-top:250px;margin-left:150px'>"; //s'inscrire
                    echo "<fieldset>";
                    echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>"; 
                    echo "    User :        <input type='text' name = 'login'> <br>";
                    echo "    Password :       <input type='password'  name = 'mdp'> <br><br>";
                    echo "    <input type='submit' value = 'connexion'>";
                    echo "</form>";
                    echo "</fieldset>";
                    echo "</div>";
                    echo "<div style='height: 1700px ;width: 500px; float: left;margin-top:250px'>";
                    echo "<fieldset>";
                    echo "<form action='enregistre_comptes.php' method='post'>";
                    echo "<p>Créer un compte chez nous</p>"; //création du compte
                    echo "    Utilisateur              :     <input type='text' name = 'createlogin'> <br><br>";
                    echo "    Mot de passe          :     <input type='password'  name = 'createmdp'> <br><br>";
                    echo "    Nom               :     <input type='text'  name = 'createnom'> <br><br>";
                    echo "    Prénom            :     <input type='text'  name = 'createprenom'> <br><br>";
                    echo "    Genre             :     Homme<input type='radio' name='sexe' value='homme'> Femme<input type='radio' name='sexe' value='femme'><br><br>";
                    echo "    Adresse EMail      :     <input type='email'  name = 'createmail'> <br><br>";
                    echo "    N° de téléphone      :     <input type='tel'  name = 'createnumero'> <br><br>";
                    echo "    Date de Naissance :     <input type='date'  name = 'createbirth'> <br><br>";
                    echo "    Adresse           :     <input type='text'  name = 'createadresse'> <br><br>";
                    echo "    Métier            :     <input type='text'  name = 'createmetier'> <br><br>";
                    echo "    <input type='submit' value = 'INSCRIPTION'>";
                    echo "</form>";
                    echo "</fieldset>";
                    echo "</div>";

                }
                elseif ($_SESSION["isconnect"] == 1 ) { 
                    echo "<p>Vous êtes bien connecté !</p>";
                    echo "<div style='height: 1700px ;width: 700px; float: left;margin-top:250px;margin-left:350px'>";
                    echo "<form action='deconnexion.php' method='post'><input type='submit' value = 'Cliquez ici pour vous déconnecter'></form>";
                }
                elseif ($_SESSION["isconnect"] == 2) {
                    echo "<p>Vous êtes bien connecté !</p>"; 
                    echo "<a href='ajoutProduit.PHP'><button class='NotUseButton' >Ajout Produit</button></a><form action='deconnexion.php' method='post'><input type='submit' value = 'deconnexion'></form>";

                }
            ?>

                <?php   
                    $file = fopen("../data/infoUtilisateur.csv", "r") or die ("Unable to open file"); //on ouvre et parcours le fichier utilisateur 
                    $bool = 0 ;
                    while (!feof($file)) {
                        $line = fgets($file);
                        $idpwd = explode(";", $line);
                        if ($_SESSION["isconnect"] == 0){ 
                            if(isset($_POST["login"]) and isset($_POST["mdp"])){ //vérification du nom d'utlisateur et du mot de passe
                                if ($idpwd[0] === $_POST["login"] && $idpwd[1] === $_POST["mdp"]) {
                                    $bool = 1 ;
                                    if ($idpwd[2] == "admin") {  
                                        $_SESSION["isconnect"] = 2 ;
                                        $_SESSION["Username"] = $idpwd[3]." ".$idpwd[4];
                                        $_SESSION["telephone"] = $idpwd[7];
                                        $_SESSION["adresse"] = $idpwd[9];
                                        $_SESSION["mail"] = $idpwd[6];
                                        if ($_SESSION["provenance"] == 1) {
                                            echo("<meta http-equiv='refresh' content='1'>");
                                        }
                                        elseif ($_SESSION["provenance"] == 2) {
                                            header('Location: panier.PHP');
                                        }
                                    }
                                    else if($idpwd[2] == "client") { 
                                        $_SESSION["isconnect"] = 1 ;
                                        $_SESSION["Username"] = $idpwd[3]." ".$idpwd[4];
                                        $_SESSION["telephone"] = $idpwd[7];
                                        $_SESSION["adresse"] = $idpwd[9];
                                        $_SESSION["mail"] = $idpwd[6];
                                        if ($_SESSION["provenance"] == 1) {
                                            echo("<meta http-equiv='refresh' content='1'>");
                                        }
                                        elseif ($_SESSION["provenance"] == 2) {
                                            header('Location: panier.PHP');
                                        }
                                    }
                                }
                                if ($bool == 0) { 
                                    echo "Erreur NOM D'UTILISATEUR ou MOT DE PASSE incorrect, veuillez réessayer :";
                                }   
                            }
                        }
                    }
                fclose($file);
            ?>
            </div>
            <div class="Bottom">
                <p style="margin-top:10px;">Copyright By Auto Excellence©</p>
            </div>
        </div>
    </body>
</html>