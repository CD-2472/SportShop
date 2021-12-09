<?php
include "..\Model\mod_vendite_input_art.php";
include "..\Model\mod_database.php";
include "..\Controller\convertitore_data.php";

$conndb=Connessione();

$articolo_scelto="";
if (isset($_GET["articolo"])) $articolo_scelto=$_GET["articolo"];

print "<html>
       <head><title>SportShop</title></head>".'<a href="index.html" class="btn btn--m btn--gray-border" align="left" >HOME</a>'."
       <body bgcolor='#CCFFFF'>
       <form action='view_lista_vend_input_art.php' method='GET' >
       <table align='center' border='0' cellpadding='4'  >
         <tr><td colspan='2'><h1  face='Arial' align='center' >Sport Shop!</h1> <h3 face='Arial' align='center'>Lo shop di abbigliamento più completo che puoi trovare!</h3> </td></tr>
         <tr><td align='center' colspan='2'><img src='..\Immagini\abbigliamento.jpg' alt='abbigliamento' height='150' width='450' align='center' /></td></tr>
         <tr><td>Scegli un articolo per determinarne le vendite nel 2020:</td>
           <td><select name='articolo'>";
$articoli=lista_articoli(); 
 foreach ($articoli as $articolo) {  $sel=''; if ($articolo==$articolo_scelto) $sel='selected';
          print"<option value='".$articolo."' $sel >".$articolo."</option>" ;
         }          

print "      </select>
           </td>
         </tr>
         <tr >
           <td align='center'  colspan='2'><input type='reset' name='ANNULLA' value='ANNULLA' /> <input type='submit' name='VISUALIZZA' value='VISUALIZZA' /> </td>
         </tr>
       </table>
       </form>";
       
if (isset($_GET["VISUALIZZA"])) {                       
     print "<table border='1' align='center' bgcolor='#FFCCFF' cellspacing='3' cellpadding='2' >
              <tr bgcolor='#FFC8DF' ><td>Data Vendita</td>
                  <td>Colore</td>
                  <td>Taglia</td>
                  <td>Quantità venduta</td>
                  <td>Prezzo di vendita</td>
              </tr>";
     $vendite=lista_vendite($articolo_scelto);
     foreach ($vendite as $vendita) {
              $data=convertitore_data($vendita->datavendita);
              echo "<tr><td>".$data."</td>";
              print "<td>".$vendita->colore."</td>";
              print "<td>".$vendita->taglia."</td>";
              print "<td>".$vendita->quantita."</td>";
              print "<td>".$vendita->prezzo."</td></tr>"; 
             }     
     print "</table>";
   }


Disconnessione($conndb);
print "</body></html>";

?>