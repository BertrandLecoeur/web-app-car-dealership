<?php
session_start();
if(isset($_POST["mailform"])){
    if(!empty($_POST["nom"] and $_POST["mail"] and $_POST["message"] and $_POST["sujet"])){ //on verifie que les champs sont bien remplis 
        $msg = "
        <br><br> 
        <p style='color:white'>Voici votre mail </p>
        <p style='color:white'><u>Nom de l'expediteur : ".$_POST["nom"]."</u></p>
        <p style='color:white'><u>Mail de l'expediteur : ".$_POST["mail"]."</u></p><br>
        <p style='color:white'>Sujet : ".$_POST["sujet"]."</p>
        <p style='color:white'>".$_POST["message"]."</p>";         
        $file = fopen("../data/mail.csv", "a"); 
        $date = date("F j, Y, g:i a");
        $line = $_POST["nom"] . " vous a envoyé un mail avec le mail suivant : " . $_POST["mail"] ." ,le : ".$date."";  
        fwrite($file, $line);
        fclose($file);
    } 
    else{
        $msg = "<p style='color:white'>Veuillez compléter tous les champs !</p>"; //message d'erreur
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/CSS/Style.css">
        <script src="/Js/fonction.js"></script>
    </head>

    <body>
        <div class="page">

            <div class="logo"><img src="/img/Logo-modified.jpg" alt="Logo" style="height:160px; width:280px; margin-top:25px"></div>

            <div class="Top">
                <p style="font-size: 52px; height:29px; margin-top:200px"><b>Auto Excellence</b></p>
                  <a href="../index.PHP"><button class="NotUseButton" >Accueil</button></a>
                      <a href="/PHP/citadine.PHP"><button  class="NotUseButton" >Citadine</button></a>
                      <a href="/PHP/berline.PHP"><button  class="NotUseButton">Berline</button></a>
                      <a href="/PHP/suv.PHP"><button  class="NotUseButton">SUV</button></a>
                      <a href="/PHP/contact.PHP"><button class="UseButton" >Contact</button></a> <!-- on met le bouton actif pour contact -->
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
                
                <form method="POST" action="" style="margin-top:230px">  <!-- form pour le contact -->

                    <h1>Contacter nous !!</h1>
                    <table>
                        <tr> 
                            <td><p> Votre nom : </p></td>
                            <td ><input type="text" name="nom" placeholder="Votre nom" value="<?php if(isset($_POST["nom"])) {echo $_POST["nom"];} ?>" ></td> <!-- zone pour le nom -->
                        </tr>
                        <tr>
                            <td><p> Votre mail : </p></td>
                            <td><input type="email" name="mail" placeholder="Votre email" value="<?php if(isset($_POST["mail"])) {echo $_POST["mail"];} ?>" ></td> <!-- zone pour le mail --> 
                        </tr>
                        <tr>
                            <td><p> Objet : </p></td>
                             <!-- zone pour l'objet -->
                            <td><input type="text" name="sujet" placeholder="Objet" value="<?php if(isset($_POST["sujet"])) {echo $_POST["sujet"];} ?>" ></td> <!-- zone pour le sujet -->
                            
                        </tr>
                        <tr>
                            <td><p> Vous avez envoyé le message suivant: </p></td>
                            <td><textarea name="message" id="" cols="30" rows="10" placeholder="Votre message"><?php if(isset($_POST["message"])) {echo $_POST["message"];} ?></textarea></td> <!-- zone pour le message -->
                        </tr>
                    </table>
                    <input type="submit" value="Envoyer le mail" name="mailform">
                </form>
                <?php
                    if(isset($msg)){ 
                        echo $msg;
                    }
                ?>               
            </div>
            <div class="Bottom">
                <p style="margin-top:10px;">Copyright By Auto Excellence©</p>
            </div>
        </div>
    </body>
</html>