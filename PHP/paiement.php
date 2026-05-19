<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/CSS/Style.css">
        <script src="/Js/fonction.js"></script>
    </head>

    <body>
        
    <?php 
        if ($_SESSION["isconnect"] == 0) { //si pas de connexion on renvoie sur la page de connexion
            $_SESSION["provenance"] = 2 ;
            header('Location: compte.PHP');
        }
    ?>
        <div class="page">            
            <div class="logo"><img src="/img/Logo-modified.jpg" alt="Logo" style="height:100px; width:250px; margin-top:20px"></div>
            <div class="Top">
                <p style="font-size: 52px; height:29px"><b>Auto Excellence</b></p>
                <a href="../index.PHP"><button class="NotUseButton" >Accueil</button></a>
                    <a href="/PHP/citadine.PHP"><button  class="NotUseButton" >Citadine</button></a>
                    <a href="/PHP/berline.PHP"><button  class="UseButton">Berline</button></a>
                    <a href="/PHP/suv.PHP"><button  class="NotUseButton">SUV</button></a>
                    <a href="/PHP/contact.PHP"><button class="NotUseButton" >Contact</button></a>
                    <a href="/PHP/compte.PHP"><button class="NotUseButton" >Compte</button></a> 
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

            <div class="Mid-Right">
                <div style='height: 350px ;width: 800px; float: left;margin-top:400px;margin-left:350px'>
                <fieldset>
                    <form action="facture.php" target="_blanck" method="POST"> 
                    Numéro de carte:
                        <input type="number" min="0000" max="9999" name="creditCard1"  value="<?php if(isset($_POST["creditCard1"])) {echo $_POST["creditCard1"];} ?>" required/>
                        -
                        <input type="number" min="0000" max="9999" name="creditCard2"  value="<?php if(isset($_POST["creditCard2"])) {echo $_POST["creditCard2"];} ?>" required/>
                        -
                        <input type="number" min="0000" max="9999" name="creditCard3"  value="<?php if(isset($_POST["creditCard3"])) {echo $_POST["creditCard3"];} ?>" required/>
                        -
                        <input type="number" min="0000" max="9999"  name="creditCard4"  value="<?php if(isset($_POST["creditCard4"])) {echo $_POST["creditCard4"];} ?>" required/>
                        <br><br>
                        Date d'expiration:
                        <input class="inputCard" name="expiry"  type="month" value="<?php if(isset($_POST["expiry"])) {echo $_POST["expiry"];} ?>" required/>

                        Cryptogramme: <input type="number" min="000" max="999"  name="crypto"  value="<?php if(isset($_POST["crypto"])) {echo $_POST["crypto"];} ?>" required/><br>
                        <br>
                        Titulaire de la carte: <input type="text" name="namecard"  value="<?php if(isset($_POST["namecard"])) {echo $_POST["namecard"];} ?>" required/>
                        <br><br>
                        <input type="submit" value="Payer" name="paiement"> <!--Toute les infos sont vérifier pour savoir si le champs est vide ou si il est bien dans les bonnes valeurs-->

                    </form><br>
                    <a href="panier.PHP"><button >Retour</button></a>
                </fieldset>
                </div>
                <img src="../img/plan.jpg" alt="plan" style="margin-right:100px;">
            </div>

            <div class="Bottom">
                <p style="margin-top:10px;">Copyright By Auto Excellence©</p>
            </div>
        </div>
    </body>
</html>
