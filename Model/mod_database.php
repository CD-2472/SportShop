<?php
  function Connessione() {
  
  $conn = mysql_connect("localhost", "root", "") or die("Connessione non Avvenuta");
  
  mysql_select_db("Abbigliamento", $conn) or die("Database Innesistente");
  
  return $conn;
  }
  
  function Disconnessione($conn) {
  
  mysql_close($conn);
  
  }
?>