<?php
require_once ("../connexion.php");
session_start();
if(!isset($_SESSION['NIV'])){
  header ('location: ../index.php');
} ?>
<?php
if($_SESSION['NIV'] == "etudiant"){ 

$id_soutenance = $_POST['id_soutenance'];
$EMAIL = $_SESSION['EMAIL'];
$info_encadrant = "SELECT id_soutenance, email_etudiant, validation_encadrant FROM soutenance where id_soutenance = '$id_soutenance' AND  email_etudiant ='$EMAIL'";
$result = $conn->query($info_encadrant);
$row = $result->fetch_assoc(); 
if ($row['validation_encadrant'] == "non"){
    echo "votre demande n'est pas accepté";
}
else if ($row['validation_encadrant'] == "oui"){
  echo "votre demande est accepté";
}
else {
  echo "votre demande pas encore traité";
}
}
else  { 
  //if not etudiant 
  header ('location: ../index.php'); }
?>