function retirer_du_panier(id) { 
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function(){}
    xmlhttp.open("GET", "retirer_du_panier.php?str=" + id); 
    xmlhttp.send();
}