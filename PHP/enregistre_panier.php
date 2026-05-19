<?php
ob_start();
error_reporting(0);
session_start();
?>
<!DOCTYPE html>
<html>
<body>
    

<?php 
            $file = fopen("../data/produit.csv", "r+") or die ("Unable to open file"); //on ouvre le fichier produit et panier
            $file2 = fopen("../data/Panier.csv", "a") or die ("Unable to open file");
            $str = $_POST["str"];
            while (!feof($file)) {
                    $line = fgets($file); 
                    $idpwd = explode(";", $line);
                    if ($idpwd[0] == $str) {
                        fseek($file, 0);
                        $chaine = '';
                        $count = 0;
                        while(!feof($file)) {
                            $chaine .= fgets($file); //on sépare chaques lignes
                            $count++;
                        }
                        $lignes = explode("\n", $chaine); 
                        for ($i=0; $i < $count; $i++) { 
                            $idpwd2 = explode(";", $lignes[$i]);
                            if ($idpwd2[0] == $str){
                                $int = (int) filter_var($idpwd2[2], FILTER_SANITIZE_NUMBER_INT); 
                                if ($int >= $_POST["nbrarticles"] ) { 
                                    $int = $int - $_POST["nbrarticles"] ;
                                }
                                $idpwd2[2] = $int ;
                                $lignes[$i] = $idpwd2[0].";".$idpwd2[1].";".$idpwd2[2].";".$idpwd2[3].";".$idpwd2[4].";".$idpwd2[5].";" ; //nouvelle ligne
                            }
                            
                        }
                        $chaine = '';
                        foreach($lignes as $ligne) { 
                            $chaine .= $ligne."\n";
                        }
                        fseek($file, 0);
                        fputs($file, $chaine);
                        for ($i=0; $i < $_POST["nbrarticles"]; $i++) { 
                            if ($idpwd[2] != 0) { 
                                $text = $idpwd[0].";".$idpwd[1].";"."";
                                fwrite($file2, $text);                                
                                if ($idpwd[5] == "citadine") {
                                    header('Location: citadine.PHP');
                                }
                                elseif ($idpwd[5] === "berline") {
                                    header('Location: berline.PHP');
                                }
                                elseif ($idpwd[5] === "suv") {
                                    header('Location: suv.PHP');                              
                            }
                        }
                    }
            }
        } 
        fclose($file);  
        fclose($file2);  
            ob_end_flush(); 
?>

</body>
</html>