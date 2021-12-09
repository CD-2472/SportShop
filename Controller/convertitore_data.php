<?php
function convertitore_data($data) {
  $timestamp = strtotime($data); 
  $newDate = date("d-m-Y", $timestamp );
  return $newDate;
}

?>