<?php
require_once ("../connexion.php");
session_start();
if(!isset($_SESSION['NIV'])){
  header ('location: ../index.php');
}
//if not etudiant
if($_SESSION['NIV'] == "encadrant"){ 

// numero de demande
$id_soutenance = $_POST['id_soutenance'];
//choix jury validation
$choix = $_POST['choix'];
// insert des donnes
$sql = "UPDATE  soutenance  SET  validation_encadrant = '$choix' where id_soutenance = '$id_soutenance'";
$conn->query($sql);
$conn->close();
header ('location: ../encadrant/validation.php');
 }
else  { 
  //if not etudiant 
  header ('location: ../index.php'); }
?>