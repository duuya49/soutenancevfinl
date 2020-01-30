<?php
require_once ("../connexion.php");
session_start();
if(!isset($_SESSION['NIV'])){
  header ('location: ../index.php');
}
//if not etudiant
if($_SESSION['NIV'] == "encadrant"){ 
  //nom jury all
$nom_jury_president = $_POST['nom_jury_president'];
$nom_jury_examinateur = $_POST['nom_jury_examinateur'];
$nom_jury_invite = $_POST['nom_jury_invite'];
//prenom jury all
$prenom_jury_president = $_POST['prenom_jury_president'];
$prenom_jury_examinateur = $_POST['prenom_jury_examinateur'];
$prenom_jury_invite = $_POST['prenom_jury_invite'];
// etablissement jury
$etablissement_jury_president = $_POST['etablissement_jury_president'];
$etablissement_jury_examinateur = $_POST['etablissement_jury_examinateur'];
$etablissement_jury_invite = $_POST['etablissement_jury_invite'];
// email jury
$email_jury_president = $_POST['email_jury_president'];
$email_jury_examinateur = $_POST['email_jury_examinateur'];
$email_jury_invite = $_POST['email_jury_invite'];
// date de soutenance
$date_soutenance = $_POST['date_soutenance'];
// numero de demande
$id_soutenance = $_POST['id_soutenance'];
$sql = "UPDATE  soutenance  SET   nom_jury_president = '$nom_jury_president', nom_jury_examinateur = '$nom_jury_examinateur', 
nom_jury_invite = '$nom_jury_invite', prenom_jury_president = '$prenom_jury_president', 
prenom_jury_examinateur = '$prenom_jury_examinateur', prenom_jury_invite = '$prenom_jury_invite',
etablissement_jury_president = '$etablissement_jury_president', etablissement_jury_examinateur = '$etablissement_jury_examinateur', 
etablissement_jury_invite = '$etablissement_jury_invite', email_jury_president = '$email_jury_president', 
email_jury_examinateur = '$email_jury_examinateur', 
email_jury_invite = '$email_jury_invite', date_soutenance = '$date_soutenance' where id_soutenance = '$id_soutenance'";
$conn->query($sql);
$conn->close();
header ('location: ../encadrant/validation.php');
 }
else  { 
  //if not etudiant 
  header ('location: ../index.php'); }
?>