<?php

include "..\Model\mod_articoli_input_colore.php";
include "..\Model\mod_database.php";
 
$conndb=Connessione();
$colore_scelto="";
if (isset($_GET["colore"])) $colore_scelto=$_GET["colore"];

Print " <html>
        <head><title>SportShop</title>".'<a href="index.html" class="btn btn--m btn--gray-border" align="left" >HOME</a>'."
              
        </head>
        <body bgcolor='#CCFFFF'>
        <form action='view_lista_articoli.php' method='GET'>
        <table  align='center' border='0' cellpadding='4'  >
        <tr><td ><h1  face='Arial' align='center' >Sport Shop!</h1> <h3 face='Arial' align='center'>Lo shop di abbigliamento più completo che puoi trovare!</h3> </td></tr>
         <tr><td align='center' ><img src='..\Immagini\abbigliamento.jpg' alt='abbigliamento' height='150' width='450' align='center' /><br /><br /><br /><br /></td></tr>
         <tr><td>Scegli il colore per visualizzare gli articoli con questa caratteristica:
                 <select name='colore'>";
    $colori=lista_colori();
      
    foreach ($colori as $colore) {
       $sel="";
       if($colore==$colore_scelto)  {$sel="selected";} 
       print "<option value='".$colore."' $sel >".$colore."</option>";
    }

Print "</select></td></tr>
      <tr >
           <td align='center''><input type='reset' name='ANNULLA' value='ANNULLA' /> <input type='submit' name='VISUALIZZA' value='VISUALIZZA' /> </td>
         </tr>";


Print "</table></form>";

if (isset($_GET["VISUALIZZA"])) 
   { print "<table  border='1' align='center' bgcolor='#FFCCFF' cellspacing='3' cellpadding='2'>
            <tr bgcolor='#FFC8DF'> <td>Descrizione</td> 
                 <td>Taglia</td>
                 <td>Prezzo di Listino </td>
            </tr>";
     $articoli=lista_articoli_col($colore_scelto);
     foreach ($articoli as $articolo) 
       { print "<tr> <td>".$articolo->Descrizione."</td>
                <td>".$articolo->Taglia."</td>
                <td>".$articolo->PrezzoListino."</td>
                </tr>";
       }
    print"</table>";
   }




Disconnessione($conndb);
Print "</body> </html>";
?>
