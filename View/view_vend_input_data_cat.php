<?php 
include "..\Model\mod_vendite_input_data_cat.php";
include "..\Model\mod_database.php";
include "..\Controller\convertitore_data.php";
$conndb=Connessione();

$categoria_scelta="";
$giorno_start_scelto="";
$giorno_end_scelto="";
if (isset($_GET["categoria"])) $categoria_scelta=$_GET["categoria"];
if (isset($_GET["giorno_start"])) $giorno_start_scelto=$_GET["giorno_start"];
if (isset($_GET["giorno_end"])) $giorno_end_scelto=$_GET["giorno_end"];
echo "<html>
      <head><title>SportShop</title></head>".'<a href="index.html" class="btn btn--m btn--gray-border" align="left" >HOME</a>'."
      <body bgcolor='#CCFFFF'>
      <form action='view_vend_input_data_cat.php' method='GET'  >
      <table  align='center' border='0' cellpadding='4' >
      <tr><td colspan='2'><h1  face='Arial' align='center' >Sport Shop!</h1> <h3 face='Arial' align='center'>Lo shop di abbigliamento più completo che puoi trovare!</h3> </td></tr>
         <tr><td align='center' colspan='2' ><img src='..\Immagini\abbigliamento.jpg' alt='abbigliamento' height='150' width='450' align='center' /><br /><br /><br /><br /></td></tr>
        <tr><td  ><p>Scegli tra le categorie per bambini per poter visualizzare l'elenco
                di tutte le vendite di articoli appartenenti ad essa in un intervallo di tempo a tua scelta.</p><br /></td>
        </tr>
        <tr><td align='center'>Scegli la categoria:
                <select name='categoria'>";
 $categorie=lista_categorie_bamb();
 foreach ($categorie as $categoria) {
   $sel="";
   if($categoria->Codice==$categoria_scelta)  {$sel="selected";}
   print "<option value='".$categoria->Codice."' $sel >".$categoria->Descrizione."</option>";
 }

echo "  </select></td>
        </tr>
        </tr>
        <tr><td align='center'>Periodo dal: <input type='date' name='giorno_start' value='$giorno_start_scelto' /> al <input type='date' name='giorno_end' value='$giorno_end_scelto' /></td>
        </tr>
        <tr >
           <td align='center'  colspan='2'><input type='reset' name='ANNULLA' value='ANNULLA' /> <input type='submit' name='VISUALIZZA' value='VISUALIZZA' /> </td>
         </tr>
      </table>
      </form>";

if (isset($_GET["VISUALIZZA"])) {
echo "<table border='1' align='center' bgcolor='#FFCCFF' cellspacing='3' cellpadding='2' >
        <tr bgcolor='#FFC8DF'><td>Data Vendita</td>
            <td>Descrizione</td>
            <td>Colore</td>
            <td>Taglia</td>
            <td>Quantità venduta</td>
            <td>Prezzo di vendita</td>
        </tr>";
 $vendite=lista_vendite_per($categoria_scelta,$giorno_start_scelto,$giorno_end_scelto);
 foreach ($vendite as $vendita){
              $data=convertitore_data($vendita->datavendita);
              echo "<tr><td>".$data."</td>";
              echo "<td>".$vendita->descrizione."</td>";
              echo "<td>".$vendita->colore."</td>";
              echo "<td>".$vendita->taglia."</td>";
              echo "<td>".$vendita->quantita."</td>";
              echo "<td>".$vendita->prezzo."</td></tr>";
  }
echo "</table>";

}

echo "</body></html>";        
Disconnessione($conndb);
?>