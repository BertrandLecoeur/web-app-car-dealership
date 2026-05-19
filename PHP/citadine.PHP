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

            <div class="logo"><img src="/img/citadine_logo.jpg" alt="Logo" style="height:160px; width:280px; margin-top:25px"></div>

            <div class="Top"> <!-- les boutons de la page top -->                
                <p style="font-size: 52px; height:29px; margin-top:200px">AUTO EXCELLENCE</p><br>
                    <a href="../index.PHP"><button class="NotUseButton" >Accueil</button></a>
                    <a href="/PHP/citadine.PHP"><button  class="UseButton" >Citadine</button></a>
                    <a href="/PHP/berline.PHP"><button  class="NotUseButton">Berline</button></a>
                    <a href="/PHP/suv.PHP"><button  class="NotUseButton">SUV</button></a>
                    <a href="/PHP/contact.PHP"><button class="NotUseButton" >Contact</button></a>
                    <a href="/PHP/compte.PHP"><button class="NotUseButton" >Compte</button></a> 
                    <a href="/PHP/panier.PHP"><button class="NotUseButton" >Panier</button></a>          
                </div>

                <div class="Mid-Left"> <!-- les boutons de la marge à gauche -->
                <a href="../index.PHP"><button class="NotUseButton" style="margin-top:230px" >Accueil</button></a><br>
                <a href="/PHP/citadine.PHP"><button  class="NotUseButton">Citadine</button></a><br>
                <a href="/PHP/berline.PHP"><button  class="NotUseButton">Berline</button></a><br>
                <a href="/PHP/suv.PHP"><button  class="NotUseButton">SUV</button></a><br>
                <a href="/PHP/contact.PHP"><button class="NotUseButton" >Contact</button></a><br>
                <a href="/PHP/compte.PHP"><button class="NotUseButton" >Compte</button></a> <br>
                <a href="/PHP/panier.PHP"><button class="NotUseButton" >Panier</button></a>  <br>

            </div>

            <div class="Mid-Right">
                <table style="margin-top:230px">
                    <?php 
                        $file = fopen("../data/produit.csv", "r") or die ("Unable to open file"); //on ouvre le fichier produit
                        while (!feof($file)) { 
                            $line = fgets($file);
                            if(strlen($line)){
                            $idpwd = explode(";", $line); 
                            
                                if ($idpwd[5] === "citadine") { //il faut que la voiture soit de la catégorie citadine
                                    echo "<tr>"; 
                                    echo "<td><a href='/img/".$idpwd[0].".jpg' target='_blank'><img src='/img/".$idpwd[0].".jpg' alt='".$idpwd[0].".jpg'style='height:150px; width:240px')></a></td>"; 
                                    echo "<td><p>".$idpwd[3]."</p><br><p>".$idpwd[4]."</p></td>"; 
                                    echo "<td><p>Prix : ".$idpwd[1]."€</p></td>";
                                    echo "<td><form action='enregistre_panier.php' method='post'>
                                            Article : <input type='text' name = 'str' value = '".$idpwd[0]."' ><br>
                                            Stock : <input type='number' name='nbrarticles' value ='1' min='1' max='".$idpwd[2]."'><br> 
                                                <input type='submit' value = 'Ajouter au panier'></form></td>";
                                    if ($_SESSION["isconnect"] == 2 ) { 
                                        echo "<td>Stocks = ".$idpwd[2]."</td>";
                                    }                                   
                                    echo "</tr>";
                                }
                            }                           
                        }
                        fclose($file);
                    ?>                  
                </table>
            </div>
            <div class="Bottom">
                <p style="margin-top:10px;">Copyright By Auto Excellence©</p>
            </div>
        </div>       
    </body>
</html>