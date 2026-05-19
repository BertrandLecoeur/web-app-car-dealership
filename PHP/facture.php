<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<body>
    

    <pre style="font-size:40px"><b>Facture</b>      <img src="../img/Logo-modified.jpg" alt="" style="height:150px; width:220px; margin-top:10px;"></pre>
    <p>Date de création : <?php echo date("F j, Y "); ?></p><br>

    <pre style="font-size:15px"><b>Auto Excellence</b>                                                     <b>Destinataire </b> : <?php echo $_SESSION["Username"];?> <br>33 Avenue des Champs Elysées                                        <?php echo $_SESSION["adresse"];?><br>75 000 Paris                                                        <?php echo $_SESSION["telephone"];?><br>                                                                    <?php echo $_SESSION["mail"];?></pre>
    
    <pre></pre><br>

    <p><b>Commande </b></p><br>
    <table>
        <tr>
            <td Style="background-color: rgb(0, 74, 211)" WIDTH="150px"><p><b>Nom</b></p></td>
            <td Style="background-color: rgb(0, 74, 211)" WIDTH="150px"><p><b>Prix Total HT</b></p></td>
            <td Style="background-color: rgb(0, 74, 211)" WIDTH="70px"><p><b>TVA</b></p></td>
            <td Style="background-color: rgb(0, 74, 211)" WIDTH="150px"><p><b>Montant TVA</b></p></td>
            <td Style="background-color: rgb(0, 74, 211)" WIDTH="150px"><p><b>Total TTC</b></p></td>
        </tr>
        <?php
            $file = fopen("../data/Panier.csv", "r") or die ("Unable to open file"); //on ouvre le panier
            $totalht = 0;
            $totalttc = 0;
            $totaltva = 0;

            while (!feof($file)) { 
                $line = fgets($file);
                if(strlen($line)){ 
                    $idpwd = explode(";", $line);
                    $prixht = $idpwd[1]*0.20;   
                    $prixttc = $prixht + $idpwd[1];  
                    echo "<tr>"; 
                    echo "<td WIDTH='150px' style='border: 1px solid black'><p>".$idpwd[0]."</p></td>";
                    echo "<td WIDTH='150px' style='border: 1px solid black'><p>".$idpwd[1]." €</p></td>";
                    echo "<td WIDTH='70px' style='border: 1px solid black'><p>20%</p></td>";
                    echo "<td WIDTH='150px' style='border: 1px solid black'><p>".$prixht." €</p></td>";
                    echo "<td WIDTH='150px' style='border: 1px solid black'><p>".$prixttc." €</p></td>";
                    echo "</tr>";                   
                    $totalht = $totalht + $idpwd[1] ; //calcul des prix
                    $totaltva = $totaltva + $prixht ;
                    $totalttc = $totalttc + $prixttc ;
                }
            }
            echo "<tr>"; 
            echo "<td WIDTH='150px' style='border: 1px solid black'><p><b>Total : </p></b></td>";
            echo "<td WIDTH='150px' style='border: 1px solid black'><p>".$totalht." €</p></td>";
            echo "<td WIDTH='70px' style='border: 1px solid black'><p>20%</p></td>";
            echo "<td WIDTH='150px' style='border: 1px solid black'><p>".$totaltva." €</p></td>";
            echo "<td WIDTH='150px' style='border: 1px solid black'><p>".$totalttc." €</p></td>";
            echo "</tr>";
        ?>
    </table>
</body>
</html>