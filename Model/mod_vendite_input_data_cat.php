<?php
include "..\Model\mod_classe_categorie.php";
 
function lista_categorie_bamb() { //lista delle categorie per bambini
 
 $vettcat=array();
 $query="SELECT *
         FROM categorie
         WHERE Genere =2
         ORDER BY Descrizione";
 $tab=mysql_query($query);
 while ($ris=mysql_fetch_array($tab)) {
     $categoria=new Categorie;
     $categoria->Codice=$ris["Codice"];
     $categoria->Descrizione=$ris["Descrizione"];
     $categoria->Genere=$ris["Genere"];
     array_push($vettcat,$categoria);
   } return $vettcat;
}




//funzione per creare lista delle vendite di tutti gli articoli di una categoria per bambini scelta in input dato un certo periodo 
class VenditeA {
  public $datavendita;
  public $descrizione;
  public $colore;
  public $taglia;
  public $quantita;
  public $prezzo;
}

function lista_vendite_per($categ,$data1,$data2) {
   $vettvend=array();
    $query=" SELECT V.DataVendita, A.Descrizione, A.Colore, A.Taglia, V.QuantitaVenduta, V.PrezzoVendita
             FROM Articoli A INNER JOIN Vendite V ON A.Codice=V.CodiceArticolo INNER JOIN Categorie C ON A.CodiceCategoria=C.Codice
             WHERE C.Codice=".$categ." AND V.DataVendita between '".$data1."' and '".$data2."' 
             ORDER BY DataVendita, Descrizione,Taglia,Colore ;
           ";
     $tab=mysql_query($query);
     while ($ris=mysql_fetch_array($tab)) {
     $venditaa=new VenditeA;
     $venditaa->descrizione=$ris["Descrizione"];
     $venditaa->datavendita=$ris["DataVendita"];
     $venditaa->colore=$ris["Colore"];
     $venditaa->taglia=$ris["Taglia"];
     $venditaa->quantita=$ris["QuantitaVenduta"];
     $venditaa->prezzo=$ris["PrezzoVendita"];
     array_push($vettvend,$venditaa);   
     } return $vettvend;
 
 

} 
 
 
?>