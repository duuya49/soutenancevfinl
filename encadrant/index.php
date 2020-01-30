<?php
require_once ("../connexion.php");
session_start();
if(!isset($_SESSION['NIV'])){
  header ('location: ../index.php');
} ?>
<?php
if($_SESSION['NIV'] == "encadrant"){ 
include('includes/header.php'); 
include('includes/navbar.php'); 
include('includes/scripts.php');
echo "<center><img src='../style/img/back-encadrant.jpg' alt='fac' style='height:580px'></center>";
include('includes/footer.php');
} 
else  { 
  //if not encadrant 
  header ('location: ../index.php'); }
?>