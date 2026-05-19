<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/CSS/Style.css">
        <script src="/Js/fonction.js"></script>
    </head>

    <body>
        <div class="page">

        <div class="logo"><img src="/img/Logo-modified.jpg" alt="Logo" style="height:180px; width:280px; margin-top:15px"></div>

        <div class="Top">                
                <p style="font-size: 52px; height:29px; margin-top:200px">AUTO EXCELLENCE</p><br>
                    <a href="../index.PHP"><button class="NotUseButton" >Accueil</button></a>
                    <a href="/PHP/citadine.PHP"><button  class="NotUseButton" >Citadine</button></a>
                    <a href="/PHP/berline.PHP"><button  class="NotUseButton">Berline</button></a>
                    <a href="/PHP/suv.PHP"><button  class="NotUseButton">SUV</button></a>
                    <a href="/PHP/contact.PHP"><button class="NotUseButton" >Contact</button></a>
                    <a href="/PHP/compte.PHP"><button class="NotUseButton" >Compte</button></a> 
                    <a href="/PHP/panier.PHP"><button class="UseButton" >Panier</button></a>          
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
            
                <?php
                    $file = fopen("../data/Panier.csv", "r") or die ("Unable to open file"); //on ouvre le fichier panier
                    $price = 0;
                    $nbrproduit = 0;
                    echo "<table style='margin-top:130px'>";
                    while (!feof($file)) {
                        $line = fgets($file);
                        if(strlen($line)){ 
                            $idpwd = explode(";", $line);                           
                            echo "<tr>"; //construction du tableau                           
                            echo "<td><a href='/img/".$idpwd[0].".jpg' target='_blank'><img src='/img/".$idpwd[0].".jpg' alt='".$idpwd[0].".jpg'style='height:130px; width:190px')></a></td>";
                            echo "<td><p>".$idpwd[0]."</p></td>";
                            echo "<td><p>Prix : ".$idpwd[1]."€</p></td>";
                            echo "<td><button id = '".$idpwd[0]."' onclick = 'retirer_du_panier(this.id)'> X </button></td><br><br>";
                            echo "</tr>";                           
                            $price = $price + $idpwd[1];
                            $nbrproduit ++;
                        }                        
                    }
                    echo "</table>";
                    echo "<br><p>Vous avez ".$nbrproduit." article(s) dans votre panier.<br>Somme totale = ".$price."€<p>"; //on affiche le nombre d'articles et le prix total hors taxe
                ?>
                <a href="paiement.php"><button>Payer</button></a>
            </div>

            <div class="Bottom">
                <p style="margin-top:10px;">Copyright By Auto Excellence©</p>
            </div>
        </div>
    </body>
</html>