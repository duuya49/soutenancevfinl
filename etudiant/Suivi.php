<?php
require_once ("../connexion.php");
session_start();
if(!isset($_SESSION['NIV'])){
  header ('location: ../index.php');
} ?>
<?php
if($_SESSION['NIV'] == "etudiant"){ 
include('includes/header.php'); 
include('includes/navbar.php'); 
?> <div class='container'>
<h2>Suivi votre demande</h2>
<form action='' method='POST' > 
  <div class='form-group'>
    <label for='usr'>Votre ID:</label>
    <input type='text' name='id_soutenance' class='form-control' >
  </div>
  <center><button type='submit' name='button' class='btn btn-primary'>Suivi</button></center>
</form>
<?php

if(isset($_REQUEST['button']))
{
  $id_soutenance = $_POST['id_soutenance'];
$EMAIL = $_SESSION['EMAIL'];
$info_encadrant = "SELECT id_soutenance, email_etudiant, validation_encadrant FROM soutenance, etudiant where id_soutenance = '$id_soutenance' AND  email_etudiant ='$EMAIL'";
$result = $conn->query($info_encadrant);
$row = $result->fetch_assoc(); 
if ($row['validation_encadrant'] == "non"){
echo "<h2>votre demande n'est pas accepté</h2>";
}
else if ($row['validation_encadrant'] == "oui"){
echo "<h2>votre demande est accepté</h2>";
}
else {
echo "<h2>votre demande n'est pas enregistré ou n'est pas encore traité<h2>";
}
} ?>
<?php
include('includes/scripts.php');
}
else  { 
  //if not etudiant 
  header ('location: ../index.php'); }
?>
