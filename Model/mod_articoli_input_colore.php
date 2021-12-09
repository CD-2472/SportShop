<?php
include "..\Model\mod_classe_articoli.php";

function lista_colori() { //determina solo i colori effettivamente presenti tra 
                        //gli articoli in modo da poterli inserire nell'input
$vettcolori=array();
$query=" SELECT Colore 
         FROM Articoli
         GROUP BY Colore
         ORDER BY Colore 
       ";
$tab=mysql_query($query);

while ($ris=mysql_fetch_array($tab)) 
      {$col=$ris['Colore']; 
       array_push($vettcolori,$col); 
      } return $vettcolori;

}

function lista_articoli_col ($c) {
//lista degli articoli di un colore dato in input

$vetarticoli=array();
$query=" SELECT Codice, Descrizione, Colore, Taglia, QuantitaDisponibile, PrezzoListino, CodiceCategoria
         FROM Articoli
         WHERE Colore='".$c."'
         ORDER BY Descrizione, Taglia;";
$tab=mysql_query($query);
while ($ris=mysql_fetch_array($tab)) 
      {$articolo=new Articoli;
       $articolo->Codice=$ris["Codice"];
       $articolo->Descrizione=$ris["Descrizione"];
       $articolo->Colore=$ris["Colore"];
       $articolo->Taglia=$ris["Taglia"];
       $articolo->QuantitaDisponibile=$ris["QuantitaDisponibile"];
       $articolo->PrezzoListino=$ris["PrezzoListino"];
       $articolo->CodiceCategoria=$ris["CodiceCategoria"];
       array_push($vetarticoli,$articolo);
      } return $vetarticoli; 
}


?>