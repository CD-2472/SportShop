<?php

function lista_articoli() {  //serve per creare una lista di articoli tra cui selezionare esclusivamente venduti nel 2020
 $vettarticoli=array();
 $query=" SELECT A.Descrizione
          FROM Articoli A INNER JOIN Vendite V ON A.Codice=V.CodiceArticolo
          WHERE V.DataVendita between '2020-1-1' and '2020-12-31'
          GROUP BY Descrizione
          ORDER BY Descrizione;
        
        ";
 $tab=mysql_query($query);
 while ($ris=mysql_fetch_array($tab)) {$descr=$ris["Descrizione"]; array_push($vettarticoli,$descr); }
 return $vettarticoli;
}






// da qua invece abbiamo la funzione necessaria per determinare l'elenco delle vendite effettuate nel 2020 di un articolo dato in input 
class VenditeLis { 
    public $datavendita;
    public $colore;
    public $taglia;
    public $quantita;
    public $prezzo;  
  }

function lista_vendite($descr) {
 $vettvend=array();
 $query="SELECT V.DataVendita, A.Colore, A.Taglia, V.QuantitaVenduta, V.PrezzoVendita
         FROM Articoli A INNER JOIN Vendite V ON A.Codice=V.CodiceArticolo 
         WHERE A.Descrizione='".$descr."' AND V.DataVendita between '2020-1-1' and '2020-12-31' 
         ORDER BY DataVendita;    
        ";
 $tab=mysql_query($query);
 while ($ris=mysql_fetch_array($tab)) {
        $VendLis=new VenditeLis;
        $VendLis->datavendita=$ris["DataVendita"];
        $VendLis->colore=$ris["Colore"];
        $VendLis->taglia=$ris["Taglia"];
        $VendLis->quantita=$ris["QuantitaVenduta"];
        $VendLis->prezzo=$ris["PrezzoVendita"];       
        array_push($vettvend,$VendLis);
        } return $vettvend;
        


}
 

?>                  